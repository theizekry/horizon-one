@extends('dashboard::dashboard.layouts.master')

@section('title', 'Live Metrics - Horizon Pulse')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Live Metrics
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
                        <li class="breadcrumb-item text-muted">Live Metrics</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <button id="refresh-metrics" class="btn btn-sm fw-bold btn-primary">
                        <i class="ki-duotone ki-arrows-circle fs-2"></i>Refresh
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Metrics Grid -->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10" id="metrics-container">
        <div class="col-12 text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3">Loading metrics...</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let refreshInterval;
    
    function loadMetrics() {
        fetch('{{ route("dashboard.dashboard.test.metrics") }}', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin'
        })
        .then(response => {
            if (response.redirected || response.url.includes('/login')) {
                throw new Error('Authentication required');
            }
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            updateMetricsGrid(data);
        })
        .catch(error => {
            console.error('Error fetching metrics:', error);
            if (error.message === 'Authentication required') {
                document.getElementById('metrics-container').innerHTML = `
                    <div class="col-12">
                        <div class="alert alert-warning">
                            <h4 class="alert-heading">Authentication Required</h4>
                            <p>Please log in to view live metrics data.</p>
                            <a href="{{ route('dashboard.login.view') }}" class="btn btn-warning">Go to Login</a>
                        </div>
                    </div>
                `;
            } else {
                document.getElementById('metrics-container').innerHTML = `
                    <div class="col-12">
                        <div class="alert alert-danger">
                            <h4 class="alert-heading">Error Loading Metrics</h4>
                            <p>Failed to fetch metrics data: ${error.message}</p>
                            <button onclick="loadMetrics()" class="btn btn-danger">Try Again</button>
                        </div>
                    </div>
                `;
            }
        });
    }
    
    function updateMetricsGrid(metrics) {
        const container = document.getElementById('metrics-container');
        
        if (!metrics || metrics.length === 0) {
            container.innerHTML = `
                <div class="col-12">
                    <div class="card card-flush">
                        <div class="card-body text-center py-10">
                            <div class="mb-5">
                                <i class="ki-duotone ki-folder-up fs-3x text-gray-400"></i>
                            </div>
                            <h3 class="text-gray-600 mb-5">No Projects Found</h3>
                            <p class="text-gray-500 mb-5">No projects are configured yet.</p>
                            <a href="{{ route('dashboard.projects.create') }}" class="btn btn-primary">
                                <i class="ki-duotone ki-plus fs-2"></i>Add Your First Project
                            </a>
                        </div>
                    </div>
                </div>
            `;
            return;
        }
        
        let html = '';
        
        metrics.forEach(metric => {
            const statusColor = getStatusColor(metric.status);
            const statusIcon = getStatusIcon(metric.status);
            
            html += `
                <div class="col-md-6 col-lg-4 col-xl-3 col-xxl-3 mb-md-5 mb-xl-10">
                    <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">${metric.project_name}</span>
                                </div>
                                <span class="text-gray-400 pt-1 fw-bold fs-6">${metric.environment}</span>
                            </div>
                        </div>
                        <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                            <div class="d-flex flex-center me-5 pt-2">
                                <div class="symbol symbol-50px me-5">
                                    <div class="symbol-label fs-2 fw-semibold ${statusColor}">
                                        ${statusIcon}
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column content-justify-center flex-row-fluid">
                                <div class="d-flex fw-semibold align-items-center flex-lg-row mb-2">
                                    <div class="d-flex align-items-center">
                                        <span class="fs-6 fw-bold text-gray-500 me-2">Status:</span>
                                        <span class="fs-6 fw-bold text-gray-800">${metric.status.charAt(0).toUpperCase() + metric.status.slice(1)}</span>
                                    </div>
                                </div>
                                <div class="d-flex fw-semibold align-items-center flex-lg-row mb-2">
                                    <div class="d-flex align-items-center">
                                        <span class="fs-6 fw-bold text-gray-500 me-2">Failed Jobs:</span>
                                        <span class="fs-6 fw-bold ${metric.failed_jobs?.count > 0 ? 'text-danger' : 'text-success'}">${metric.failed_jobs?.count || 0}</span>
                                    </div>
                                </div>
                                <div class="d-flex fw-semibold align-items-center flex-lg-row">
                                    <div class="d-flex align-items-center">
                                        <span class="fs-6 fw-bold text-gray-500 me-2">Last Updated:</span>
                                        <span class="fs-6 fw-bold text-gray-800">${new Date(metric.last_updated).toLocaleTimeString()}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer pt-0">
                            <div class="d-flex flex-stack">
                                <a href="/dashboard/projects/${metric.project_id}" class="btn btn-sm btn-light-primary">
                                    View Details
                                </a>
                                <div class="d-flex align-items-center">
                                    <span class="badge badge-light-${metric.status === 'active' ? 'success' : metric.status === 'warning' ? 'warning' : 'danger'} fs-7">
                                        ${metric.status === 'active' ? 'Healthy' : metric.status === 'warning' ? 'Warning' : 'Error'}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });
        
        container.innerHTML = html;
    }
    
    function getStatusColor(status) {
        switch(status) {
            case 'active': return 'text-success bg-light-success';
            case 'warning': return 'text-warning bg-light-warning';
            case 'inactive': return 'text-gray bg-light-gray';
            default: return 'text-danger bg-light-danger';
        }
    }
    
    function getStatusIcon(status) {
        switch(status) {
            case 'active': return '<i class="ki-duotone ki-check fs-2x text-success"></i>';
            case 'warning': return '<i class="ki-duotone ki-warning fs-2x text-warning"></i>';
            case 'inactive': return '<i class="ki-duotone ki-pause fs-2x text-gray"></i>';
            default: return '<i class="ki-duotone ki-cross-circle fs-2x text-danger"></i>';
        }
    }
    
    // Manual refresh button
    document.getElementById('refresh-metrics').addEventListener('click', function() {
        loadMetrics();
    });
    
    // Initial load
    loadMetrics();
    
    // Set up auto-refresh every 30 seconds
    refreshInterval = setInterval(loadMetrics, 30000);
    
    // Clean up on page unload
    window.addEventListener('beforeunload', function() {
        if (refreshInterval) {
            clearInterval(refreshInterval);
        }
    });
});
</script>
@endpush
