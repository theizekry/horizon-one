@extends('dashboard::dashboard.layouts.master')

@section('title', __('dashboard::dashboard.manage_admins'))

@section('breadcrumbs')
    <x-dashboard::dashboard.breadcrumb.breadcrumb>
        <x-dashboard::dashboard.breadcrumb.breadcrumb-item
                label="{{ __('dashboard::dashboard.manage_admins') }}"
                route="{{ route('dashboard.admins.index') }}"
        />
        <x-dashboard::dashboard.breadcrumb.breadcrumb-item
                label="{{ __('dashboard::dashboard.edit') }}"
                active
        />
    </x-dashboard::dashboard.breadcrumb.breadcrumb>
@endsection

@section('content')

    <x-dashboard::dashboard.forms.form
            action="{{ route('dashboard.admins.update', $admin->id) }}"
            method="PATCH"
            multipart
            class="form-horizontal"
            :model="$admin"
    >

        @include('dashboard::dashboard.admin._form', ['action_type' => 'edit'])

    </x-dashboard::dashboard.forms.form>

@endsection