@props([
    'cols' => 'col-span-12',
    'openGraph' => false,
])

<hr class="text-gray-300 my-5">

<h1 class="font-semibold text-3xl"> # {{ __('dashboard::dashboard.seo_section') }} </h1>

<x-dashboard::dashboard.forms.text-input
        name='seo_title'
        label="{{__('dashboard::dashboard.seo_title')}}"
        cols='{{$cols}}'
/>

<x-dashboard::dashboard.forms.textarea-input
        name='seo_description'
        label="{{__('dashboard::dashboard.seo_description')}}"
        cols="{{$cols}}"
/>

@if($openGraph)
    <x-dashboard::dashboard.forms.text-input
            name='og_title'
            label="{{__('dashboard::dashboard.og_title')}}"
            cols='{{$cols}}'
    />

    <x-dashboard::dashboard.forms.text-input
            name='og_description'
            label="{{__('dashboard::dashboard.og_description')}}"
            cols='{{$cols}}'
    />

    <x-dashboard::dashboard.forms.url-input
            name='og_url'
            label="{{__('dashboard::dashboard.og_url')}}"
            cols='{{$cols}}'
    />

    <x-dashboard::dashboard.forms.url-input
            name='og_type'
            label="{{__('dashboard::dashboard.og_type')}}"
            cols='{{$cols}}'
    />
@endif

