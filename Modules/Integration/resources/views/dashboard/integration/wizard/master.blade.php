<!--begin::Stepper-->
<div id="client-wizard">
    <Wizard :collections="{{ json_encode(json_decode($collections))  }}" />
{{--    <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid" id="kt_create_account_stepper" data-kt-stepper="true">--}}
{{--        <!--begin::Aside-->--}}
{{--        @include('integration::dashboard.integration.wizard.aside')--}}
{{--        <!--end::Aside-->--}}

{{--        <!--begin::Content-->--}}
{{--        @include('integration::dashboard.integration.wizard.content')--}}
{{--        <!--end::Content-->--}}
{{--    </div>--}}
</div>
<!--end::Stepper-->

@push('js')
{{--    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>--}}

    @vite('Modules/Integration/resources/assets/js/app.js')
@endpush