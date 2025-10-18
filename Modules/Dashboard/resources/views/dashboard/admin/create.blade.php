@extends('dashboard::dashboard.layouts.master')

@section('title', __('dashboard::dashboard.manage_admins'))

@section('breadcrumbs')
    <x-dashboard::dashboard.breadcrumb.breadcrumb>
        <x-dashboard::dashboard.breadcrumb.breadcrumb-item
                label="{{ __('dashboard::dashboard.manage_admins') }}"
                route="{{ route('dashboard.admins.index') }}"
        />
        <x-dashboard::dashboard.breadcrumb.breadcrumb-item
                label="{{ __('dashboard::dashboard.add-new') }}"
                active
        />
    </x-dashboard::dashboard.breadcrumb.breadcrumb>
@endsection

@section('content')
    <x-dashboard::dashboard.forms.form
            action="{{ route('dashboard.admins.store') }}"
            method="POST"
            multipart
            class="form-horizontal"
    >
        @include('dashboard::dashboard.admin._form', ['action_type' => 'add'])
    </x-dashboard::dashboard.forms.form>


@endsection