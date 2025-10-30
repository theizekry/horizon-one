<?php

namespace Modules\HorizonPulse\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Modules\Dashboard\Models\Project;
use Modules\Core\Http\Controllers\CoreController;
use Modules\HorizonPulse\Services\HorizonMetricsService;

class HorizonPulseController extends CoreController
{
    protected HorizonMetricsService $metricsService;

    public function __construct(HorizonMetricsService $metricsService)
    {
        $this->metricsService = $metricsService;
    }

    /**
     * Display the Horizon Pulse dashboard
     */
    public function index()
    {
        return view('horizonpulse::index');
    }

    /**
     * Get metrics for all projects
     */
    public function getAllMetrics(): JsonResponse
    {
        try {
            $metrics = $this->metricsService->fetchAllProjectsMetrics();

            return response()->json($metrics);
        } catch (\Exception $e) {
            return response()->json([
                'error'   => 'Failed to fetch metrics',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get metrics for a specific project
     */
    public function getProjectMetrics(Project $project): JsonResponse
    {
        try {
            $metrics = $this->metricsService->fetchProjectMetrics($project);

            return response()->json($metrics);
        } catch (\Exception $e) {
            return response()->json([
                'error'   => 'Failed to fetch project metrics',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Test Redis connection for a project
     */
    public function testConnection(Request $request, Project $project): JsonResponse
    {
        try {
            $result = $this->metricsService->testConnection($project);

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Connection test failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get project overview statistics
     */
    public function getOverview(): JsonResponse
    {
        try {
            $projects = Project::all();
            $metrics  = $this->metricsService->fetchAllProjectsMetrics();

            $overview = [
                'total_projects'       => $projects->count(),
                'active_projects'      => collect($metrics)->where('status', 'active')->count(),
                'warning_projects'     => collect($metrics)->where('status', 'warning')->count(),
                'error_projects'       => collect($metrics)->where('status', 'error')->count(),
                'total_failed_jobs'    => collect($metrics)->sum('failed_jobs.count'),
                'average_throughput'   => $this->calculateAverageThroughput($metrics),
                'average_memory_usage' => $this->calculateAverageMemoryUsage($metrics),
            ];

            return response()->json($overview);
        } catch (\Exception $e) {
            return response()->json([
                'error'   => 'Failed to fetch overview',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Calculate average throughput across all projects
     */
    protected function calculateAverageThroughput(array $metrics): string
    {
        $total = 0;
        $count = 0;

        foreach ($metrics as $metric) {
            if (isset($metric['measures']['throughput'])) {
                $throughput = $metric['measures']['throughput'];
                $value      = (int) explode('/', $throughput)[0];
                $total += $value;
                $count++;
            }
        }

        return $count > 0 ? round($total / $count) . '/min' : '0/min';
    }

    /**
     * Calculate average memory usage across all projects
     */
    protected function calculateAverageMemoryUsage(array $metrics): string
    {
        $total = 0;
        $count = 0;

        foreach ($metrics as $metric) {
            if (isset($metric['measures']['memory_usage'])) {
                $memory = $metric['measures']['memory_usage'];
                $value  = (int) str_replace('MB', '', $memory);
                $total += $value;
                $count++;
            }
        }

        return $count > 0 ? round($total / $count) . 'MB' : '0MB';
    }
}
