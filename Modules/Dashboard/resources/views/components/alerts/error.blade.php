@props([
    'title' => __('dashboard::dashboard.error'),
    'text'  => session('error') ?: __('dashboard::dashboard.something_went_wrong'),
])

<script>
    Swal.fire({
        title: '{{ $title }}',
        text: '{{ $text }}',
        icon: 'error',
        timer: 3000,
        showConfirmButton: false,
        allowOutsideClick: false
    });
</script>
