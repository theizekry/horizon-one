@props([
    'icon'          => 'menu',
    'description'   => '',
    'searchResults' => false,
    'title',
])

<div class='row'>
    <h3 class='m-0'>
        <i class='fa fa-2x fa-{{ $icon }}'></i>
        <span class='text-3xl font-bold'>
            {{ $title }}
        </span>
        <span class="text-primary">
{{--            @if((! empty($searchResults) || $searchResults == 0) && isQueryStringNotEmpty())--}}
{{--                {{ __('dashboard::dashboard.search_result_count', ['count' => $searchResults]) }}--}}
{{--            @endif--}}
        </span>
        @if($description)
            <p class='text-sm mt-1'>
                <i class="fas fa-check-double"></i>
                {{ $description }}
            </p>
        @endif
    </h3>

    {{-- Begin validations-errors Section --}}
    @include('dashboard::blade-assets.general.validations-errors')
    {{-- End validations-errors Section --}}
</div>
<div class='card-body'>
    {{ $slot }}
</div>
