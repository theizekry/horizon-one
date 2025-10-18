@props([
    'route',
    'name',
])

<a class="text-success font-bold" href="{{ $route }}" title="{{ __('dashboard::dashboard.see_more_details_about', ['about' => $name]) }}" >
    <i class="fas fa-external-link-alt"></i>
    {{ $name }}
</a>