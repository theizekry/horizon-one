@extends('dashboard::dashboard.layouts.master')

@section('title', 'Manage Projects - Horizon Pulse')

@section('breadcrumbs')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Manage Projects
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('dashboard.home') }}" class="text-muted text-hover-primary">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('horizon-pulse.index') }}" class="text-muted text-hover-primary">Horizon Pulse</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Projects</li>
            </ul>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <a href="{{ route('dashboard.projects.create') }}" class="btn btn-sm fw-bold btn-primary">
                <i class="ki-duotone ki-plus fs-2"></i>Add Project
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row g-5 g-xl-10 mb-5 mb-xl-10">
    @forelse($projects as $project)
        <div class="col-md-6 col-lg-4 col-xl-3 col-xxl-3 mb-md-5 mb-xl-10">
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
                            <div class="symbol-label fs-2 fw-semibold text-primary bg-light-primary">
                                <i class="ki-duotone ki-server fs-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column content-justify-center flex-row-fluid">
                        <div class="d-flex fw-semibold align-items-center flex-lg-row mb-2">
                            <div class="d-flex align-items-center">
                                <span class="fs-6 fw-bold text-gray-500 me-2">Host:</span>
                                <span class="fs-6 fw-bold text-gray-800">{{ $project->redis_host }}:{{ $project->redis_port }}</span>
                            </div>
                        </div>
                        <div class="d-flex fw-semibold align-items-center flex-lg-row mb-2">
                            <div class="d-flex align-items-center">
                                <span class="fs-6 fw-bold text-gray-500 me-2">Database:</span>
                                <span class="fs-6 fw-bold text-gray-800">{{ $project->redis_db }}</span>
                            </div>
                        </div>
                        <div class="d-flex fw-semibold align-items-center flex-lg-row">
                            <div class="d-flex align-items-center">
                                <span class="fs-6 fw-bold text-gray-500 me-2">Prefix:</span>
                                <span class="fs-6 fw-bold text-gray-800">{{ $project->horizon_prefix ?: 'horizon' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer pt-0">
                    <div class="d-flex flex-stack">
                        <a href="{{ route('dashboard.projects.show', $project) }}" class="btn btn-sm btn-light-primary">
                            <i class="ki-duotone ki-eye fs-2"></i>View Details
                        </a>
                        <div class="d-flex align-items-center">
                            <span class="badge badge-light-primary fs-7">
                                {{ ucfirst($project->environment) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card card-flush">
                <div class="card-body text-center py-10">
                    <div class="mb-5">
                        <i class="ki-duotone ki-folder-up fs-3x text-gray-400"></i>
                    </div>
                    <h3 class="text-gray-600 mb-5">No Projects Found</h3>
                    <p class="text-gray-500 mb-5">No projects are configured yet. Add your first project to start monitoring Horizon.</p>
                    <a href="{{ route('dashboard.projects.create') }}" class="btn btn-primary">
                        <i class="ki-duotone ki-plus fs-2"></i>Add Your First Project
                    </a>
                </div>
            </div>
        </div>
    @endforelse
</div>
@endsection