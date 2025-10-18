@props([
    'page',
    'createRoute',
    'createLabel' => __('dashboard::dashboard.add-new'),
])

<!--begin::Toolbar-->
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <!--begin:: Main Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('dashboard.home') }}" class="text-muted text-hover-primary">
                        <i class="fa fa-home"></i>
                        @lang('dashboard::dashboard.home')
                    </a>
                </li>
                <!--end:: Main Item-->
                {{ $slot }}
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        @isset($createRoute)
            <!--begin::Actions-->
            <div class="d-flex align-items-center py-1">
                <!--begin::Button-->
                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app" id="kt_toolbar_primary_button">
                    <i class="fa fa-plus"></i>
                    {{ $createLabel }}
                </a>
                <!--end::Button-->
            </div>
            <!--end::Actions-->
        @endisset
    </div>
    <!--end::Container-->
</div>
<!--end::Toolbar-->
