@extends('dashboard::dashboard.layouts.sidebar.master')

@section('sidebar')

    <input
            type="text"
            class="form-control search bg-dark-sidebar-search text-white border-none sidebar-search"
            placeholder="{{ __('dashboard::dashboard.search_placeholder') }}"
            name="search"
            autocomplete="off"
    />

    <div class="page-sidebar">
        <div class="menu-item">
            <div class="menu-content pb-2">
            <span class="menu-section text-muted text-uppercase fs-8 ls-1">
                {{ __('dashboard::dashboard.general_links') }}
            </span>
            </div>
        </div>

        {{-- Home Page --}}
        <div class="menu-item">
            <a class="menu-link {{ request()->is('*/dashboard') ? 'active' : ''}}" href="{{ route('dashboard.home') }}">
            <span class="menu-icon">
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect x="2" y="2" width="9" height="9" rx="2" fill="black"></rect>
                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black"></rect>
                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black"></rect>
                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black"></rect>
                    </svg>
                </span>
            </span>
                <span class="menu-title">@lang('dashboard::dashboard.home')</span>
            </a>
        </div>
        {{-- Home Page --}}

        <div class="menu-item">
            <div class="menu-content pb-2">
            <span class="menu-section text-muted text-uppercase fs-8 ls-1">
                {{ __('dashboard::dashboard.dashboard') }}
            </span>
            </div>
        </div>

        {{-- Start Section Manage admins  --}}
        <div data-kt-menu-trigger="click"
             class="menu-item menu-accordion {{ request()->is('dashboard/admins') ? 'active' : ''}}">
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                     <span class="menu-link">
                         <span class="menu-bullet">
                             <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none">
                                        <path opacity="0.3"
                                              d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                                              fill="black"></path>
                                        <path d="M14.854 11.321C14.7568 11.2282 14.6388 11.1818 14.4998 11.1818H14.3333V10.2272C14.3333 9.61741 14.1041 9.09378 13.6458 8.65628C13.1875 8.21876 12.639 8 12 8C11.361 8 10.8124 8.21876 10.3541 8.65626C9.89574 9.09378 9.66663 9.61739 9.66663 10.2272V11.1818H9.49999C9.36115 11.1818 9.24306 11.2282 9.14583 11.321C9.0486 11.4138 9 11.5265 9 11.6591V14.5227C9 14.6553 9.04862 14.768 9.14583 14.8609C9.24306 14.9536 9.36115 15 9.49999 15H14.5C14.6389 15 14.7569 14.9536 14.8542 14.8609C14.9513 14.768 15 14.6553 15 14.5227V11.6591C15.0001 11.5265 14.9513 11.4138 14.854 11.321ZM13.3333 11.1818H10.6666V10.2272C10.6666 9.87594 10.7969 9.57597 11.0573 9.32743C11.3177 9.07886 11.6319 8.9546 12 8.9546C12.3681 8.9546 12.6823 9.07884 12.9427 9.32743C13.2031 9.57595 13.3333 9.87594 13.3333 10.2272V11.1818Z"
                                              fill="black"></path>
                                    </svg>
                                </span>
                             </span>
                         </span>
                         <span class="menu-title">
                             {{ __('dashboard::dashboard.system_admins') }}
                         </span>
                         <span class="menu-arrow"></span>
                     </span>
                <div class="menu-sub menu-sub-accordion"
                     style="display: {{ request()->is('dashboard/admins*') ? 'block' : 'none'}}; overflow: hidden;">
                    <div class="menu-item">
                        <a class="menu-link {{ request()->is('dashboard/admins') ? 'active' : '' }}"
                           href="{{ route('dashboard.admins.index') }}">
                                   <span class="menu-bullet">
                                   <span class="bullet bullet-dot"></span>
                                   </span>
                            <span class="menu-title">{{ __('dashboard::dashboard.admins_list') }}</span>
                        </a>
                    </div>


                    <div class="menu-item">
                        <a class="menu-link {{ request()->is('dashboard/admins/create') ? 'active' : '' }}"
                           href="{{ route('dashboard.admins.create') }}">
                                   <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                   </span>
                            <span class="menu-title">{{ __('dashboard::dashboard.add_new_admin') }}</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        {{-- End Section Manage admins  --}}

        {{-- Start section Manage Application --}}
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
         <span class="menu-link">
         <span class="menu-bullet">
             <span class="menu-icon">
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                              fill="black"></path>
                        <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black"></rect>
                    </svg>
                </span>
             </span>
         </span>
         <span class="menu-title">
             {{ __('dashboard::dashboard.manage_integrations') }}
         </span>
         <span class="menu-arrow"></span>
         </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg"
                     style="display: {{ request()->is('dashboard/customers*') ? 'block' : 'none'}}; overflow: hidden;">
                    <div class="menu-item">
                        <a class="menu-link {{ request()->is('dashboard/integrations') ? 'active' : ''}}"
                           href="{{ route('dashboard.integrations.index') }}">
                           <span class="menu-bullet">
                           <span class="bullet bullet-dot"></span>
                           </span>
                            <span class="menu-title">{{ __('dashboard::dashboard.list_integrations') }}</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link {{ request()->is('dashboard/applications/create') ? 'active' : ''}}"
                           href="{{ route('dashboard.integrations.create') }}">
                           <span class="menu-bullet">
                           <span class="bullet bullet-dot"></span>
                           </span>
                            <span class="menu-title">{{ __('dashboard::dashboard.add_new_integration') }}</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        {{-- End section Manage Application --}}

        {{-- Start section Manage Account --}}
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
         <span class="menu-link">
         <span class="menu-bullet">
            <span class="menu-icon">
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3"
                              d="M21 10.7192H3C2.4 10.7192 2 11.1192 2 11.7192C2 12.3192 2.4 12.7192 3 12.7192H6V14.7192C6 18.0192 8.7 20.7192 12 20.7192C15.3 20.7192 18 18.0192 18 14.7192V12.7192H21C21.6 12.7192 22 12.3192 22 11.7192C22 11.1192 21.6 10.7192 21 10.7192Z"
                              fill="black"></path>
                        <path d="M11.6 21.9192C11.4 21.9192 11.2 21.8192 11 21.7192C10.6 21.4192 10.5 20.7191 10.8 20.3191C11.7 19.1191 12.3 17.8191 12.7 16.3191C12.8 15.8191 13.4 15.4192 13.9 15.6192C14.4 15.7192 14.8 16.3191 14.6 16.8191C14.2 18.5191 13.4 20.1192 12.4 21.5192C12.2 21.7192 11.9 21.9192 11.6 21.9192ZM8.7 19.7192C10.2 18.1192 11 15.9192 11 13.7192V8.71917C11 8.11917 11.4 7.71917 12 7.71917C12.6 7.71917 13 8.11917 13 8.71917V13.0192C13 13.6192 13.4 14.0192 14 14.0192C14.6 14.0192 15 13.6192 15 13.0192V8.71917C15 7.01917 13.7 5.71917 12 5.71917C10.3 5.71917 9 7.01917 9 8.71917V13.7192C9 15.4192 8.4 17.1191 7.2 18.3191C6.8 18.7191 6.9 19.3192 7.3 19.7192C7.5 19.9192 7.7 20.0192 8 20.0192C8.3 20.0192 8.5 19.9192 8.7 19.7192ZM6 16.7192C6.5 16.7192 7 16.2192 7 15.7192V8.71917C7 8.11917 7.1 7.51918 7.3 6.91918C7.5 6.41918 7.2 5.8192 6.7 5.6192C6.2 5.4192 5.59999 5.71917 5.39999 6.21917C5.09999 7.01917 5 7.81917 5 8.71917V15.7192V15.8191C5 16.3191 5.5 16.7192 6 16.7192ZM9 4.71917C9.5 4.31917 10.1 4.11918 10.7 3.91918C11.2 3.81918 11.5 3.21917 11.4 2.71917C11.3 2.21917 10.7 1.91916 10.2 2.01916C9.4 2.21916 8.59999 2.6192 7.89999 3.1192C7.49999 3.4192 7.4 4.11916 7.7 4.51916C7.9 4.81916 8.2 4.91918 8.5 4.91918C8.6 4.91918 8.8 4.81917 9 4.71917ZM18.2 18.9192C18.7 17.2192 19 15.5192 19 13.7192V8.71917C19 5.71917 17.1 3.1192 14.3 2.1192C13.8 1.9192 13.2 2.21917 13 2.71917C12.8 3.21917 13.1 3.81916 13.6 4.01916C15.6 4.71916 17 6.61917 17 8.71917V13.7192C17 15.3192 16.8 16.8191 16.3 18.3191C16.1 18.8191 16.4 19.4192 16.9 19.6192C17 19.6192 17.1 19.6192 17.2 19.6192C17.7 19.6192 18 19.3192 18.2 18.9192Z"
                              fill="black"></path>
                    </svg>
                </span>
            </span>
         </span>
         <span class="menu-title">
             {{ __('dashboard::dashboard.account') }}
         </span>
         <span class="menu-arrow"></span>
         </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg"
                     style="display: {{ request()->is('dashboard/edit-account') || request()->is('dashboard/change-password') ? 'block' : 'none'}}; overflow: hidden;"
                >
                    <div class="menu-item">
                        <a class="menu-link {{ request()->is('dashboard/edit-account') ? 'active' : ''}}" href="{{ route('dashboard.admins.edit', [auth('admin')->id()]) }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                            <span class="menu-title">{{ __('dashboard::dashboard.edit_account') }}</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->is('dashboard/change-password') ? 'active' : ''}}"
                           href="{{ route('dashboard.change-password.index') }}">
                       <span class="menu-bullet">
                       <span class="bullet bullet-dot"></span>
                       </span>
                            <span class="menu-title">{{ __('dashboard::dashboard.change_password') }}</span>
                        </a>
                    </div>
                    {{-- Sign Out --}}
                    @include('dashboard::blade-assets.dashboard.logout')
                    {{-- Sign Out --}}
                </div>
            </div>
        </div>
        {{-- End section Manage Account --}}
    </div>
@endsection