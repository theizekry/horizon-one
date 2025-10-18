{{--@extends('dashboard::dashboard.layouts.master')--}}

{{--@section('title', __('dashboard::dashboard.manage_customers'))--}}

{{--@section('breadcrumbs')--}}
{{--    <x-dashboard::dashboard.breadcrumb.breadcrumb>--}}
{{--        <x-dashboard::dashboard.breadcrumb.breadcrumb-item--}}
{{--                label="{{ __('dashboard::dashboard.manage_customers') }}"--}}
{{--                route="{{ route('dashboard.customers.index') }}"--}}
{{--        />--}}
{{--        <x-dashboard::dashboard.breadcrumb.breadcrumb-item--}}
{{--                label="{{ __('dashboard::dashboard.account_details') }}"--}}
{{--                active--}}
{{--        />--}}
{{--    </x-dashboard.breadcrumb.breadcrumb>--}}
{{--@endsection--}}

{{--@section('content')--}}

{{--    <div class="card mb-5 mb-xl-10">--}}
{{--        <div class="card-body pt-9 pb-0">--}}
{{--            <!--begin::Details-->--}}
{{--            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">--}}
{{--                <!--begin: Pic-->--}}
{{--                <div class="me-7 mb-4">--}}
{{--                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">--}}
{{--                        <img src="{{ asset('general/images/thumb/person-placeholder.jpg') }}" alt="image">--}}
{{--                        <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!--end::Pic-->--}}
{{--                <!--begin::Info-->--}}
{{--                <div class="flex-grow-1">--}}
{{--                    <!--begin::Title-->--}}
{{--                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">--}}
{{--                        <!--begin::User-->--}}
{{--                        <div class="d-flex flex-column">--}}
{{--                            <!--begin::Name-->--}}
{{--                            <div class="d-flex align-items-center mb-2">--}}
{{--                                <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{ $customer->name }}</a>--}}
{{--                                <a href="#">--}}
{{--                                    <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->--}}
{{--                                    <span class="svg-icon svg-icon-1 svg-icon-primary">--}}
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">--}}
{{--                                            <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF"></path>--}}
{{--                                            <path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white"></path>--}}
{{--                                        </svg>--}}
{{--                                    </span>--}}
{{--                                    <!--end::Svg Icon-->--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <!--end::Name-->--}}
{{--                            <!--begin::Info-->--}}
{{--                            <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">--}}
{{--                                <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">--}}
{{--                                    <i class="fas fa-at sm:mx-1"></i>--}}
{{--                                    {{ $customer->email }}--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <!--end::Info-->--}}
{{--                        </div>--}}
{{--                        <!--end::User-->--}}
{{--                    </div>--}}
{{--                    <!--end::Title-->--}}
{{--                </div>--}}
{{--                <!--end::Info-->--}}
{{--            </div>--}}
{{--            <!--end::Details-->--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">--}}
{{--        <!--begin::Card header-->--}}
{{--        <div class="card-header cursor-pointer">--}}
{{--            <!--begin::Card title-->--}}
{{--            <div class="card-title m-0">--}}
{{--                <h3 class="fw-bolder m-0">--}}
{{--                    <i class="fa fa-user"></i>--}}
{{--                    {{ __('dashboard::dashboard.account_details') }}--}}
{{--                </h3>--}}
{{--            </div>--}}
{{--            <!--end::Card title-->--}}
{{--            <!--begin::Action-->--}}
{{--            @permission('update-customers')--}}
{{--                <a href="{{ route('dashboard.customers.edit', [$customer->id]) }}" class="btn btn-primary align-self-center">--}}
{{--                        {{ __('dashboard::dashboard.edit_account_data') }}--}}
{{--                </a>--}}
{{--            @endpermission--}}
{{--            <!--end::Action-->--}}
{{--        </div>--}}
{{--        <!--begin::Card header-->--}}
{{--        <!--begin::Card body-->--}}
{{--        <div class="card-body p-9">--}}
{{--            <!--begin::Row-->--}}
{{--            <div class="row mb-7">--}}
{{--                <!--begin::Label-->--}}
{{--                <label class="col-lg-4 fw-bold text-muted">--}}
{{--                    {{ __('dashboard::dashboard.name') }}--}}
{{--                </label>--}}
{{--                <!--end::Label-->--}}
{{--                <!--begin::Col-->--}}
{{--                <div class="col-lg-8">--}}
{{--                    <span class="fw-bolder fs-6 text-gray-800">--}}
{{--                        {{ $customer->name }}--}}
{{--                    </span>--}}
{{--                </div>--}}
{{--                <!--end::Col-->--}}
{{--            </div>--}}
{{--            <!--end::Row-->--}}
{{--            <!--begin::Input group-->--}}
{{--            <div class="row mb-7">--}}
{{--                <!--begin::Label-->--}}
{{--                <label class="col-lg-4 fw-bold text-muted">--}}
{{--                    {{ __('dashboard::dashboard.email') }}--}}
{{--                </label>--}}
{{--                <!--end::Label-->--}}
{{--                <!--begin::Col-->--}}
{{--                <div class="col-lg-8 d-flex align-items-center">--}}
{{--                    <span class="fw-bolder fs-6 text-gray-800 me-2">--}}
{{--                        {{ $customer->email }}--}}
{{--                    </span>--}}
{{--                </div>--}}
{{--                <!--end::Col-->--}}
{{--            </div>--}}
{{--            <div class="row mb-7">--}}
{{--                <!--begin::Label-->--}}
{{--                <label class="col-lg-4 fw-bold text-muted">--}}
{{--                    {{ __('dashboard::dashboard.phone_number') }}--}}
{{--                </label>--}}
{{--                <!--end::Label-->--}}
{{--                <!--begin::Col-->--}}
{{--                <div class="col-lg-8 d-flex align-items-center">--}}
{{--                    <span class="fw-bolder fs-6 text-black-800 me-2">--}}
{{--                        @permission('see-phone-number-customers')--}}
{{--                        @else--}}
{{--                            <span title="{{ __('dashboard::dashboard.not_permitted_to_see_phone') }}">***********</span>--}}
{{--                        @endpermission--}}
{{--                    </span>--}}
{{--                </div>--}}
{{--                <!--end::Col-->--}}
{{--            </div>--}}
{{--            <!--end::Input group-->--}}
{{--            <!--begin::Input group-->--}}
{{--            <div class="row mb-7">--}}
{{--                <!--begin::Label-->--}}
{{--                <label class="col-lg-4 fw-bold text-muted">--}}
{{--                    {{ __('dashboard::dashboard.created_at') }}--}}
{{--                </label>--}}
{{--                <!--end::Label-->--}}
{{--                <!--begin::Col-->--}}
{{--                <div class="col-lg-8">--}}
{{--                    <span class="fw-bolder fs-6 text-gray-800">--}}
{{--                        {{ $customer->created_at }}--}}
{{--                    </span>--}}
{{--                </div>--}}
{{--                <!--end::Col-->--}}
{{--            </div>--}}
{{--            <!--end::Input group-->--}}
{{--            <!--begin::Input group-->--}}
{{--            <div class="row mb-10">--}}
{{--                <!--begin::Label-->--}}
{{--                <label class="col-lg-4 fw-bold text-muted">--}}
{{--                    {{ __('dashboard::dashboard.updated_at') }}--}}
{{--                </label>--}}
{{--                <!--begin::Label-->--}}
{{--                <!--begin::Label-->--}}
{{--                <div class="col-lg-8">--}}
{{--                    {{ $customer->updated_at }}--}}
{{--                </div>--}}
{{--                <!--begin::Label-->--}}
{{--            </div>--}}
{{--            <!--end::Input group-->--}}
{{--            <!--begin::Input group-->--}}
{{--            <div class="row mb-10">--}}
{{--                <!--begin::Label-->--}}
{{--                <label class="col-lg-4 fw-bold text-muted">--}}
{{--                    {{ __('dashboard::dashboard.created_by') }}--}}
{{--                </label>--}}
{{--                <!--begin::Label-->--}}
{{--                <!--begin::Label-->--}}
{{--                <div class="col-lg-8">--}}
{{--                    <x-dashboard::dashboard.forms.createdby-anchor route="{{ route('dashboard.admins.show', [$customer->createdBy->id]) }}" name="{{ $customer->createdBy->name }}"/>--}}
{{--                </div>--}}
{{--                <!--begin::Label-->--}}
{{--            </div>--}}
{{--            <!--end::Input group-->--}}
{{--        </div>--}}
{{--        <!--end::Card body-->--}}
{{--    </div>--}}

{{--@endsection--}}