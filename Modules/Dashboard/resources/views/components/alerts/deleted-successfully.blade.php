@props([
    'title' => __('dashboard::dashboard.deleted'),
    'text'  => session('record_deleted') ?: __('dashboard::dashboard.deleted_successfully'),
])

<script>
    Swal.fire({
        title: '{{ $title }}',
        text: '{{ $text }}',
        iconHtml: '<img class="foo" src="{{ asset('general/images/thumb/success-tick.png') }}">',
        timer: 2500,
        showConfirmButton: false,
        allowOutsideClick: false
    });
</script>
