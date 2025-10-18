<!DOCTYPE html>

<html lang="en" dir="en">
<!--begin::Head-->
<head>
    <title>Dashboard | Login</title>
    <meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="{{ asset('assets/dashboard/media/logos/favicon.ico') }}" />

    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    @if(app()->getLocale() === 'ar')
        <!--begin::Fonts-->
        <link href="{{ asset('general/fonts/cairo.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Fonts-->

        <link href="{{ asset('assets/dashboard/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/dashboard/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/dashboard/custom/css/app.rtl.css') }}" rel="stylesheet" type="text/css" />
    @else
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <link href="{{ asset('assets/dashboard/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/dashboard/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    @endif
    <!--end::Global Stylesheets Bundle-->

    <style>
        body {
            background-image: url("{{ asset('/assets/dashboard/custom/images/bg-login.jpg') }}");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

    </style>
</head>
<!--end::Head-->

<body id="kt_body0" class="#bg-dark">