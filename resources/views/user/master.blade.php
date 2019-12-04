<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" type="image/ico" href="public/img/favicon.png">

<title>@yield('title')</title>
<link rel='stylesheet' id='wp-block-library-css'  href="{{asset('public/css/front/style.min.css')}}" type='text/css' media='all' />
<link rel='stylesheet' id='contact-form-7-css'  href="{{asset('public/css/front/styles1748.css')}}" type='text/css' media='all' />

<link rel='stylesheet' id='woocommerce-layout-css'  href="{{asset('public/css/front/woocommerce-layout49eb.css')}}" type='text/css' media='all' />
<link rel='stylesheet' id='woocommerce-smallscreen-css'  href="{{asset('public/css/front/woocommerce-smallscreen49eb.css')}}" type='text/css' media='only screen and (max-width: 768px)' />
<link rel='stylesheet' id='woocommerce-general-css'  href='public/css/front/woocommerce49eb.css' type='text/css' media='all' />
<style id='woocommerce-inline-inline-css' type='text/css'>
.woocommerce form .form-row .required { visibility: visible; }
</style>

<link rel='stylesheet' id='bootstrap-min-css'  href='public/css/front/bootstrap.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='font-awesome-css'  href='public/css/front/fonts/font-awesome.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='animate-css'  href='public/css/front/animate.css' type='text/css' media='all' />
<link rel='stylesheet' id='main-css'  href='public/css/front/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='responsive-media-css'  href='public/css/front/media.css' type='text/css' media='all' />

<link rel='stylesheet' id='Playfair-Display-css'  href='http://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic,700italic%7CMontserrat:400,700' type='text/css' media='screen' />
<link rel='stylesheet' id='owl-carousel-css'  href='public/css/front/owl.carousel.css' type='text/css' media='all' />
<link type="text/css" rel="stylesheet" href="public/css/front/slick.css"/>

   <!-- BEGIN: Vendor CSS-->
{{--     <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css"> --}}
  {{-- <link rel="stylesheet" type="text/css" href="public/css/front/calendars/fullcalendar.min.css"> --}}
  {{-- <link rel="stylesheet" type="text/css" href="public/css/front/calendars/daygrid.min.css"> --}}
  {{-- <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/pickadate/pickadate.css"> --}}
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="public/css/front/components.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/dark-layout.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="public/css/front/semi-dark-layout.css"> --}}

    <!-- BEGIN: Page CSS-->

    {{-- <link rel="stylesheet" type="text/css" href="public/css/front/fullcalendar.css"> --}}
    <!-- END: Page CSS-->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<script type='text/javascript' src='public/js/front/jqueryb8ff.js'></script>

	
<noscript>
<style>.woocommerce-product-gallery{ opacity: 1 !important; }</style>
</noscript>
<style type="text/css">
    .recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}
</style>
@yield('style')
</head>


		
<body class="home page-template-default page page-id-10 woocommerce-no-js home-page" data-offset="200" data-spy="scroll" data-target=".navbar-custom">
    <a id="goto-top"></a>
    <div class="box-wide">
       @yield('header')

       @yield('content')       
    </div>
       @yield('footer')


{{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script> --}}
<script type='text/javascript' src='public/js/front/scripts1748.js'></script>
<script type='text/javascript' src='public/js/front/jquery.blockUI.min44fd.js'></script>
<script type='text/javascript'>

</script>
<script type='text/javascript' src='public/js/front/add-to-cart.min49eb.js'></script>
<script type='text/javascript' src='public/js/front/js.cookie.min6b25.js'></script>
<script type='text/javascript'>

</script>
<script type='text/javascript' src='public/js/front/woocommerce.min49eb.js'></script>
<script type='text/javascript'>

</script>
<script type='text/javascript' src='public/js/front/cart-fragments.min49eb.js'></script>
<script type='text/javascript' src='public/js/front/bootstrap.min.js'></script>
<script type='text/javascript' src='public/js/front/jquery.easing.min.js'></script>
<script type='text/javascript' src='public/js/front/jquery.appear.js'></script>
<script type='text/javascript' src="public/js/front/wow.min.js"></script>
<script type='text/javascript' src='public/js/front/owl.carousel.js'></script>
<script type='text/javascript' src='public/js/front/jquery.flexslider-min.js'></script>
<script type='text/javascript' src='public/js/front/jquery.animateNumber.min.js'></script>
<!--<script type='text/javascript' src='https://maps.google.com/maps/api/js?sensor=false'></script>-->
<!--<script type='text/javascript' src='assets/themes/ulysses/libraries/jquery.gmap.min.js'></script>-->
<script type='text/javascript' src='public/js/front/functions.js'></script>
<script type='text/javascript' src='public/js/front/wp-embed.min066b.js'></script>
<!--slick slider-->
{{-- <script type="text/javascript" src="public/js/front/slick.min.js"></script> --}}

{{-- <script>
// $(document).ready(function(){
// console.log('success');
// });
         $('.post-wrapper').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
  nextArrow: $('.next'),
  prevArrow: $('.prev'),
  
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});   

</script> --}}
<!-- BEGIN: Page Vendor JS-->
    




    <!-- END: Page JS-->

@yield('script')
</body>

<!-- Mirrored from lolthemes.com/demo/geo/ulysses/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 09 Oct 2019 09:51:23 GMT -->
</html>