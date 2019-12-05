<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="icon" type="image/ico" href="../public/img/favicon.png">




<title>Varification Code</title>



<link rel='stylesheet' id='wp-block-library-css'  href='../public/css/front/style.min.css' type='text/css' media='all' />

<link rel='stylesheet' id='contact-form-7-css'  href='../public/css/front/styles1748.css' type='text/css' media='all' />



<link rel='stylesheet' id='woocommerce-layout-css'  href='../public/css/front/woocommerce-layout49eb.css' type='text/css' media='all' />

<link rel='stylesheet' id='woocommerce-smallscreen-css'  href='../public/css/front/woocommerce-smallscreen49eb.css' type='text/css' media='only screen and (max-width: 768px)' />

<link rel='stylesheet' id='woocommerce-general-css'  href='../public/css/front/woocommerce49eb.css' type='text/css' media='all' />

<style id='woocommerce-inline-inline-css' type='text/css'>

.woocommerce form .form-row .required { visibility: visible; }

</style>



<link rel='stylesheet' id='bootstrap-min-css'  href='../public/css/front/bootstrap.min.css' type='text/css' media='all' />

<link rel='stylesheet' id='font-awesome-css'  href='../public/css/front/fonts/font-awesome.min.css' type='text/css' media='all' />

<link rel='stylesheet' id='animate-css'  href='../public/css/front/animate.css' type='text/css' media='all' />

<link rel='stylesheet' id='main-css'  href='../public/css/front/style.css' type='text/css' media='all' />

<link rel='stylesheet' id='responsive-media-css'  href='../public/css/front/media.css' type='text/css' media='all' />



<link rel='stylesheet' id='Playfair-Display-css'  href='http://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic,700italic%7CMontserrat:400,700' type='text/css' media='screen' />

<link rel='stylesheet' id='owl-carousel-css'  href='../public/css/front/owl.carousel.css' type='text/css' media='all' />

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

<script type='text/javascript' src='../public/js/front/jqueryb8ff.js'></script>



    

<noscript>

<style>.woocommerce-product-gallery{ opacity: 1 !important; }</style>

</noscript>

<style type="text/css">

    .recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}

</style>

</head>




        

<body class="page-template-default page page-id-360 woocommerce-no-js singular single-page" data-offset="200" data-spy="scroll" data-target=".navbar-custom">

    <a id="goto-top"></a>

    <div class="box-wide">

    <header class="header sticky-wrapper sticky-bar">
        
            <div class="container">
    <div class="row">
                    
                    <div class="col-md-2 col-xs-3">
                        <div class="logo"><a class="to-top" href="#goto-top"><img src="../public/img/app-logo.png"></div>
                    </div>
                    
                    <div class="col-md-10 col-xs-9">
                        <ul class="user-menu">
<!--                            <li class="user-acc">
                                <a href="my-account/index.html"><i class="user-icon"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a class="d-text-c-h" href="user-account/index.html">Login</a></li>
                                </ul>
                            </li>
                            <li class="cart-ddl">
                                <a class="d-text-c-h" href="cart/index.html">
                                    <i class="cart-icon"></i>
                                </a>
                                <ul class="dropdown-menu cart-dropdown">
                                    <li>                  
                                        <span class="cart_details">0 items, Total of <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>0.00</span></span>
                                        <a class="checkout" title="View your shopping cart" href="cart/index.html">
                                                Checkout <span class="icon-chevron-right"></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>-->
                            <li class="menu-toggle">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                                    <i class="fa fa-bars"></i>
                                </button>
                            </li>
      </ul>
                        
                        <nav id="navbar" class="nav menu navbar navbar-custom navbar-fixed-top" role="navigation">
                            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                                <ul id="menu-main-menu" class="nav navbar-nav" style="margin-top: auto;">
                                    <li id="menu-item-307" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-307">
                                        <a title="Home" href="{{route('home')}}">Home</a>
                                    </li>
                                    <li id="menu-item-306" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-306">
                                        <a title="About" href="{{route('home')}}#about_us-section">About</a>
                                    </li>
                                    <li id="menu-item-308" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-308">
                                        <a title="Classes" href="{{route('home')}}#classes-section">Programs</a>
                                    </li>
                                    <li id="menu-item-309" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-309">
                                        <a title="Trainers" href="{{route('home')}}#trainers-section">Coaches</a>
                                    </li>
                                    <li id="menu-item-404" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-404 dropdown">
                                        <a title="Blog" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">News
                                            <span class="caret"></span>
                                        </a>
                                        <ul role="menu" class="dropdown-menu">
                                            <li id="menu-item-311" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-311">
                                                <a title="Blog" href="#blog">Blog</a>
                                            </li>
                                            <li id="menu-item-408" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-408">
                                                <a title="Blog Page" href="blog.html">Blog Page</a>
                                            </li>
                                        </ul>
                                    </li>
                                  
                                    <li id="menu-item-310" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-310">
                                        <a title="Contact" href="#contact-section">Contact</a>
                                    </li>

                                    <li id="menu-item-305" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-305 dropdown">
                                        <a title="Pages" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Pages <span class="caret"></span></a>
                                        <ul role="menu" class="dropdown-menu">
                                            <li id="menu-item-407" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-407">
                                                <a title="Shortcodes" href="">Shortcodes</a>
                                            </li>
                                            <li id="menu-item-405" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-405">
                                                <a title="Time Table" href="{{route('time')}}">Time Table</a>
                                            </li>
                                        </ul>
                                    </li>
                                    
                                    
<!--                             <li class="user-acc">
                                <a href="my-account/index.html"><i class="user-icon"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a class="d-text-c-h" href="user-account/index.html">Login</a></li>
                                </ul>
                            </li>-->
<!--                            <li class="cart-ddl">
                                <a class="d-text-c-h" href="cart/index.html">
                                    <i class="cart-icon"></i>
                                </a>
                                <ul class="dropdown-menu cart-dropdown">
                                    <li>                  
                                        <span class="cart_details">0 items, Total of <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>0.00</span></span>
                                        <a class="checkout" title="View your shopping cart" href="cart/index.html">
                                                Checkout <span class="icon-chevron-right"></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>-->

                                </ul>             
                            </div>
                        </nav>
                    </div>
                    
                </div>
            </div>

        </header>



<div class="content">

<div class="path-section" style='background-image: url(../public/img/slide-1.jpg);'>
    <div class="bg-cover" style="padding: 90px 0 20px">
{{--     <div class="container">
            <h3>Time Table</h3>
        </div> --}}
    </div>
</div>
        
<div class="blog-section page_spacing">
    <div class="container-fluid shortcode-view">
        
           
                    
          <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Full calendar start -->
    <section class="signin-form">
        
        <div class="overlay">
            <div class="wrapper">
                <div class="logo text-center top-bottom-gap">
                  
                </div>
                <div class="form34">
                    <center><a class="brand-logo" href="{{route('home')}}">
                    <img src="../public/img/app-logo.png" alt="Jaff logo" title="Jaff" style="height:50px;" />
                    </a> </center>
                    <center><h4 class="form-head">Forget Password</h4></center>
                    
    
                    <form action="{{route('postForgotPassword')}}" method="post">
                        @csrf
                        <div class="">
                            <!-- <p class="text-head">Username</p> -->
                            <input type="text" name="phone" class="input" placeholder="Phone" required="" />
                        </div>

                        <button type="submit" class="signinbutton btn">Send Code</button>
                      

                    </form>

                       
                </div>
            </div>
       
        </div>

    </section>
                <!-- // Full calendar end -->

            </div>
        </div>
                   
                        
                    
                

                
        
    </div>

</div>
</div>

        



    <footer class="footer" style="height:418px; padding: 55px 0;">
        <div class="layer footer-1">
            <div class="row">
                
                    <div class="col-lg-4 col-md-6 footer-top mt-md-0 mt-sm-5">
                        <div class="logo">
                        <h2>
                           <img src="{{asset('public/img/app-logo.png')}}" alt="Jaff" style="height:150px;">
                        </h2>
                         </div>
                        <p class="my-3">Donec consequat sam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus</p>
                       
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-w3pvt">
                            <h3 class=" w3pvt_title">Office Hours</h3>
                            <hr>
                            <ul class="list-info-w3pvt last-w3ls-contact mt-lg-4">
                                <li>
                                    <p> Monday - Friday 9.00 am - 8.00 pm</p>

                                </li>
                                <li class="my-2">
                                    <p style="margin-right: 40px">Saturday 9.00 am - 5.00 pm</p>

                                </li>
                                <li class="my-2">
                                    <p style="margin-right: 45px">Sunday 10.00 am - 2.00 pm</p>

                                </li>


                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-lg-0 mt-5">
                        <div class="footer-w3pvt">
                            <h3 class="mb-3 w3pvt_title">Newsletter</h3>
                            <hr>
                            
                        <div class="footer-text">
                            <p>By subscribing to our mailing list you will always get latest news and updates from us.</p>
                            <form action="#" style="margin-top: 18px;" method="post">
                                <input type="email" name="Email" placeholder="Enter your email..." required="">
                                <button class="btn1 btn" style="    font-size: 11px;
    margin-top: -3px;"><span class="fa fa-paper-plane-o" aria-hidden="true"></span></button>
                                <div class="clearfix"> </div>
                            </form>
                        </div>
                    </div>
                           
                           
                        </div>
                  

                </div>

                <p class="copywrite">© Copyright 2016 by BSD. All rights reserved.</p>
                <div class="w3ls-footer text-center mt-4">
                      <ul class="socials">

                    <li>

                        <a target="_blank" href="#" class="d-text-c-h d-border-c-h">

                            <img src="{{asset('public/img/fa-facebook.png')}}" alt="Social Icon"/>

                        </a>

                    </li>

                    <li>

                        <a target="_blank" href="#" class="d-text-c-h d-border-c-h">

                            <img src="{{asset('public/img/fa-google-plus.png')}}" alt="Social Icon"/>

                        </a>

                    </li>

                    <li>

                        <a target="_blank" href="#" class="d-text-c-h d-border-c-h">

                            <img src="{{asset('public/img/fa-instagram.png')}}" alt="Social Icon"/>

                        </a>

                    </li>

                    <li>

                        <a target="_blank" href="#" class="d-text-c-h d-border-c-h">

                            <img src="{{asset('public/img/fa-rss.png')}}" alt="Social Icon"/>

                        </a>

                    </li>

                    <li>

                        <a target="_blank" href="#" class="d-text-c-h d-border-c-h">

                            <img src="{{asset('public/img/fa-twitter.png')}}" alt="Social Icon"/>

                        </a>

                    </li>

                </ul>
                </div>
               
            </div>
            <!-- //footer bottom -->
       
    </footer>

        

        

        

</div>

 <script type="text/javascript">

        var c = document.body.className;

        c = c.replace(/woocommerce-no-js/, 'woocommerce-js');

        document.body.className = c;

</script>



<script type='text/javascript' src='../public/js/front/scripts1748.js'></script>

<script type='text/javascript' src='../public/js/front/jquery.blockUI.min44fd.js'></script>

<script type='text/javascript'>



</script>

<script type='text/javascript' src='../public/js/front/add-to-cart.min49eb.js'></script>

<script type='text/javascript' src='../public/js/front/js.cookie.min6b25.js'></script>

<script type='text/javascript'>



</script>

<script type='text/javascript' src='../public/js/front/woocommerce.min49eb.js'></script>

<script type='text/javascript'>



</script>

<script type='text/javascript' src='../public/js/front/cart-fragments.min49eb.js'></script>

<script type='text/javascript' src='../public/js/front/bootstrap.min.js'></script>

<script type='text/javascript' src='../public/js/front/jquery.easing.min.js'></script>

<script type='text/javascript' src='../public/js/front/jquery.appear.js'></script>

<script type='text/javascript' src="../public/js/front/wow.min.js"></script>

<script type='text/javascript' src='../public/js/front/owl.carousel.js'></script>

<script type='text/javascript' src='../public/js/front/jquery.flexslider-min.js'></script>

<script type='text/javascript' src='../public/js/front/jquery.animateNumber.min.js'></script>

<!--<script type='text/javascript' src='https://maps.google.com/maps/api/js?sensor=false'></script>-->

<!--<script type='text/javascript' src='assets/themes/ulysses/libraries/jquery.gmap.min.js'></script>-->

<script type='text/javascript' src='../public/js/front/functions.js'></script>

<script type='text/javascript' src='../public/js/front/wp-embed.min066b.js'></script>

</body>



<!-- Mirrored from lolthemes.com/demo/geo/ulysses/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 09 Oct 2019 09:51:23 GMT -->

</html>