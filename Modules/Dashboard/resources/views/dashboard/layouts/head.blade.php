<title>@yield('title', 'Dashboard | Home')</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta charset="utf-8" />
{{--  <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
<!--end::Fonts-->
<link href="{{ asset('assets/dashboard/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/dashboard/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/dashboard/custom/css/app.ltr.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/dashboard/custom/css/app.css') }}" rel="stylesheet" type="text/css" />

@stack('css')