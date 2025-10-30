<?php

namespace Modules\HorizonPulse\Services;

use Modules\HorizonPulse\Services\Redis\RedisConnectionFactory;
use Modules\Dashboard\Models\Project;
use Illuminate\Support\Facades\Log;

class HorizonMetricsFetcher
{
    /**
     * Fetch Horizon metrics for a specific project.
     *
     * @param Project $project
     * @return array
     */
    public function fetchMetrics(Project $project): array
    {
        try {
            // For now, let's use mock data since we're having Redis connection issues
            // TODO: Fix Redis connection networking issue
            return $this->getMockMetrics($project);
            
            /*
            $redis = RedisConnectionFactory::make([
                'name' => 'project_' . $project->id,
                'host' => $project->redis_host,
                'port' => $project->redis_port,
                'password' => $project->redis_password,
                'database' => $project->redis_db,
            ]);

            $prefix = $project->horizon_prefix . ':';
            
            return [
                'project_id' => $project->id,
                'project_name' => $project->name,
                'environment' => $project->environment,
                'workload' => $this->getWorkload($redis, $prefix),
                'failed_jobs' => $this->getFailedJobs($redis, $prefix),
                'masters' => $this->getMasters($redis, $prefix),
                'measures' => $this->getMeasures($redis, $prefix),
                'recent_jobs' => $this->getRecentJobs($redis, $prefix),
                'status' => $this->getStatus($redis, $prefix),
                'last_updated' => now()->toISOString(),
            ];
            */
        } catch (\Exception $e) {
            Log::error('Failed to fetch Horizon metrics for project: ' . $project->name, [
                'project_id' => $project->id,
                'error' => $e->getMessage(),
            ]);

            return [
                'project_id' => $project->id,
                'project_name' => $project->name,
                'environment' => $project->environment,
                'error' => 'Connection failed: ' . $e->getMessage(),
                'status' => 'error',
                'last_updated' => now()->toISOString(),
            ];
        }
    }

    /**
     * Get mock metrics for demonstration purposes.
     */
    private function getMockMetrics(Project $project): array
    {
        return [
            'project_id' => $project->id,
            'project_name' => $project->name,
            'environment' => $project->environment,
            'workload' => [
                'default' => rand(0, 50),
                'emails' => rand(0, 20),
                'notifications' => rand(0, 30),
                'reports' => rand(0, 10),
            ],
            'failed_jobs' => [
                'count' => rand(0, 5),
                'jobs' => [
                    'App\\Jobs\\SendEmailJob',
                    'App\\Jobs\\ProcessReportJob',
                ],
            ],
            'masters' => [
                'master-1' => 'active',
                'master-2' => 'active',
            ],
            'measures' => [
                'avg_runtime' => rand(100, 5000) . 'ms',
                'throughput' => rand(10, 100) . '/min',
                'memory_usage' => rand(50, 200) . 'MB',
            ],
            'recent_jobs' => [
                'App\\Jobs\\SendEmailJob',
                'App\\Jobs\\ProcessReportJob',
                'App\\Jobs\\GenerateReportJob',
                'App\\Jobs\\SendNotificationJob',
            ],
            'status' => 'active',
            'last_updated' => now()->toISOString(),
            'note' => 'Mock data - Redis connection needs to be fixed',
        ];
    }

    /**
     * Get workload metrics from Redis.
     */
    private function getWorkload($redis, string $prefix): array
    {
        try {
            $workload = $redis->hgetall($prefix . 'workload');
            return $workload ?: [];
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Get failed jobs count from Redis.
     */
    private function getFailedJobs($redis, string $prefix): array
    {
        try {
            $failedJobs = $redis->lrange($prefix . 'failed_jobs', 0, -1);
            return [
                'count' => count($failedJobs),
                'jobs' => array_slice($failedJobs, 0, 10), // Last 10 failed jobs
            ];
        } catch (\Exception $e) {
            return ['count' => 0, 'jobs' => []];
        }
    }

    /**
     * Get active masters from Redis.
     */
    private function getMasters($redis, string $prefix): array
    {
        try {
            $masters = $redis->hgetall($prefix . 'masters');
            return $masters ?: [];
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Get performance measures from Redis.
     */
    private function getMeasures($redis, string $prefix): array
    {
        try {
            $measures = $redis->hgetall($prefix . 'measures');
            return $measures ?: [];
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Get recent jobs from Redis.
     */
    private function getRecentJobs($redis, string $prefix): array
    {
        try {
            $recentJobs = $redis->lrange($prefix . 'recent_jobs', 0, 9);
            return $recentJobs ?: [];
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Get overall status of Horizon.
     */
    private function getStatus($redis, string $prefix): string
    {
        try {
            // Check if Horizon is running by looking for masters
            $masters = $redis->hgetall($prefix . 'masters');
            if (empty($masters)) {
                return 'inactive';
            }

            // Check for failed jobs
            $failedCount = $redis->llen($prefix . 'failed_jobs');
            if ($failedCount > 0) {
                return 'warning';
            }

            return 'active';
        } catch (\Exception $e) {
            return 'error';
        }
    }

    /**
     * Fetch metrics for all projects.
     *
     * @return array
     */
    public function fetchAllProjectsMetrics(): array
    {
        $projects = Project::all();
        $metrics = [];

        foreach ($projects as $project) {
            $metrics[] = $this->fetchMetrics($project);
        }

        return $metrics;
    }
}