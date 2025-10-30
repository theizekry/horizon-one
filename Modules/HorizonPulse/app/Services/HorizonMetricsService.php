<?php

namespace Modules\HorizonPulse\Services;

use Modules\Dashboard\Models\Project;
use Modules\HorizonPulse\Services\Redis\RedisConnectionFactory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class HorizonMetricsService
{
    protected RedisConnectionFactory $redisConnectionFactory;

    public function __construct(RedisConnectionFactory $redisConnectionFactory)
    {
        $this->redisConnectionFactory = $redisConnectionFactory;
    }

    /**
     * Fetch metrics for all projects
     */
    public function fetchAllProjectsMetrics(): array
    {
        $projects = Project::all();
        $metrics = [];

        foreach ($projects as $project) {
            $metrics[] = $this->fetchProjectMetrics($project);
        }

        return $metrics;
    }

    /**
     * Fetch metrics for a specific project
     */
    public function fetchProjectMetrics(Project $project): array
    {
        try {
            $connection = $this->redisConnectionFactory->make([
                'host' => $project->redis_host,
                'port' => $project->redis_port,
                'password' => $project->redis_password,
                'database' => $project->redis_db,
            ]);

            $prefix = $project->horizon_prefix ?: 'horizon';
            
            // Fetch Horizon metrics from Redis
            $workload = $this->getWorkload($connection, $prefix);
            $failedJobs = $this->getFailedJobs($connection, $prefix);
            $masters = $this->getMasters($connection, $prefix);
            $measures = $this->getMeasures($connection, $prefix);
            $recentJobs = $this->getRecentJobs($connection, $prefix);

            return [
                'project_id' => $project->id,
                'project_name' => $project->name,
                'environment' => $project->environment,
                'workload' => $workload,
                'failed_jobs' => $failedJobs,
                'masters' => $masters,
                'measures' => $measures,
                'recent_jobs' => $recentJobs,
                'status' => $this->determineStatus($failedJobs, $masters),
                'last_updated' => now()->toISOString(),
                'connection_status' => 'connected',
            ];

        } catch (\Exception $e) {
            Log::error("Failed to fetch Horizon metrics for project {$project->name}: " . $e->getMessage());
            
            return [
                'project_id' => $project->id,
                'project_name' => $project->name,
                'environment' => $project->environment,
                'workload' => [],
                'failed_jobs' => ['count' => 0, 'jobs' => []],
                'masters' => [],
                'measures' => [],
                'recent_jobs' => [],
                'status' => 'error',
                'last_updated' => now()->toISOString(),
                'connection_status' => 'failed',
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Test Redis connection for a project
     */
    public function testConnection(Project $project): array
    {
        try {
            $connection = $this->redisConnectionFactory->make([
                'host' => $project->redis_host,
                'port' => $project->redis_port,
                'password' => $project->redis_password,
                'database' => $project->redis_db,
            ]);

            // Test basic connection
            $ping = $connection->ping();
            
            if ($ping !== 'PONG') {
                throw new \Exception('Redis ping failed');
            }

            // Test Horizon-specific keys
            $prefix = $project->horizon_prefix ?: 'horizon';
            $horizonKeys = $connection->keys("{$prefix}:*");
            
            return [
                'success' => true,
                'message' => 'Connection successful',
                'ping' => $ping,
                'horizon_keys_found' => count($horizonKeys),
                'connection_time' => microtime(true),
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Connection failed: ' . $e->getMessage(),
                'ping' => null,
                'horizon_keys_found' => 0,
                'connection_time' => microtime(true),
            ];
        }
    }

    /**
     * Get workload information
     */
    protected function getWorkload($connection, string $prefix): array
    {
        try {
            $workloadKey = "{$prefix}:workload";
            $workload = $connection->hgetall($workloadKey);
            
            return $workload ?: [
                'default' => 0,
                'emails' => 0,
                'notifications' => 0,
                'reports' => 0,
            ];
        } catch (\Exception $e) {
            Log::warning("Failed to get workload: " . $e->getMessage());
            return ['default' => 0];
        }
    }

    /**
     * Get failed jobs information
     */
    protected function getFailedJobs($connection, string $prefix): array
    {
        try {
            $failedJobsKey = "{$prefix}:failed_jobs";
            $failedJobs = $connection->lrange($failedJobsKey, 0, -1);
            
            return [
                'count' => count($failedJobs),
                'jobs' => array_slice($failedJobs, 0, 10), // Limit to 10 recent failures
            ];
        } catch (\Exception $e) {
            Log::warning("Failed to get failed jobs: " . $e->getMessage());
            return ['count' => 0, 'jobs' => []];
        }
    }

    /**
     * Get masters information
     */
    protected function getMasters($connection, string $prefix): array
    {
        try {
            $mastersKey = "{$prefix}:masters";
            $masters = $connection->hgetall($mastersKey);
            
            return $masters ?: [];
        } catch (\Exception $e) {
            Log::warning("Failed to get masters: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Get performance measures
     */
    protected function getMeasures($connection, string $prefix): array
    {
        try {
            $measuresKey = "{$prefix}:measures";
            $measures = $connection->hgetall($measuresKey);
            
            return $measures ?: [
                'avg_runtime' => '0ms',
                'throughput' => '0/min',
                'memory_usage' => '0MB',
            ];
        } catch (\Exception $e) {
            Log::warning("Failed to get measures: " . $e->getMessage());
            return [
                'avg_runtime' => '0ms',
                'throughput' => '0/min',
                'memory_usage' => '0MB',
            ];
        }
    }

    /**
     * Get recent jobs
     */
    protected function getRecentJobs($connection, string $prefix): array
    {
        try {
            $recentJobsKey = "{$prefix}:recent_jobs";
            $recentJobs = $connection->lrange($recentJobsKey, 0, 9); // Get 10 recent jobs
            
            return $recentJobs ?: [];
        } catch (\Exception $e) {
            Log::warning("Failed to get recent jobs: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Determine project status based on metrics
     */
    protected function determineStatus(array $failedJobs, array $masters): string
    {
        $failedCount = $failedJobs['count'] ?? 0;
        $activeMasters = count(array_filter($masters, fn($status) => $status === 'active'));

        if ($failedCount > 10) {
            return 'error';
        } elseif ($failedCount > 0 || $activeMasters === 0) {
            return 'warning';
        } else {
            return 'active';
        }
    }
}
