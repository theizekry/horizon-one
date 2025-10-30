<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Dashboard\Models\Project;
use Modules\HorizonPulse\Services\HorizonMetricsService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected HorizonMetricsService $metricsService;

    public function __construct(HorizonMetricsService $metricsService)
    {
        $this->metricsService = $metricsService;
    }

    /**
     * Display a listing of projects.
     */
    public function index()
    {
        $projects = Project::all();
        return view('dashboard::dashboard.projects.index', compact('projects'));
    }

    /**
     * Display the specified project with metrics.
     */
    public function show(Project $project)
    {
        $metrics = $this->metricsService->fetchProjectMetrics($project);
        return view('dashboard::dashboard.projects.show', compact('project', 'metrics'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        return view('dashboard::dashboard.projects.create');
    }

    /**
     * Store a newly created project.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:projects',
            'environment' => 'required|in:develop,testing,beta,uat,production',
            'redis_host' => 'required|string|max:255',
            'redis_port' => 'required|integer|min:1|max:65535',
            'redis_password' => 'nullable|string',
            'redis_db' => 'required|integer|min:0|max:15',
            'horizon_prefix' => 'required|string|max:255',
        ]);

        Project::create($request->all());

        return redirect()->route('dashboard.projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Show the form for editing the project.
     */
    public function edit(Project $project)
    {
        return view('dashboard::dashboard.projects.edit', compact('project'));
    }

    /**
     * Update the specified project.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:projects,name,' . $project->id,
            'environment' => 'required|in:develop,testing,beta,uat,production',
            'redis_host' => 'required|string|max:255',
            'redis_port' => 'required|integer|min:1|max:65535',
            'redis_password' => 'nullable|string',
            'redis_db' => 'required|integer|min:0|max:15',
            'horizon_prefix' => 'required|string|max:255',
        ]);

        $project->update($request->all());

        return redirect()->route('dashboard.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified project.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('dashboard.projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    /**
     * Get metrics for a project via AJAX.
     */
    public function getMetrics(Project $project)
    {
        $metrics = $this->metricsService->fetchProjectMetrics($project);
        return response()->json($metrics);
    }

    /**
     * Test Redis connection for a project.
     */
    public function testConnection(Request $request, Project $project)
    {
        try {
            $result = $this->metricsService->testConnection($project);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Connection test failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
