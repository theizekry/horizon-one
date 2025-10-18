<!--begin::Javascript-->

<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('assets/dashboard/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/scripts.bundle.js') }}"></script>

<!--end::Global Javascript Bundle-->

<!--begin::Custom Javascript -->

<!-- Begin :: Tailwind -->
<script src="{{ asset('general/js/tailwind.js') }}"></script>
<!-- End :: Tailwind -->

<!-- Begin :: tinymce -->
{{--@include('dashboard::blade-assets.general.tinymce')--}}
<!-- End :: tinymce -->

<script src="{{ asset('assets/dashboard/custom/js/plugins/quicksearch/quicksearch.min.js') }}"></script>
<!--end::Custom Javascript -->

<!-- Begin :: Sweetalert -->

@include('dashboard::components.delete-confirmation-dialog')
@include('dashboard::components.confirmation-dialog')

{{--@include('dashboard::blade-assets.general.alert.messenger')--}}
@include('dashboard::blade-assets.general.messenger')
<!--end:: Sweetalert -->

<script>
    $(document).ready(function() {
        $('.select2-class').select2();
    });

    $('input.sidebar-search').quicksearch('.page-sidebar .menu-item');
</script>

{{-- Allow vue to access Laravel routes --}}
@routes()

@stack('js')
<!--end::Javascript-->
