<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="icon" type="image/ico" href="../public/img/favicon.png">



<title>Jaff Sports::OTP Verification</title>



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



           
               @if (session('success'))
                    <div class="alert alert-success">
                    {{ session('success') }}
                     </div>
               @endif
 
        

<body class="home page-template-default page page-id-10 woocommerce-no-js home-page" data-offset="200" data-spy="scroll" data-target=".navbar-custom">

    <a id="goto-top"></a>

    <div class="box-wide">

    <header class="header sticky-wrapper sticky-bar">

        

            <div class="container">

        <div class="row">

                    

                    <div class="col-md-2 col-xs-3">

                        <div class="logo"><a class="to-top" href="{{route('home')}}"><img src="../public/img/app-logo.png"></div>

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

                                <ul id="menu-main-menu" class="nav navbar-nav">

                                    <li id="menu-item-307" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-307">

                                        <a title="Home" href="{{route('home')}}">Home</a>

                                    </li>

                                    <li id="menu-item-306" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-306">

                                        <a title="About" href="#about_us-section">About</a>

                                    </li>

                                    <li id="menu-item-308" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-308">

                                        <a title="Classes" href="#classes-section">Classes</a>

                                    </li>

                                    <li id="menu-item-309" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-309">

                                        <a title="Trainers" href="#trainers-section">Trainers</a>

                                    </li>

                                    <li id="menu-item-404" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-404 dropdown">

                                        <a title="Blog" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Blog

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

                                    <li id="menu-item-406" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-406">

                                        <a title="Shop" href="shop/index.html">Shop</a>

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

                                                <a title="Time Table" href="time.html">Time Table</a>

                                            </li>

                                        </ul>

                                    </li>

                                    

                                    

                             <li class="user-acc">

                                <a href="my-account/index.html"><i class="fa fa-user"></i></a>

                                <ul class="dropdown-menu">

                                    <li><a class="d-text-c-h" href="{{route('login')}}">Log in</a></li>

                                </ul>

                            </li>

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

    <div class="blog-section">



            <div class="container-fluid shortcode-view">

                <div class="row">

                    <div class="col-md-12">

                    

                        <article id="post-10" class="page-post-entry post-10 page type-page status-publish hentry">

                            <h2 class="sr-only">Jaff Homepage</h2>

                            <header class="entry-header"></header>

    <div class="entry-content">

                     

                            <section class="slider-section" id="home_slider-section">  

                            
                            <div class="path-section" style='background-image: url(../public/img/slide-1.jpg);'>
                    <div class="bg-cover">
             
                        </div>
                    </div>
                    </section>
    </div> 
           
    <section class="signin-form">
        
        <div class="overlay">
            <div class="wrapper">
                <div class="logo text-center top-bottom-gap">
                  
                </div>
  <div class="form34" style="height: 455px">
                    


                    <center><a class="brand-logo" href="{{route('home')}}">
                    <img src="../public/img/app-logo.png" alt="Jaff logo" title="Jaff" style="height:80px;" />
                    </a> </center>
            

                    <form action="" method="post" id="">
                        <input type="hidden" name="phone" value="{{$user->phone}}">
                        @csrf
                      <p style="color:red"> {{ session('success') }}</p>

                        <div class="">
                            <!-- <p class="text-head">Username</p> -->
                            <input type="text" name="otp" class="input" placeholder="Type your OTP Code" required="" />
                        </div>
                   
                    
                        <button type="submit" class="signinbutton btn">Confirm</button>
                        <p class="signup">Have you not get yet?<a href="#" class="signuplink">Resend</a>
                        </p>
                    </form>
                  
                </div>
            </div>
       
        </div>

    </section>                        

                       

                                

    <!-- Section Over -->

    

    

  



 

    </div>

        </article>

    </div>
</div>





</div>



                    </div>



            </div>

    </div>

        

        
{{-- 
        <footer class="footer">

            <div class="container">

                <div class="logo"><img src="public/img/app-logo.png" alt="Ulysses"/></div>

                <ul class="socials">

                    <li>

                        <a target="_blank" href="#" class="d-text-c-h d-border-c-h">

                            <img src="public/img/fa-facebook.png" alt="Social Icon"/>

                        </a>

                    </li>

                    <li>

                        <a target="_blank" href="#" class="d-text-c-h d-border-c-h">

                            <img src="public/img/fa-google-plus.png" alt="Social Icon"/>

                        </a>

                    </li>

                    <li>

                        <a target="_blank" href="#" class="d-text-c-h d-border-c-h">

                            <img src="public/img/fa-instagram.png" alt="Social Icon"/>

                        </a>

                    </li>

                    <li>

                        <a target="_blank" href="#" class="d-text-c-h d-border-c-h">

                            <img src="public/img/fa-rss.png" alt="Social Icon"/>

                        </a>

                    </li>

                    <li>

                        <a target="_blank" href="#" class="d-text-c-h d-border-c-h">

                            <img src="public/img/fa-twitter.png" alt="Social Icon"/>

                        </a>

                    </li>

                </ul>

                <p class="copywrite">© Copyright 2016 by BSD. All rights reserved.</p>

            </div>

        </footer> --}}
        

  <!--  </footer> -->
<footer id="footer">
    <div class="footer-top">
        <div class="container">
           <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 footer-info text-center">
                <img src="{{asset('public/img/app-logo.png')}}" alt="footer-logo" />
                <p>Play, experience and live 90 minutes of ultimate futsal with your team. JAFF provides unique futsal experience where you can enjoy team dugouts, free drinking water and LED display for scorings.</p>
            </div>
               <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 footer-time text-center">
                   <h5 class="text-center">Quick Links</h5>
                     <hr>
                   <li><i class="fa fa-angle-right"></i><a href="{{route('home')}}">Home</a></li>
                   <li><i class="fa fa-angle-right"></i><a href="{{-- {{route('time')}} --}}">Book Slot</a></li>
                   <li><i class="fa fa-angle-right"></i><a href="{{route('user.notice')}}">Notices</a></li>
                  
                   <li><i class="fa fa-angle-right"></i><a href="{{route('user.news')}}">News</a></li>
                   <li><i class="fa fa-angle-right"></i><a href="{{route('home')}}#trainers-section">Coaches</a></li>
                 </div>
               <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 footer-contact text-center">
                   <h5 class="text-center">NEWS LETTER</h5>
                   <hr>
                 <!--  <div class="loc text-center">
                   <img src="img/contact-1.png" alt="footer-con" class="con1" />
                   <p class="text-center">Jaff Street Bashundhara Main Gate,Opposite of Jamuna Future Park Sidegate,Dhaka</p>
                   </div>
                   <div class="con-left">
                   <img src="img/contact-2.png" class="call" alt="footer-con" />
                   <span>+8801304229158</span><br>
                   <img src="img/contact-3.png"class="mail" alt="footer-con" />
                   <a href="mailto:info@jaff.com.bd" >info@jaff.com.bd</a>
               </div>
               </div>-->
                   <div class="loc justifed">
                       <div class="loc-img">
                           <img src="{{asset('public/img/contact-1.png')}}" alt="loc-image" />
                       </div>
                       <p class="">Jaff Street Bashundhara Main Gate,Opposite  of Jamuna Future Park Sidegate,Dhaka</p>
                   </div>
                   <div class="con text-center">
                       <div class="con-img">
                           <img src="{{asset('public/img/contact-2.png')}}" alt="con-image" />
                       </div>
                       <p>+8801304229158</p>
                   </div>
                   <div class="mess text-center">
                       <div class="mess-img">
                           <img src="{{asset('public/img/contact-3.png')}}" alt="message-image" />
                       </div>
                       <p> <a href="mailto:info@jaff.com.bd">info@jaff.com.bd</a></p>
                   </div>
        </div>
    </div>
    </div>
    <div class="footer-end text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer-social">
                    <li class="fbook"><a href=""><i class="fa fa-facebook"></i></a></li>
                    <li><a href=""><img src="{{asset('public/img/fa-google-plus.png')}}"></a></li>
                    <li><a href=""><i class="fa fa-instagram"></i></a></li>
                    <li><a href=""><i class="fa fa-rss"></i></a></li>
                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-end1">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <p>Copyright &copy; 2019.All right recieved. Designed By <a href=""><img src="{{asset('public/img/logo_bsd.png')}}" alt="bsd logo"></a></p>
                </div>
            </div>
        </div>
    </div>
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

<script type='text/javascript' src='../public/js/front/wow.min.js'></script>

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
