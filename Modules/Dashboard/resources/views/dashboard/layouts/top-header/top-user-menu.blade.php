
@php
    $admin = auth('admin')->user();
@endphp

<div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
    <!--begin::Menu wrapper-->
    <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
        <img src="{{ $admin->image ?? '' }}" alt="user" width="50" height="50" class="rounded-full"/>
    </div>
    <!--begin::Menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <div class="menu-content d-flex align-items-center px-3">
                <!--begin::Avatar-->
                <div class="symbol symbol-50px me-5">
                    <img alt="Logo" src="{{ $admin->image ?? '' }}" />
                </div>
                <!--end::Avatar-->
                <!--begin::Username-->
                <div class="d-flex flex-column">
                    <div class="fw-bolder d-flex align-items-center fs-5">
                        {{ $admin->name }}
                        <span class="badge fw-bolder fs-8 px-2 py-1 ms-2 badge-light-success">
                            Online
                        </span>
                    </div>
                    <a href="#" class="fw-bold text-muted text-hover-primary fs-7">
                        {{ $admin->email }}
                    </a>
                </div>
                <!--end::Username-->
            </div>
        </div>
        <!--end::Menu item-->
        <!--begin::Menu separator-->
        <div class="separator my-2"></div>
        <!--end::Menu separator-->
        <!--begin::Menu item-->
{{--        <div class="menu-item px-5">--}}
{{--            <a href="#" class="menu-link px-5" title="{{ __('dashboard::dashboard.edit_account') }}">--}}
{{--                <i class="fas fa-user-alt-slash mx-2"></i>--}}
{{--                @lang('dashboard::dashboard.profile')--}}
{{--            </a>--}}
{{--        </div>--}}
        <!--end::Menu item-->

{{--        <!--begin::Menu item-->--}}
{{--        <div class="menu-item px-5">--}}
{{--            <a href="{{ route('frontend.home') }}" class="menu-link px-5" title="{{ __('dashboard::dashboard.visit_website') }}">--}}
{{--                <i class="fas fa-home mx-2"></i>--}}
{{--                @lang('dashboard.text.visit_website')--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <!--end::Menu item-->--}}

{{--        <!--begin::Menu item-->--}}
{{--        <div class="menu-item px-5">--}}
{{--            <a href="#" class="menu-link px-5">--}}
{{--                @lang('dashboard.text.account-settings')--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <!--end::Menu item-->--}}
        <!--begin::Menu separator-->
        <div class="separator my-2"></div>
        <!--end::Menu separator-->

        <!--begin::Menu item-->
        @include('dashboard::dashboard.layouts.top-header.languages')
        <!--end::Menu item-->

{{--        <!--begin:: Manage Settings -->--}}
{{--        <div class="menu-item px-5">--}}
{{--            <a href="#" class="menu-link px-5" title="{{ __('dashboard::dashboard.manage-settings') }}">--}}
{{--                <i class="fas fa-cogs mx-2"></i>--}}
{{--                @lang('dashboard::dashboard.settings')--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <!--end:: Manage Settings -->--}}

        <!--begin::Menu item-->
        <div class="menu-item px-5">
            <a href="#" class="menu-link px-5" onclick="logoutAdmin()">
                <i class="fas fa-sign-out-alt mx-2"></i>
                {{ __('dashboard::dashboard.sign-out') }}
            </a>
        </div>
        <!--end::Menu item-->
        <!--begin::Menu separator-->
{{--        <div class="separator my-2"></div>--}}
        <!--end::Menu separator-->
{{--        <!--begin::Menu item-->--}}
{{--        <div class="menu-item px-5">--}}
{{--            <div class="menu-content px-5">--}}
{{--                <label class="form-check form-switch form-check-custom form-check-solid pulse pulse-success" for="kt_user_menu_dark_mode_toggle">--}}
{{--                    <input class="form-check-input w-30px h-20px" type="checkbox" value="1" name="mode" id="kt_user_menu_dark_mode_toggle" data-kt-url="../../demo1/dist/index.html" />--}}
{{--                    <span class="pulse-ring ms-n1"></span>--}}
{{--                    <span class="form-check-label text-gray-600 fs-7">Dark Mode</span>--}}
{{--                </label>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!--end::Menu item-->--}}
    </div>
    <!--end::Menu-->
    <!--end::Menu wrapper-->
</div>
