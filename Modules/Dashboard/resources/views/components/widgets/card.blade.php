@props([
    'count'          => 0,
    'route'          => '#',
    'permissionsKey' => false,
    'isClickable'    => true,
    'label',
    'cols' => 4,
])

<div class="col-xl-{{ $cols }}">
    <!--begin::Stats Widget 3-->
    <div {{ $attributes->merge(['class' => 'card hoverable text-hover-white card-xl-stretch card-stretch mb-5 mb-xl-8 p-5']) }}>
        <!--begin::Body-->
        <div class="card-body align-items-center">
            <!--begin::Section-->
            <div class="d-flex justify-content-around justify-content-lg-around justify-content-md-around">
                <!--begin::Symbol-->
                <div class="symbol symbol-50px me-5 justify-start">
                    <!--begin::Title-->
                    <div class="float-end">

                            <a href="{{ $route }}" class="font-semibold fs-4 text-white text-hover-white fw-bolder align-items-center">
                                <i class='fas fa-sort-amount-up mx-2 text-white'></i>

                                {{ $label }}

                                @if($isClickable)
                                    <i class="fas fa-external-link-alt mx-1 text-white"></i>
                                @endif
                            </a>
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Symbol-->
                <div class="fw-bolder text-white fw-bold fs-1 pt-7 float-right">
                    {{ $count }}
                </div>
            </div>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Stats Widget 3-->
</div>
