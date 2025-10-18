@extends('dashboard::dashboard.layouts.master')

@section('title', __('dashboard::dashboard.manage_integrations'))

@section('breadcrumbs')
    <x-dashboard::dashboard.breadcrumb.breadcrumb>
        <x-dashboard::dashboard.breadcrumb.breadcrumb-item
                label="{{ __('dashboard::dashboard.manage_integrations') }}"
                route="{{ route('dashboard.integrations.index') }}"
        />
        <x-dashboard::dashboard.breadcrumb.breadcrumb-item
                label="{{ __('dashboard::dashboard.add-new') }}"
                active
        />
    </x-dashboard::dashboard.breadcrumb.breadcrumb>
@endsection

@section('content')
    @include('integration::dashboard.integration.wizard.master', compact('collections'))
@endsection