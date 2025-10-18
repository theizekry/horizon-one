<div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
{{--    <a href="#" class="menu-link px-5">--}}
{{--        <span class="menu-title position-relative">--}}
{{--            <i class="fas fa-language mx-2"></i>--}}
{{--            {{__('dashboard::dashboard.change-language')}}--}}

{{--            <span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">--}}
{{--                {{ LaravelLocalization::getCurrentLocaleName() }} @if(app()->getLocale() === 'ar')--}}
{{--                    <img class="w-15px h-15px rounded-1 ms-2" src="{{ asset('assets/dashboard/media/flags/egypt.svg') }}" alt="" />--}}
{{--                @else--}}
{{--                    <img class="w-15px h-15px rounded-1 ms-2" src="{{ asset('assets/dashboard/media/flags/united-states.svg') }}" alt="" />--}}
{{--                @endif--}}
{{--            </span>--}}
{{--        </span>--}}
{{--    </a>--}}

    <!--begin::Menu sub-->
    <div class="menu-sub menu-sub-dropdown w-175px py-4">
        <!--begin::Menu item-->
{{--        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)--}}
{{--            <div class="menu-item px-3">--}}
{{--                <a class="menu-link d-flex px-5" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">--}}
{{--                <span class="symbol symbol-20px me-4">--}}
{{--                    <img class="rounded-1" src="{{ asset('assets/dashboard/media/flags/' . ($properties['flag'] ?? '') . '.svg') }}" alt="" />--}}
{{--                </span>--}}
{{--                    {{ $properties['native'] }}--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        @endforeach--}}
        <!--end::Menu item-->
    </div>
    <!--end::Menu sub-->
</div>
