@extends('dashboard::dashboard.layouts.master')

@section('title', 'Project Details - ' . $project->name)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Project Details
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard.home') }}" class="text-muted text-hover-primary">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard.projects.index') }}" class="text-muted text-hover-primary">Projects</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">{{ $project->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Info Card -->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <div class="d-flex align-items-center">
                            <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">{{ $project->name }}</span>
                        </div>
                        <span class="text-gray-400 pt-1 fw-bold fs-6">{{ $project->environment }}</span>
                    </div>
                </div>
                <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                    <div class="d-flex flex-center me-5 pt-2">
                        <div class="symbol symbol-50px me-5">
                            <div class="symbol-label fs-2 fw-semibold text-success bg-light-success">
                                {{ strtoupper(substr($project->name, 0, 2)) }}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column content-justify-center flex-row-fluid">
                        <div class="d-flex fw-semibold align-items-center flex-lg-row">
                            <div class="d-flex align-items-center mb-3 mb-lg-0">
                                <span class="fs-6 fw-bold text-gray-500 me-2">Redis Host:</span>
                                <span class="fs-6 fw-bold text-gray-800">{{ $project->redis_host }}:{{ $project->redis_port }}</span>
                            </div>
                        </div>
                        <div class="d-flex fw-semibold align-items-center flex-lg-row">
                            <div class="d-flex align-items-center mb-3 mb-lg-0">
                                <span class="fs-6 fw-bold text-gray-500 me-2">Database:</span>
                                <span class="fs-6 fw-bold text-gray-800">{{ $project->redis_db }}</span>
                            </div>
                        </div>
                        <div class="d-flex fw-semibold align-items-center flex-lg-row">
                            <div class="d-flex align-items-center mb-3 mb-lg-0">
                                <span class="fs-6 fw-bold text-gray-500 me-2">Horizon Prefix:</span>
                                <span class="fs-6 fw-bold text-gray-800">{{ $project->horizon_prefix }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Card -->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <div class="d-flex align-items-center">
                            <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">Status</span>
                        </div>
                        <span class="text-gray-400 pt-1 fw-bold fs-6">Horizon Status</span>
                    </div>
                </div>
                <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                    <div class="d-flex flex-center me-5 pt-2">
                        <div class="symbol symbol-50px me-5">
                            <div class="symbol-label fs-2 fw-semibold text-success bg-light-success" id="status-icon">
                                <i class="ki-duotone ki-check fs-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column content-justify-center flex-row-fluid">
                        <div class="d-flex fw-semibold align-items-center flex-lg-row">
                            <div class="d-flex align-items-center mb-3 mb-lg-0">
                                <span class="fs-6 fw-bold text-gray-500 me-2">Status:</span>
                                <span class="fs-6 fw-bold text-gray-800" id="status-text">Loading...</span>
                            </div>
                        </div>
                        <div class="d-flex fw-semibold align-items-center flex-lg-row">
                            <div class="d-flex align-items-center mb-3 mb-lg-0">
                                <span class="fs-6 fw-bold text-gray-500 me-2">Last Updated:</span>
                                <span class="fs-6 fw-bold text-gray-800" id="last-updated">-</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Metrics Cards -->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!-- Workload Card -->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <div class="d-flex align-items-center">
                            <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">Workload</span>
                        </div>
                        <span class="text-gray-400 pt-1 fw-bold fs-6">Queue Workload</span>
                    </div>
                </div>
                <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                    <div class="d-flex flex-center me-5 pt-2">
                        <div class="symbol symbol-50px me-5">
                            <div class="symbol-label fs-2 fw-semibold text-primary bg-light-primary">
                                <i class="ki-duotone ki-chart-simple fs-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column content-justify-center flex-row-fluid">
                        <div id="workload-content">
                            <div class="d-flex fw-semibold align-items-center flex-lg-row">
                                <div class="d-flex align-items-center mb-3 mb-lg-0">
                                    <span class="fs-6 fw-bold text-gray-500 me-2">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Failed Jobs Card -->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <div class="d-flex align-items-center">
                            <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">Failed Jobs</span>
                        </div>
                        <span class="text-gray-400 pt-1 fw-bold fs-6">Failed Job Count</span>
                    </div>
                </div>
                <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                    <div class="d-flex flex-center me-5 pt-2">
                        <div class="symbol symbol-50px me-5">
                            <div class="symbol-label fs-2 fw-semibold text-danger bg-light-danger">
                                <i class="ki-duotone ki-cross-circle fs-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column content-justify-center flex-row-fluid">
                        <div id="failed-jobs-content">
                            <div class="d-flex fw-semibold align-items-center flex-lg-row">
                                <div class="d-flex align-items-center mb-3 mb-lg-0">
                                    <span class="fs-6 fw-bold text-gray-500 me-2">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Metrics Table -->
    <div class="row g-5 g-xl-10">
        <div class="col-xxl-12">
            <div class="card card-flush">
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <div class="d-flex align-items-center">
                            <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">Detailed Metrics</span>
                        </div>
                        <span class="text-gray-400 pt-1 fw-bold fs-6">Real-time Horizon Metrics</span>
                    </div>
                </div>
                <div class="card-body pt-2 pb-4">
                    <div id="detailed-metrics">
                        <div class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-3">Loading metrics...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let refreshInterval;
    
    function updateMetrics() {
        fetch(`{{ route('dashboard.projects.metrics', $project->id) }}`)
            .then(response => response.json())
            .then(data => {
                updateStatus(data);
                updateWorkload(data);
                updateFailedJobs(data);
                updateDetailedMetrics(data);
            })
            .catch(error => {
                console.error('Error fetching metrics:', error);
                document.getElementById('status-text').textContent = 'Error';
                document.getElementById('status-icon').innerHTML = '<i class="ki-duotone ki-cross-circle fs-2x text-danger"></i>';
            });
    }
    
    function updateStatus(data) {
        const statusText = document.getElementById('status-text');
        const statusIcon = document.getElementById('status-icon');
        const lastUpdated = document.getElementById('last-updated');
        
        if (data.error) {
            statusText.textContent = 'Error';
            statusIcon.innerHTML = '<i class="ki-duotone ki-cross-circle fs-2x text-danger"></i>';
        } else {
            statusText.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
            
            switch(data.status) {
                case 'active':
                    statusIcon.innerHTML = '<i class="ki-duotone ki-check fs-2x text-success"></i>';
                    break;
                case 'warning':
                    statusIcon.innerHTML = '<i class="ki-duotone ki-warning fs-2x text-warning"></i>';
                    break;
                case 'inactive':
                    statusIcon.innerHTML = '<i class="ki-duotone ki-pause fs-2x text-gray"></i>';
                    break;
                default:
                    statusIcon.innerHTML = '<i class="ki-duotone ki-cross-circle fs-2x text-danger"></i>';
            }
        }
        
        if (data.last_updated) {
            lastUpdated.textContent = new Date(data.last_updated).toLocaleString();
        }
    }
    
    function updateWorkload(data) {
        const workloadContent = document.getElementById('workload-content');
        
        if (data.error) {
            workloadContent.innerHTML = '<span class="fs-6 fw-bold text-danger">Connection Error</span>';
            return;
        }
        
        if (data.workload && Object.keys(data.workload).length > 0) {
            let html = '';
            for (const [queue, count] of Object.entries(data.workload)) {
                html += `<div class="d-flex fw-semibold align-items-center flex-lg-row mb-2">
                    <div class="d-flex align-items-center">
                        <span class="fs-6 fw-bold text-gray-500 me-2">${queue}:</span>
                        <span class="fs-6 fw-bold text-gray-800">${count}</span>
                    </div>
                </div>`;
            }
            workloadContent.innerHTML = html;
        } else {
            workloadContent.innerHTML = '<span class="fs-6 fw-bold text-gray-500">No workload data</span>';
        }
    }
    
    function updateFailedJobs(data) {
        const failedJobsContent = document.getElementById('failed-jobs-content');
        
        if (data.error) {
            failedJobsContent.innerHTML = '<span class="fs-6 fw-bold text-danger">Connection Error</span>';
            return;
        }
        
        if (data.failed_jobs) {
            const count = data.failed_jobs.count || 0;
            const color = count > 0 ? 'text-danger' : 'text-success';
            failedJobsContent.innerHTML = `
                <div class="d-flex fw-semibold align-items-center flex-lg-row">
                    <div class="d-flex align-items-center mb-3 mb-lg-0">
                        <span class="fs-6 fw-bold text-gray-500 me-2">Count:</span>
                        <span class="fs-6 fw-bold ${color}">${count}</span>
                    </div>
                </div>
            `;
        } else {
            failedJobsContent.innerHTML = '<span class="fs-6 fw-bold text-gray-500">No failed jobs data</span>';
        }
    }
    
    function updateDetailedMetrics(data) {
        const detailedMetrics = document.getElementById('detailed-metrics');
        
        if (data.error) {
            detailedMetrics.innerHTML = `
                <div class="alert alert-danger">
                    <h4 class="alert-heading">Connection Error</h4>
                    <p>${data.error}</p>
                </div>
            `;
            return;
        }
        
        let html = '<div class="table-responsive">';
        html += '<table class="table table-striped">';
        html += '<thead><tr><th>Metric</th><th>Value</th></tr></thead>';
        html += '<tbody>';
        
        // Masters
        if (data.masters && Object.keys(data.masters).length > 0) {
            html += '<tr><td colspan="2"><strong>Active Masters</strong></td></tr>';
            for (const [master, info] of Object.entries(data.masters)) {
                html += `<tr><td>${master}</td><td>${info}</td></tr>`;
            }
        }
        
        // Measures
        if (data.measures && Object.keys(data.measures).length > 0) {
            html += '<tr><td colspan="2"><strong>Performance Measures</strong></td></tr>';
            for (const [measure, value] of Object.entries(data.measures)) {
                html += `<tr><td>${measure}</td><td>${value}</td></tr>`;
            }
        }
        
        // Recent Jobs
        if (data.recent_jobs && data.recent_jobs.length > 0) {
            html += '<tr><td colspan="2"><strong>Recent Jobs</strong></td></tr>';
            data.recent_jobs.forEach(job => {
                html += `<tr><td colspan="2">${job}</td></tr>`;
            });
        }
        
        html += '</tbody></table></div>';
        
        if (html === '<div class="table-responsive"><table class="table table-striped"><thead><tr><th>Metric</th><th>Value</th></tr></thead><tbody></tbody></table></div>') {
            html = '<div class="alert alert-info"><p>No detailed metrics available</p></div>';
        }
        
        detailedMetrics.innerHTML = html;
    }
    
    // Initial load
    updateMetrics();
    
    // Set up auto-refresh every 15 seconds
    refreshInterval = setInterval(updateMetrics, 15000);
    
    // Clean up on page unload
    window.addEventListener('beforeunload', function() {
        if (refreshInterval) {
            clearInterval(refreshInterval);
        }
    });
});
</script>
@endpush
