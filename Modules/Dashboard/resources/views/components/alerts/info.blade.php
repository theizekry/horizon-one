@props([
    'title' => __('dashboard::dashboard.info'),
    'text'  => session('information') ?: __('dashboard::dashboard.info'),
])

<script>
    Swal.fire({
        title: '{{ $title }}',
        text: '{{ $text }}',
        icon: 'info',
        timer: 3000,
        showConfirmButton: false,
        allowOutsideClick: false
    });
</script>
