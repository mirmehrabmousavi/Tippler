<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{($title)?$title:env('APP_NAME')}} - Admin {{$url1.' '.$url2}}</title>
    <link rel="icon" type="image/png" sizes="56x56" href="{{($ico)? $ico : asset('images/image.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/css/vendors-rtl.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/themes/black-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/themes/semi-dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/custom-rtl.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/dropzone.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/dropify.min.css')}}">

    <script src="{{asset('admin/js/jquery-3.6.1.min.js')}}"></script>

    @yield('external-style')
    @yield('style')
</head>
<body class="vertical-layout vertical-menu-modern dark-layout 2-columns  navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="dark-layout">

@include('admin.layouts.header')
@include('admin.layouts.aside')

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            @yield('content')
        </div>
    </div>
</div>

<div class="sidenav-overlay"></div>
<div class="drag-target"></div

@include('admin.layouts.footer')

<script src="{{asset('admin/vendors/js/vendors.min.js')}}"></script>
<script src="{{asset('admin/js/core/app-menu.js')}}"></script>
<script src="{{asset('admin/js/core/app.js')}}"></script>
<script src="{{asset('admin/js/scripts/components.js')}}"></script>
<script src="{{asset('admin/js/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('admin/js/ckeditor/translations/fa.js')}}"></script>
<script src="{{asset('admin/js/select2.min.js')}}"></script>
<script src="{{asset('admin/js/chart.min.js')}}"></script>
<script src="{{asset('admin/js/core/libraries/jquery.min.js')}}"></script>
<script src="{{asset('admin/js/dropzone.min.js')}}"></script>
<script src="{{asset('admin/js/toastr.min.js')}}"></script>
<script src="{{asset('admin/js/dropify.min.js')}}"></script>

@include('notifications.notification')
@yield('script')
@yield('external-script')

</body>
</html>
