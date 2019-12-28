        <header class="header sticky-wrapper sticky-bar">
	    
            <div class="container">
		<div class="row">
                    
                    <div class="col-md-2 col-xs-3">
                        <div class="logo"><a class="to-top" href="#goto-top"><img src="public/img/app-logo.png"></div>
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
                            <a title="About" href="#about_us-section">About</a>
                        </li>
                        <li id="menu-item-308" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-308">
                            <a title="Classes" href="#classes-section">Programs</a>
                        </li>
                        <li id="menu-item-309" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-309">
                            <a title="Trainers" href="#trainers-section">Coaches</a>
                        </li>
                        <li id="menu-item-309" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-309">
                            <a title="Trainers" href="{{route('user.news')}}">News</a>
                        </li>

                        <li id="menu-item-310" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-310">
                            <a title="Contact" href="#contact-section">Contact</a>
                        </li>

                       
                        @if(Auth::guard('web')->check())
                        <li id="menu-item-404" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-404 dropdown">
                            <a title="Blog" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true"><i class="fa fa-user"></i> {{Auth::guard('web')->user()->username}}
                                <span class="caret"></span>
                            </a>
                            <ul role="menu" class="dropdown-menu">
<!--                                <li id="menu-item-311" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-311">
                                    <a title="Blog" href="#blog">Profile</a>
                                </li>-->
                                <li id="menu-item-408" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-408">
                                    <a title="Blog Page" href="{{route('logout')}}">Logout</a>
                                </li>
                            </ul>
                        </li>
                        @else
                         <li id="menu-item-305" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-305 ">
                        <a title="Login" href="{{route('login')}}" aria-haspopup="true"><i class="fa fa-user"></i> Login </a>
                        </li>
                        @endif
                        
                    
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