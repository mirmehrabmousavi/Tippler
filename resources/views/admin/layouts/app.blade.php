<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{env('APP_NAME')}} - Admin @yield('title')</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="56x56" href="#">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/app.css')}}">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/css/vendors-rtl.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/css/extensions/tether-theme-arrows.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/css/extensions/tether.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/css/extensions/shepherd-theme-default.css')}}">
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/themes/black-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/themes/semi-dark-layout.css')}}">
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/core/colors/palette-gradient.css')}}">
    <!-- END: Page CSS-->
    @yield('external-style')
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/custom-rtl.css')}}">
    <script src="{{asset('admin/js/core/libraries/jquery.min.js')}}"></script>
    <link href="{{asset('admin/css/select2.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('admin/css/dropzone.min.css')}}"/>
    <script src="{{asset('admin/js/dropzone.min.js')}}"></script>
    <link href="{{asset('admin/css/toastr.min.css')}}" rel="stylesheet">
    <script src="{{asset('admin/js/toastr.min.js')}}"></script>
    <!-- END: Custom CSS-->
    @yield('style')
</head>
<body class="vertical-layout vertical-menu-modern dark-layout 2-columns  navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="dark-layout">

@include('admin.layouts.header')

@include('admin.layouts.aside')

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            @include('notifications.notification')
            @yield('content')
        </div>
    </div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

@include('admin.layouts.footer')

<script src="{{asset('admin/js/jquery-3.6.1.min.js')}}"></script>
<!-- BEGIN: Vendor JS-->
<script src="{{asset('admin/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('admin/vendors/js/extensions/tether.min.js')}}"></script>
<script src="{{asset('admin/vendors/js/extensions/shepherd.min.js')}}"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{asset('admin/js/core/app-menu.js')}}"></script>
<script src="{{asset('admin/js/core/app.js')}}"></script>
<script src="{{asset('admin/js/scripts/components.js')}}"></script>
<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
<script src="{{asset('admin/js/scripts/popover/popover.js')}}"></script>
<!-- END: Page JS-->
<script src="{{asset('admin/js/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('admin/js/ckeditor/translations/fa.js')}}"></script>
<script src="{{asset('admin/js/select2.min.js')}}"></script>
<script src="{{asset('admin/js/chart.min.js')}}"></script>

@yield('external-script')
<script>
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: 'toast-bottom-left',
        timeOut: 3000, // 3 seconds
        extendedTimeOut: 1000, // 1 second after hover
        showEasing: 'swing',
        hideEasing: 'linear',
        showMethod: 'fadeIn',
        hideMethod: 'fadeOut'
    };
</script>
@yield('script')
</body>
<!-- END: Body-->
</html>
