@props([
    'title' => __('dashboard::dashboard.success'),
    'text'  => session('success') ?: __('dashboard::dashboard.success_done'),
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
