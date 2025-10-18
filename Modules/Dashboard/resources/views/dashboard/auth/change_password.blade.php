@extends('dashboard::dashboard.layouts.master')

@section('breadcrumbs')
    <x-dashboard::dashboard.breadcrumb.breadcrumb>
        <x-dashboard::dashboard.breadcrumb.breadcrumb-item
                label="{{ __('dashboard::dashboard.account') }}"
        />
        <x-dashboard::dashboard.breadcrumb.breadcrumb-item
                label="{{ __('dashboard::dashboard.change_password') }}"
                active
        />
    </x-dashboard::dashboard.breadcrumb.breadcrumb>
@endsection

@section('content')

    <x-dashboard::dashboard.card icon='fas fa-lock' title="{{ __('dashboard::dashboard.change_your_password') }}">
        <x-dashboard::dashboard.forms.form
                action="{{ route('dashboard.change-password.update') }}"
                method="patch"
                class="form-horizontal"
        >

        <x-dashboard::dashboard.forms.password-input
                name='current_password'
                label="{{__('dashboard::dashboard.current_password')}}"
                required
                cols='col-span-7'
                icon='fas fa-lock'
        />

        <x-dashboard::dashboard.forms.password-input
                name='new_password'
                label="{{__('dashboard::dashboard.new_password')}}"
                required
                cols='col-span-7'
                icon='fas fa-key'
        />

        <x-dashboard::dashboard.forms.password-input
                name='new_password_confirmation'
                label="{{__('dashboard::dashboard.password_confirmation')}}"
                required
                cols='col-span-7'
                icon='fas fa-key'
        />

        <!--begin::Actions-->
        <x-dashboard::dashboard.forms.form-actions/>
        <!--End::Actions-->

        </x-dashboard::dashboard.forms.form>
    </x-dashboard::dashboard.card>

@endsection