@props([
    'route',
    'title',
    'icon',
    'label' => '',
])

<a href="{{ $route }}" class='text-blue-500 mx-2 hover:text-blue-700' title='{{ $title }}'>
    <i class='{{ $icon }}'></i>
    @if($label)
        {{ $label }}
    @endif
</a>