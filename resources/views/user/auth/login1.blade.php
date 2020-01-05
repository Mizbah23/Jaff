@extends('user.master')
@section('title'){{$title}}@stop
@section('style')

@stop

@section('header')
            <header class="header sticky-wrapper sticky-bar">
        
            <div class="container">
        <div class="row">
                    
                    <div class="col-md-2 col-xs-3">
                        <div class="logo"><a class="to-top" href="#goto-top"><img src="{{asset('public/img/app-logo.png')}}"></div>
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

                        <li id="menu-item-305" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-305 ">
                            <a title="Cart" href="{{route('usrcart')}}" aria-haspopup="true">
                                <i class="fa fa-cart-plus"></i>
                                <span class="badge badge-pill badge-primary badge-up tcart" style="background-color: #024279;">{{Cart::count()}}</span>
                            </a>
                        </li> 

                                </ul>                           
                            </div>
                        </nav>
                    </div>
                    
                </div>
            </div>

        </header>
@stop

@section('content')
<div class="content">

{{-- <div class="path-section" style="background-image: url({{asset('public/img/slide-1.jpg')}})">
    <div class="bg-cover" style="padding: 90px 0 20px">
    <div class="container">
            <h3>Time Table</h3>
        </div>
    </div>
</div>
		 --}}		
<div class="blog-section page_spacing">
    <div class="container-fluid shortcode-view">
        
           
                    
          <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Full calendar start -->
        <section class="signin-form">
        
        {{-- <div class="overlay">
 --}}            <div class="wrapper">
                <div class="logo text-center top-bottom-gap">

 
                </div>
                <div class="form34">
                    <center><a class="brand-logo" href="{{route('home')}}">
                    <img src="public/img/app-logo.png" alt="Jaff logo" title="Jaff" style="height:50px;" />
                    </a> </center>
                    <center><h4 class="form-head">Sign in now</h4></center>
                    
                    @if (session('success'))
                    <div class="alert alert-success">
                    {{ session('success') }}
                     </div>
                    @endif
                    <form action="{{route('loginPost')}}" method="post">
                        @csrf
                        <div class="">
                            <!-- <p class="text-head">Username</p> -->
                            <input type="text" name="phone" class="input" value="{{old('phone')}}" placeholder="Phone" required="" />
                        </div>

                        <div class="">
                            <!-- <p class="text-head">Password</p> -->
                            <input type="password" name="password" class="input" placeholder="Password" required="" />
                                 @if(session('errors'))
                                 <div >
                                 <span style="color: red">{{$errors}}</span>
                                 </div>
                                 @endif
                        </div>
                        
                        <label class="remember">
                            <input type="checkbox" name="remember">
                            <span class="checkmark"></span>Remember me
                        </label>
                        <span class="psw">Forgot <a href="{{route('forgotPassword')}}">password?</a></span>
                        <br>
                        <button type="submit" class="signinbutton btn">Sign in</button>
                        <p class="signup">Have not an account yet?<a href="{{route('signup')}}" class="signuplink">Sign up</a>
                        </p>

                    </form>

                       
                </div>
            </div>
       
        {{-- </div> --}}

    </section>
                <!-- // Full calendar end -->

            </div>
        </div>
                   
                        
                    
                

                
        
    </div>

</div>
</div>
@stop

@section('footer')
    {{-- @include('user.layout.footer') --}}
@stop
@section('script')
@stop