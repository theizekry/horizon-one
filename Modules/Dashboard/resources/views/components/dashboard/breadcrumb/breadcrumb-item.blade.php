@props([
    'label',
    'route' => '#',
    'active' => false,
    'icon'   => ''
 ])

<!--begin::Item-->
<li class="breadcrumb-item">
    <span class="bullet bg-gray-200 w-5px h-2px"></span>
</li>
<!--end::Item-->

<!--begin::Item-->
<li class="breadcrumb-item text-muted">
    <a href="{{ $route }}" class="{{ ($active) ? 'text-blue-500' : 'text-muted'}} ">
        {!! $icon !!} {{ $label }}
    </a>
</li>
<!--end::Item-->