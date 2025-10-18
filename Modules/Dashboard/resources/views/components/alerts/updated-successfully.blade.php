@props([
    'title' => __('dashboard::dashboard.updated'),
    'text'  => session('record_updated') ?? __('dashboard::dashboard.updated_successfully'),
])



@push('js')
    <script>
        Swal.fire({
            title: '{{ $title }}',
            text: '{{ $text }}',
            iconHtml: '<img class="foo" src="{{ asset('general/images/thumb/success-tick.png') }}">',
            timer: 2500,
            showConfirmButton: false,
            allowOutsideClick: false,
        });
    </script>
@endpush
