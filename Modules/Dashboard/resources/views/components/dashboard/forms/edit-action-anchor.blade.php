@props([
    'route',
    'title' => __('dashboard::dashboard.edit'),
])

<a href="{{ $route }}" class='mx-2' title= {{ $title }}>
    <i class='fas fa-edit text-blue-500'></i>
</a>