@props([
    'route',
    'for',
    'label' => '',
])

<a href="{{ $route }}" class='text-blue-500 mx-2 hover:text-blue-700' title="{{ __('dashboard::dashboard.show_details', ['for' => $for]) }}">
    <i class='fas fa-eye text-blue-700'></i> {{ $label }}
</a>