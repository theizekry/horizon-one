{{--@extends('dashboard::dashboard.layouts.master')--}}

{{--@section('title', __('dashboard::dashboard.manage_customers'))--}}

{{--@section('breadcrumbs')--}}
{{--    <x-dashboard::dashboard.breadcrumb.breadcrumb>--}}
{{--        <x-dashboard::dashboard.breadcrumb.breadcrumb-item--}}
{{--                label="{{ __('dashboard::dashboard.manage_customers') }}"--}}
{{--                route="{{ route('dashboard.customers.index') }}"--}}
{{--        />--}}
{{--        <x-dashboard::dashboard.breadcrumb.breadcrumb-item--}}
{{--                label="{{ __('dashboard::dashboard.edit') }}"--}}
{{--                active--}}
{{--        />--}}
{{--        </x-dashboard.breadcrumb.breadcrumb>--}}
{{--@endsection--}}

{{--@section('content')--}}

{{--    {!! Form::model($customer, ['route' => ['dashboard.customers.update', $customer->id], 'method' => 'patch']) !!}--}}

{{--    @include('dashboard::dashboard.integration._form', ['action_type' => 'edit'])--}}

{{--    {!! Form::close() !!}--}}

{{--@endsection--}}