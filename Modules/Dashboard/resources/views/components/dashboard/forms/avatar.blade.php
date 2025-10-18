@props([
    'label' => __('dashboard::dashboard.logo'),
    'name',
    'extensions' => 'png, jpg, jpeg',
    'url'
])

<!--begin::Input group-->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-lg-4 col-form-label fw-bold fs-6">
        <i class="fa fa-image"></i>
        {{ $label }}
        <div class="form-text">@lang('dashboard.text.allowed-file-types'): {{ $extensions }}.</div>
    </label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-sm col-lg-6">
        <!--begin::Image input-->
        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{ asset('assets/dashboard/media/avatars/blank.png') }});">
            <!--begin::Preview existing avatar-->
            <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ $url }})"></div>
            <!--end::Preview existing avatar-->
            <!--begin::Label-->
            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                   data-kt-image-input-action="change"
                   data-bs-toggle="tooltip"
                   title="{{ __('dashboard::dashboard.change-image') }}"
                   data-bs-original-title="{{ __('dashboard::dashboard.change-image') }}">
                <i class="bi bi-pencil-fill fs-7"></i>
                <!--begin::Inputs-->
                <input type="file" name="{{ $name }}" accept=".png, .jpg, .jpeg" />
                <input type="hidden" name="" />
                <!--end::Inputs-->
            </label>
            <!--end::Label-->
            <!--begin::Remove-->
{{--            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"--}}
{{--                  data-kt-image-input-action="remove"--}}
{{--                  data-bs-toggle="tooltip"--}}
{{--                  title="" data-bs-original-title="{{ __('dashboard::dashboard.delete-image') }}">--}}
{{--                <i class="bi bi-x fs-2"></i>--}}
{{--            </span>--}}
            <!--end::Remove-->
        </div>
        <!--end::Image input-->
        <!--begin::Hint-->

        <!--end::Hint-->
    </div>
    <small class="text-danger">{{ $errors->first($name) }}</small>
    <!--end::Col-->
</div>
<!--end::Input group-->
