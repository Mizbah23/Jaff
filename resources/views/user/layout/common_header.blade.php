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
                    @if(empty(Auth::guard('web')->user()))    
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
                                        <a title="Classes" href="{{route('home')}}#classes-section">Program</a>
                                    </li>
                                    <li id="menu-item-309" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-309">
                                        <a title="Coaches" href="{{route('home')}}#trainers-section">Coaches</a>
                                    </li>
                                    <li id="menu-item-309" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-309">
                                        <a title="News" href="{{route('user.news')}}">News</a>
                                    </li>

                                    <li id="menu-item-310" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-310">
                                        <a title="Contact" href="{{route('home')}}#contact-section">Contact</a>
                                    </li>
                                       <li id="menu-item-305" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-305 ">
                                        <a title="Login" href="{{route('login')}}" aria-haspopup="true"><i class="fa fa-user"></i> Login </a>
                                    </li>
                                    
                                    
                                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="fa fa-cart-plus"></i><span class="caret"></span><span class="badge badge-pill badge-primary badge-up">5</span></a>
                                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                     <li class="dropdown-menu-header">
                                        <div class="dropdown-header m-0 p-2">
                                            <h3 class="white">5 New</h3><span class="notification-title">App Notifications</span>
                                        </div>
                                     </li>
                                    <li class="scrollable-container media-list"><a class="d-flex justify-content-between" href="javascript:void(0)">
                                            <div class="media d-flex align-items-start">
                                                <div class="media-left"><i class="feather icon-plus-square font-medium-5 primary"></i></div>
                                                <div class="media-body">
                                                    <h6 class="primary media-heading">You have new order!</h6><small class="notification-text"> Are your going to meet me tonight?</small>
                                                </div><small>
                                                    <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">9 hours ago</time></small>
                                            </div>
                                        </a><a class="d-flex justify-content-between" href="javascript:void(0)">
                                            <div class="media d-flex align-items-start">
                                                <div class="media-left"><i class="feather icon-download-cloud font-medium-5 success"></i></div>
                                                <div class="media-body">
                                                    <h6 class="success media-heading red darken-1">99% Server load</h6><small class="notification-text">You got new order of goods.</small>
                                                </div><small>
                                                    <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">5 hour ago</time></small>
                                            </div>
                                        </a><a class="d-flex justify-content-between" href="javascript:void(0)">
                                            <div class="media d-flex align-items-start">
                                                <div class="media-left"><i class="feather icon-alert-triangle font-medium-5 danger"></i></div>
                                                <div class="media-body">
                                                    <h6 class="danger media-heading yellow darken-3">Warning notifixation</h6><small class="notification-text">Server have 99% CPU usage.</small>
                                                </div><small>
                                                    <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">Today</time></small>
                                            </div>
                                        </a><a class="d-flex justify-content-between" href="javascript:void(0)">
                                            <div class="media d-flex align-items-start">
                                                <div class="media-left"><i class="feather icon-check-circle font-medium-5 info"></i></div>
                                                <div class="media-body">
                                                    <h6 class="info media-heading">Complete the task</h6><small class="notification-text">Cake sesame snaps cupcake</small>
                                                </div><small>
                                                    <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">Last week</time></small>
                                            </div>
                                        </a><a class="d-flex justify-content-between" href="javascript:void(0)">
                                            <div class="media d-flex align-items-start">
                                                <div class="media-left"><i class="feather icon-file font-medium-5 warning"></i></div>
                                                <div class="media-body">
                                                    <h6 class="warning media-heading">Generate monthly report</h6><small class="notification-text">Chocolate cake oat cake tiramisu marzipan</small>
                                                </div><small>
                                                    <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">Last month</time></small>
                                                    </div>
                                                </a></li>
                                            <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center" href="javascript:void(0)">Read all notifications</a></li>
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
                        @else
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
                                        <a title="Classes" href="{{route('home')}}#classes-section">Classes</a>
                                    </li>
                                    <li id="menu-item-309" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-309">
                                        <a title="Coaches" href="{{route('home')}}#trainers-section">Coaches</a>
                                    </li>
                                    <li id="menu-item-309" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-309">
                                        <a title="News" href="{{route('user.news')}}">News</a>
                                    </li>

                                    <li id="menu-item-310" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-310">
                                        <a title="Contact" href="{{route('home')}}#contact-section">Contact</a>
                                    </li>
                                    <li id="menu-item-305" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-305 dropdown">
                                        <a title="Pages" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Profile <span class="caret"></span></a>
                                        <ul role="menu" class="dropdown-menu">
                                            <li id="menu-item-405" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-405">
                                              <a title="Time Table" href="time.html">{{Auth::guard('web')->user()->username}}</a>
                                            </li>
                                            <li id="menu-item-407" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-407">
                                                <a title="Shortcodes" href="{{route('logout')}}">Logout</a>
                                            </li>
                                        </ul>
                                    </li>
                                    
                                    
                                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="fa fa-cart-plus"></i><span class="caret"></span><span class="badge badge-pill badge-primary badge-up">5</span></a>
                                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                     <li class="dropdown-menu-header">
                                        <div class="dropdown-header m-0 p-2">
                                            <h3 class="white">5 New</h3><span class="notification-title">App Notifications</span>
                                        </div>
                                     </li>
                                    <li class="scrollable-container media-list"><a class="d-flex justify-content-between" href="javascript:void(0)">
                                            <div class="media d-flex align-items-start">
                                                <div class="media-left"><i class="feather icon-plus-square font-medium-5 primary"></i></div>
                                                <div class="media-body">
                                                    <h6 class="primary media-heading">You have new order!</h6><small class="notification-text"> Are your going to meet me tonight?</small>
                                                </div><small>
                                                    <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">9 hours ago</time></small>
                                            </div>
                                        </a><a class="d-flex justify-content-between" href="javascript:void(0)">
                                            <div class="media d-flex align-items-start">
                                                <div class="media-left"><i class="feather icon-download-cloud font-medium-5 success"></i></div>
                                                <div class="media-body">
                                                    <h6 class="success media-heading red darken-1">99% Server load</h6><small class="notification-text">You got new order of goods.</small>
                                                </div><small>
                                                    <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">5 hour ago</time></small>
                                            </div>
                                        </a><a class="d-flex justify-content-between" href="javascript:void(0)">
                                            <div class="media d-flex align-items-start">
                                                <div class="media-left"><i class="feather icon-alert-triangle font-medium-5 danger"></i></div>
                                                <div class="media-body">
                                                    <h6 class="danger media-heading yellow darken-3">Warning notifixation</h6><small class="notification-text">Server have 99% CPU usage.</small>
                                                </div><small>
                                                    <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">Today</time></small>
                                            </div>
                                        </a><a class="d-flex justify-content-between" href="javascript:void(0)">
                                            <div class="media d-flex align-items-start">
                                                <div class="media-left"><i class="feather icon-check-circle font-medium-5 info"></i></div>
                                                <div class="media-body">
                                                    <h6 class="info media-heading">Complete the task</h6><small class="notification-text">Cake sesame snaps cupcake</small>
                                                </div><small>
                                                    <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">Last week</time></small>
                                            </div>
                                        </a><a class="d-flex justify-content-between" href="javascript:void(0)">
                                            <div class="media d-flex align-items-start">
                                                <div class="media-left"><i class="feather icon-file font-medium-5 warning"></i></div>
                                                <div class="media-body">
                                                    <h6 class="warning media-heading">Generate monthly report</h6><small class="notification-text">Chocolate cake oat cake tiramisu marzipan</small>
                                                </div><small>
                                                    <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">Last month</time></small>
                                                    </div>
                                                </a></li>
                                            <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center" href="javascript:void(0)">Read all notifications</a></li>
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
                        @endif
                    </div>
                    
                </div>
            </div>

        </header>