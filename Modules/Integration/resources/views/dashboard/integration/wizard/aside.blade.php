<!--begin::Aside (Wizard Stepper)-->
<div class="d-flex justify-content-center bg-body rounded justify-content-xl-start flex-row-auto w-100 w-xl-300px w-xxl-400px me-9">
    <div class="px-6 px-lg-10 px-xxl-15 py-20">
        <div class="stepper-nav">

            @php
                $steps = [
                    ['title' => 'General Info', 'desc' => 'Name, email, status'],
                    ['title' => 'OAuth Scopes', 'desc' => 'What APIs the client can use'],
                    ['title' => 'Database Config', 'desc' => 'DB connection and credentials'],
                    ['title' => 'Field Mapping', 'desc' => 'Map standard fields'],
                    ['title' => 'Completed', 'desc' => 'Review and activate'],
                ];
                $currentStep = 0;
            @endphp

            @foreach ($steps as $index => $step)
                <div class="stepper-item {{ $currentStep === $index + 1 ? 'current' : ($currentStep > $index + 1 ? 'completed' : '') }}" data-kt-stepper-element="nav">
                    <div class="stepper-line w-40px"></div>
                    <div class="stepper-icon w-40px h-40px">
                        <i class="stepper-check fas fa-check"></i>
                        <span class="stepper-number">{{ $index + 1 }}</span>
                    </div>
                    <div class="stepper-label">
                        <h3 class="stepper-title">{{ $step['title'] }}</h3>
                        <div class="stepper-desc fw-bold">{{ $step['desc'] }}</div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
<!--end::Aside-->


{{--<!--begin::Aside-->--}}
{{--<div class="d-flex justify-content-center bg-body rounded justify-content-xl-start flex-row-auto w-100 w-xl-300px w-xxl-400px me-9">--}}
{{--    <!--begin::Wrapper-->--}}
{{--    <div class="px-6 px-lg-10 px-xxl-15 py-20">--}}
{{--        <!--begin::Nav-->--}}
{{--        <div class="stepper-nav">--}}
{{--            <!--begin::Step 1-->--}}
{{--            <div class="stepper-item current" data-kt-stepper-element="nav">--}}
{{--                <!--begin::Line-->--}}
{{--                <div class="stepper-line w-40px"></div>--}}
{{--                <!--end::Line-->--}}
{{--                <!--begin::Icon-->--}}
{{--                <div class="stepper-icon w-40px h-40px">--}}
{{--                    <i class="stepper-check fas fa-check"></i>--}}
{{--                    <span class="stepper-number">1</span>--}}
{{--                </div>--}}
{{--                <!--end::Icon-->--}}
{{--                <!--begin::Label-->--}}
{{--                <div class="stepper-label">--}}
{{--                    <h3 class="stepper-title">Account Type</h3>--}}
{{--                    <div class="stepper-desc fw-bold">Setup Your Account Details</div>--}}
{{--                </div>--}}
{{--                <!--end::Label-->--}}
{{--            </div>--}}
{{--            <!--end::Step 1-->--}}
{{--            <!--begin::Step 2-->--}}
{{--            <div class="stepper-item" data-kt-stepper-element="nav">--}}
{{--                <!--begin::Line-->--}}
{{--                <div class="stepper-line w-40px"></div>--}}
{{--                <!--end::Line-->--}}
{{--                <!--begin::Icon-->--}}
{{--                <div class="stepper-icon w-40px h-40px">--}}
{{--                    <i class="stepper-check fas fa-check"></i>--}}
{{--                    <span class="stepper-number">2</span>--}}
{{--                </div>--}}
{{--                <!--end::Icon-->--}}
{{--                <!--begin::Label-->--}}
{{--                <div class="stepper-label">--}}
{{--                    <h3 class="stepper-title">Account Settings</h3>--}}
{{--                    <div class="stepper-desc fw-bold">Setup Your Account Settings</div>--}}
{{--                </div>--}}
{{--                <!--end::Label-->--}}
{{--            </div>--}}
{{--            <!--end::Step 2-->--}}
{{--            <!--begin::Step 3-->--}}
{{--            <div class="stepper-item" data-kt-stepper-element="nav">--}}
{{--                <!--begin::Line-->--}}
{{--                <div class="stepper-line w-40px"></div>--}}
{{--                <!--end::Line-->--}}
{{--                <!--begin::Icon-->--}}
{{--                <div class="stepper-icon w-40px h-40px">--}}
{{--                    <i class="stepper-check fas fa-check"></i>--}}
{{--                    <span class="stepper-number">3</span>--}}
{{--                </div>--}}
{{--                <!--end::Icon-->--}}
{{--                <!--begin::Label-->--}}
{{--                <div class="stepper-label">--}}
{{--                    <h3 class="stepper-title">Business Info</h3>--}}
{{--                    <div class="stepper-desc fw-bold">Your Business Related Info</div>--}}
{{--                </div>--}}
{{--                <!--end::Label-->--}}
{{--            </div>--}}
{{--            <!--end::Step 3-->--}}
{{--            <!--begin::Step 4-->--}}
{{--            <div class="stepper-item" data-kt-stepper-element="nav">--}}
{{--                <!--begin::Line-->--}}
{{--                <div class="stepper-line w-40px"></div>--}}
{{--                <!--end::Line-->--}}
{{--                <!--begin::Icon-->--}}
{{--                <div class="stepper-icon w-40px h-40px">--}}
{{--                    <i class="stepper-check fas fa-check"></i>--}}
{{--                    <span class="stepper-number">4</span>--}}
{{--                </div>--}}
{{--                <!--end::Icon-->--}}
{{--                <!--begin::Label-->--}}
{{--                <div class="stepper-label">--}}
{{--                    <h3 class="stepper-title">Billing Details</h3>--}}
{{--                    <div class="stepper-desc fw-bold">Set Your Payment Methods</div>--}}
{{--                </div>--}}
{{--                <!--end::Label-->--}}
{{--            </div>--}}
{{--            <!--end::Step 4-->--}}
{{--            <!--begin::Step 5-->--}}
{{--            <div class="stepper-item" data-kt-stepper-element="nav">--}}
{{--                <!--begin::Line-->--}}
{{--                <div class="stepper-line w-40px"></div>--}}
{{--                <!--end::Line-->--}}
{{--                <!--begin::Icon-->--}}
{{--                <div class="stepper-icon w-40px h-40px">--}}
{{--                    <i class="stepper-check fas fa-check"></i>--}}
{{--                    <span class="stepper-number">5</span>--}}
{{--                </div>--}}
{{--                <!--end::Icon-->--}}
{{--                <!--begin::Label-->--}}
{{--                <div class="stepper-label">--}}
{{--                    <h3 class="stepper-title">Completed</h3>--}}
{{--                    <div class="stepper-desc fw-bold">Woah, we are here</div>--}}
{{--                </div>--}}
{{--                <!--end::Label-->--}}
{{--            </div>--}}
{{--            <!--end::Step 5-->--}}
{{--        </div>--}}
{{--        <!--end::Nav-->--}}
{{--    </div>--}}
{{--    <!--end::Wrapper-->--}}
{{--</div>--}}
{{--<!--end::Aside-->--}}