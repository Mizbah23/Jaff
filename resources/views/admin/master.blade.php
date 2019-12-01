<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Vuesax admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuesax admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="">
    <title>Jaff</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="icon" type="image/ico" href="{{asset('/public/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/css/back/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/css/back/bootstrap-extended.min.css')}}">
    
    
    <!--<link rel="stylesheet" type="text/css" href="{{asset('public/css/back/apexcharts.css')}}">-->
    <!--<link rel="stylesheet" type="text/css" href="{{asset('public/css/back/tether-theme-arrows.css')}}">-->
    <!--<link rel="stylesheet" type="text/css" href="{{asset('public/css/back/tether.min.css')}}">-->
    <!--<link rel="stylesheet" type="text/css" href="{{asset('public/css/back/shepherd-theme-default.css')}}">-->
    
    <link rel="stylesheet" type="text/css" href="{{asset('/public/css/back/colors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/css/back/components.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/css/back/dark-layout.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/css/back/semi-dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/css/back/vertical-menu.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/palette-gradient.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/dashboard-analytics.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/card-analytics.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/tour.min.css')}}">

<link rel="stylesheet" href="{{asset('public/css/back/bootstrap-4.min.css')}}">
<link rel="stylesheet" href="{{asset('public/css/back/toastr.min.css')}}">
    
    @yield('link')
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/style.css')}}">
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns  navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="semi-dark-layout">

@include('admin.layout.sidenav')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
@include('admin.layout.topnav')

    <div class="content-wrapper">
        <div class="content-header row"></div>
            
        <div class="content-body">
            @yield('content')
        </div>
        
        
        
        
        
        </div>
    </div>


    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix blue-grey lighten-2 mb-0" >
            <span class="float-md-left d-block d-md-inline-block mt-25" style="text-align: center !important;">
                COPYRIGHT &copy; 2019
                <a class="text-bold-800 grey darken-2" href="bsdbd.com" target="_blank">BSD</a>All rights Reserved
            </span>
            <!--<span class="float-md-right d-none d-md-block">Hand-crafted & Made with<i class="feather icon-heart pink"></i></span>-->
            <button class="btn btn-primary btn-icon scroll-top" type="button">
                <i class="feather icon-arrow-up"></i>
            </button>
        </p>
    </footer>
    
    

    
    
    <script src="{{asset('public/js/back/vendors.min.js')}}"></script>
    
    <script src="{{asset('public/js/back/tether.min.js')}}"></script>
    <!--<script src="{{asset('public/js/back/shepherd.min.js')}}"></script>-->
    <script src="{{asset('public/js/back/app-menu.min.js')}}"></script>
    <script src="{{asset('public/js/back/app.min.js')}}"></script>
    <script src="{{asset('public/js/back/components.min.js')}}"></script>
    
<script src="{{asset('public/js/back/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('public/js/back/toastr.min.js')}}"></script>
     @yield('script')
     <script type="text/javascript">
 Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
            toastr.options = {
            "closeButton": true,
            "debug": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
   </script>
   

</body>


</html>