@extends('dashboard::dashboard.layouts.master')

@section('title', 'Add New Project - Horizon Pulse')

@section('breadcrumbs')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Add New Project
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
                <li class="breadcrumb-item text-muted">Add Project</li>
            </ul>
        </div>
    </div>
</div>
@endsection

@section('content')
<x-dashboard::dashboard.card icon='fas fa-server' title="Add New Horizon Project">

    <div class="grid grid-cols-12 gap-x-5">

        <x-dashboard::dashboard.forms.core-input
                name="name"
                label="Project Name"
                required
                icon='fa fa-server'
                cols='col-span-6'
                placeholder="Enter project name"
        />

        <x-dashboard::dashboard.forms.select-input
                name="environment"
                label="Environment"
                required
                icon='fa fa-globe'
                cols='col-span-6'
                :data="[
                    'develop' => 'Develop',
                    'testing' => 'Testing',
                    'beta' => 'Beta',
                    'uat' => 'UAT',
                    'production' => 'Production'
                ]"
                placeholder="Select environment"
        />

        <x-dashboard::dashboard.forms.core-input
                name="redis_host"
                label="Redis Host"
                required
                icon='fa fa-database'
                cols='col-span-6'
                placeholder="127.0.0.1 or app.redis"
        />

        <x-dashboard::dashboard.forms.core-input
                name="redis_port"
                label="Redis Port"
                required
                icon='fa fa-plug'
                cols='col-span-6'
                type="number"
                placeholder="6379"
        />

        <x-dashboard::dashboard.forms.core-input
                name="redis_password"
                label="Redis Password"
                icon='fa fa-key'
                cols='col-span-6'
                type="password"
                placeholder="Leave empty if no password"
        />

        <x-dashboard::dashboard.forms.core-input
                name="redis_db"
                label="Redis Database"
                required
                icon='fa fa-database'
                cols='col-span-6'
                type="number"
                placeholder="0"
        />

        <x-dashboard::dashboard.forms.core-input
                name="horizon_prefix"
                label="Horizon Prefix"
                icon='fa fa-tag'
                cols='col-span-12'
                placeholder="horizon"
        />

    </div>

    <!--begin::Actions-->
    <x-dashboard::dashboard.forms.form-actions/>
    <!--End::Actions-->

</x-dashboard::dashboard.card>
@endsection