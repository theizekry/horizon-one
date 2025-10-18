<div class="d-flex align-items-center ms-1 ms-lg-3">
    <!--begin::Menu wrapper-->
    <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
        <span class="svg-icon svg-icon-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
            </svg>
        </span>
        <!--end::Svg Icon-->
    </div>
    <!--begin::Menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column w-250px w-lg-325px" data-kt-menu="true">
        <!--begin::Heading-->
        <div class="d-flex flex-column flex-center bgi-no-repeat rounded-top px-9 py-10" style="background-image:url({{ asset('assets/dashboard/media/misc/pattern-1.jpg') }})">
            <!--begin::Title-->
            <h3 class="text-white fw-bold mb-3">
                <i class="fas fa-external-link-alt"></i>
                {{ __('dashboard::dashboard.quick_links') }}
            </h3>
            <!--end::Title-->
        </div>
        <!--end::Heading-->
        <!--begin:Nav-->
        <div class="row g-0">
            <!--begin:AddClients-->
            <div class="col-6">
                <a href="#" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end border-bottom">
                    <!--begin::Svg Icon | path: icons/duotune/finance/fin009.svg-->
                    <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
                            <path fill="#E34F26" d="M19.037 113.063l-11.38-127.716h119.686l-11.398 127.716-47.404 13.18z"/>
                            <path fill="#EBEBEB" d="M64 118.093l39.704-11.06 9.352-104.027h-49.056v115.087z"/>
                            <path fill="#fff" d="M64 66.978h14.5l1.02-11.399h-15.52v-13.04h30.598999999999997l-.339 3.797-3.313 37.077h-26.946zm0 0"/>
                            <path fill="#fff" d="M64 92.739l-.076.022-7.355-1.928-.496-5.562h-7.682999999999999v22.231h15.639zM64 66.978v13.04h31.08l.275-3.07 2.575-28.87h-34.93zm0 0"/>
                            <path fill="#fff" d="M64 40.918h-22.231999999999998l-1.515-16.984-.112-.889h24.86zm0 0"/>
                            <path fill="#fff" d="M64 40.918h22.231999999999998l1.437-16.064 1.525-.92h-25.195zm0 0"/>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <span class="fs-5 fw-bold text-gray-800 mb-0">{{ __('dashboard::dashboard.clients') }}</span>
                    <span class="fs-7 text-gray-400">{{ __('dashboard::dashboard.add_new_client') }}</span>
                </a>
            </div>
            <!--end:AddClients-->

            <!--begin:ListClients-->
            <div class="col-6">
                <a href="#" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-bottom">
                    <!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
                    <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                          <path fill="#000000" d="M448 32h-32.829c-19.646 0-38.123 7.594-52.156 21.437l-68.063 68.063c-2.31 2.311-5.48 3.565-8.804 3.565h-96v32h96c2.324 0 6.108 1.254 8.804 3.565l68.063 68.062c13.932 13.843 32.51 21.438 52.156 21.438h32.829v320h-352v-448h352v32zm0 416v-272h-32.829c-8.195 0-16.004-3.225-21.938-9.125l-68.063-68.062c-4.961-4.93-11.49-7.625-18.469-7.625h-96v-32h96c6.979 0 13.508-2.695 18.469-7.625l68.063-68.063c5.935-5.899 13.742-9.124 21.938-9.124h32.829v-32h-352v448h352z"/>
                      </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <span class="fs-5 fw-bold text-gray-800 mb-0">
                        {{ __('dashboard::dashboard.clients') }}
                    </span>
                    <span class="fs-7 text-gray-400">
                        {{ __('dashboard::dashboard.list_clients') }}
                    </span>
                </a>
            </div>
            <!--end:ListClients-->

            <!--begin:admins-->
            <div class="col-6">
                <a href="{{ route('dashboard.admins.create') }}" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs042.svg-->
                    <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                          <path fill="#2196F3" d="M18.5,4h-13C4.673,4,4,4.673,4,5.5v13C4,19.327,4.673,20,5.5,20h13c0.827,0,1.5-0.673,1.5-1.5v-13C20,4.673,19.327,4,18.5,4z M12,6.5l-6,4.5l6,4.5l6-4.5L12,6.5z M18,18h-3v-2h3V18z M18,14h-3v-2h3V14z M18,10h-3V8h3V10z"/>
                       </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <span class="fs-5 fw-bold text-gray-800 mb-0">
                        {{ __('dashboard::dashboard.admins') }}
                    </span>
                    <span class="fs-7 text-gray-400">
                        {{ __('dashboard::dashboard.add_new_admin') }}
                    </span>
                </a>
            </div>
            <!--end:admins-->

            <!--begin:admins-->
            <div class="col-6">
                <a href="{{ route('dashboard.admins.index') }}" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light">
                    <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                    <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                          <path fill="#2196F3" d="M20.036 6c.547 0 .992.445.992.992v9.016c0 .547-.445.992-.992.992H11.39c-.22 0-.438-.07-.617-.208l-3.35-2.25c-.122-.082-.214-.205-.258-.352l-.518-1.382C6.312 11.487 6 10.771 6 10.01V6.993c0-.547.445-.992.992-.992h13.044zm0-2H6.992C5.886 4 5 4.886 5 6.006v3.003C5 9.113 5.886 10 6.992 10H9v2H7c-.553 0-1 .447-1 1v2c0 .553.447 1 1 1h2v2H6.992C5.886 18 5 18.886 5 20.006v1.987C5 22.114 5.886 23 6.992 23h13.044C20.15 23 21 22.15 21 21.006v-9.016C21 5.85 20.15 5 19.036 5zM15 16h-2v-2h2v2zm4 0h-2v-2h2v2zm0-4h-2V8h2v4z"/>
                       </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <span class="fs-5 fw-bold text-gray-800 mb-0">
                        {{ __('dashboard::dashboard.admins') }}
                    </span>
                    <span class="fs-7 text-gray-400">
                        {{ __('dashboard::dashboard.admins_list') }}
                    </span>
                </a>
            </div>
            <!--end:admins-->
        </div>
        <!--end:Nav-->
    </div>
    <!--end::Menu-->
    <!--end::Menu wrapper-->
</div>
