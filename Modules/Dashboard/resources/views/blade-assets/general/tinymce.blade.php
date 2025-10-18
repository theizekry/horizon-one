<script src="{{ asset('assets/dashboard/custom/js/plugins/tinymce/tinymce.min.js') }}"></script>

@if(app()->getLocale() === 'ar')
    <script src="{{ asset('assets/dashboard/custom/js/plugins/tinymce/ar.js') }}"></script>
@endif

<script>
    tinymce.init({
        selector: '.editor',
        plugins: ' advlist image media autolink code codesample directionality table wordcount quickbars link lists numlist bullist fullscreen',
        {{--images_upload_url:"{{ route('admin.upload.image', ['_token' => csrf_token() ]) }}",--}}
        file_picker_types: 'file image media',
        image_caption: true,
        image_dimensions: true,
        directionality: 'ltr',
        language: '{{ app()->getLocale() }}',
        quickbars_selection_toolbar: 'bold italic |h1 h2 h3 h4 h5 h6| formatselect | quicklink blockquote | numlist bullist',
        entity_encoding: 'raw',
        verify_html: true,
        object_resizing: true,
        resize: 'both'
    });
</script>
