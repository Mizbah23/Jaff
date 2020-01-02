<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand">
                <div><img class="brand-logo" src="{{asset('public/img/app-logo.png')}}"></div>
                <h2 class="brand-text mb-0">Admin</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i>
                    <i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                <li class=" nav-item db">
                    <a href="{{route('admin.dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span class="menu-title" data-i18n="Email">Dashboard</span>
                    </a>
                </li>

            <li class="navigation-header"><span>Website</span></li>
                
            @if(session()->has('user'))
            <li class=" nav-item usr">
                <a href="{{route('user')}}"><i class="feather icon-users"></i>
                <span class="menu-title" data-i18n="Email">Users</span></a>
            </li> 
            @endif
                
               
                
                
                
            <li class="hp nav-item">
                <a href="#">
                    <i class="feather icon-home"></i>
                    <span class="menu-title" data-i18n="Ecommerce">HomePage</span>
                </a>
                <ul class="menu-content">
                    
                    <li class="sldr">
                        <a href="{{route('sliderlist')}}">
                            <i class="feather icon-sliders"></i><span class="menu-item" data-i18n="Shop">Sliders</span>
                        </a>
                    </li>

                    <li class=" nav-item abouts">
                        <a href="{{route('abouts')}}"><i class="feather icon-file-text"></i>
                        <span class="menu-title" data-i18n="Email">About us</span></a>
                    </li>
                    
                    <li class=" nav-item prog">
                        <a href="{{route('programs')}}"><i class="feather icon-flag"></i>
                        <span class="menu-title" data-i18n="Email">Programs</span></a>
                    </li>

                    <li class=" nav-item co">
                        <a href="{{route('coaches')}}"><i class="feather icon-user"></i>
                        <span class="menu-title" data-i18n="Email">Academy Coaches</span></a>
                    </li>
                    
                    <li class=" nav-item images">
                        <a href="{{route('images')}}"><i class="feather icon-image"></i>
                        <span class="menu-title" data-i18n="Email">Single Images</span></a>
                    </li>
                    
                    <li class=" nav-item testimonials">
                        <a href="{{route('testimonials')}}"><i class="feather icon-clipboard"></i>
                        <span class="menu-title" data-i18n="Email">Testimonials</span></a>
                    </li>
                    
<!--                    <li class=" nav-item notices">
                        <a href="{{route('notices')}}"><i class="feather icon-clipboard"></i>
                        <span class="menu-title" data-i18n="Email">Notices</span></a>
                    </li>-->
                </ul>
            </li>
            
            
            <li class=" nav-item nw">
                    <a href="{{route('show.news')}}">
                        <i class="feather icon-message-square"></i>
                        <span class="menu-title" data-i18n="Email">News</span>
                    </a>
            </li>
            
            <li class=" nav-item notices">
                    <a href="{{route('notices')}}">
                        <i class="feather icon-clipboard"></i>
                        <span class="menu-title" data-i18n="Email">Notices</span>
                    </a>
            </li>
            
            
<!--            <li class="n nav-item">
                <a href="#">
                    <i class="feather icon-message-square"></i>
                    <span class="menu-title" data-i18n="Ecommerce">News & Updates</span>
                </a>
                <ul class="menu-content">
                    <li class="nw nav-item">
                        <a href="{{route('show.news')}}"><i class="feather icon-circle"></i>
                        <span class="menu-title" data-i18n="Email">News</span></a>
                    </li>
                </ul>
            </li>-->

                <li class="navigation-header"><span>Administration</span></li>
                
                <li class=" nav-item ucs">
                    <a href="{{route('setting.usr')}}"><i class="feather icon-settings"></i>
                    <span class="menu-title" data-i18n="Email">Settings</span></a>
                </li>
                
                @if(session()->has('admin'))
                <li class=" nav-item admn">
                    <a href="{{route('admin.user')}}"><i class="feather icon-users"></i>
                    <span class="menu-title" data-i18n="Email">Admins</span></a>
                </li>
                @endif
            <!--<li class="navigation-header"><span>Administration</span></li>-->
                @if(session()->has('ground'))
                <li class="grnd nav-item">
                    <a href="{{route('ground.setting')}}">
                        <i class="feather icon-map-pin"></i>
                        <span class="menu-title" data-i18n="Calender">Ground</span>
                    </a>
                </li>
                @endif
                <li class="s nav-item">
                    <a href="#">
                        <i class="feather icon-clock"></i>
                        <span class="menu-title" data-i18n="Ecommerce">Slots</span>
                    </a>
                    <ul class="menu-content">
                        @if(session()->has('week'))
                        <li class="wtyp nav-item">
                            <a href="{{route('get.weektype')}}">
                                <i class="feather icon-package"></i>
                                <span class="menu-title" data-i18n="Calender">Week & Type</span>
                            </a>
                        </li>
                        @endif
                        @if(session()->has('slot'))
                        <li class="slt nav-item">
                            <a href="{{route('slot.setting')}}">
                                <i class="feather icon-list"></i>
                                <span class="menu-title" data-i18n="Calender">Slot List</span>
                            </a>
                        </li>
                        @endif
                        @if(session()->has('ofr'))
                        <li class="ofr nav-item">
                            <a href="{{route('list.offer')}}">
                                <i class="feather icon-gift"></i>
                                <span class="menu-title" data-i18n="Calender">Offers</span>
                            </a>
                        </li>
                        @endif
                        @if(session()->has('hday'))
                        <li class="hld nav-item">
                            <a href="{{route('list.holiday')}}">
                                <i class="feather icon-clipboard"></i>
                                <span class="menu-title" data-i18n="Calender">Holidays</span>
                            </a>
                        </li>
                        @endif
                        @if(session()->has('fday'))
                        <li class="fday nav-item">
                            <a href="{{route('get.fday')}}">
                                <i class="feather icon-clipboard"></i>
                                <span class="menu-title" data-i18n="Calender">Full Day</span>
                            </a>
                        </li>
                        @endif
                  {{--       @if(session()->has('dday')) --}}
                        <li class="drp nav-item">
                            <a href="{{route('get.dropin')}}">
                                <i class="feather icon-clipboard"></i>
                                <span class="menu-title" data-i18n="Calender">Drop In</span>
                            </a>
                        </li>
         {{--                @endif --}}
                    </ul>
                </li>
                
                
                
            <li class="cour nav-item">
                <a href="#">
                    <i class="feather icon-hash"></i>
                    <span class="menu-title" data-i18n="Ecommerce">Courses</span>
                </a>
                <ul class="menu-content">
                    <li class="cl nav-item">
                        <a href="{{route('courses')}}"><i class="feather icon-circle"></i>
                        <span class="menu-title" data-i18n="Email">Course List</span></a>
                    </li>
                    <li class="as nav-item">
                        <a href="{{route('schedules')}}"><i class="feather icon-circle"></i>
                        <span class="menu-title" data-i18n="Email">Schedules</span></a>
                    </li>
                    <li class="cu nav-item">
                        <a href="{{route('user.courseList')}}"><i class="feather icon-circle"></i>
                        <span class="menu-title" data-i18n="Email">Assign Course</span></a>
                    </li>
                    
                    <li class="cpmenu nav-item">
                        <a href="{{route('show.cpayment')}}"><i class="feather icon-circle"></i>
                        <span class="menu-title" data-i18n="Email">Course Payments</span></a>
                    </li>
                    
                    
                    
                </ul>
            </li>
                
                

                @if(session()->has('cal'))
                <li class="cal nav-item">
                    <a href="{{route('calender.setting')}}">
                        <i class="feather icon-calendar"></i>
                        <span class="menu-title" data-i18n="Calender">Calender</span>
                    </a>
                </li>
                @endif
<!--                <li class=" nav-item">
                    <a href="">
                        <i class="feather icon-check-square"></i>
                        <span class="menu-title" data-i18n="Chat">Booking</span>
                    </a>
                </li>-->
                <li class="b nav-item">
                    <a href="#">
                        <i class="feather icon-check-square"></i>
                        <span class="menu-title" data-i18n="Ecommerce">Booking</span>
                    </a>
                    <ul class="menu-content">
                        <li class="bk">
                            <a href="{{route('show.bookings')}}">
                                <i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Total Booking</span>
                            </a>
                        </li>
                        <li class="bkslt">
                            <a href="{{route('show.bookedslot')}}">
                                <i class="feather icon-circle"></i><span class="menu-item" data-i18n="Wish List">Booked Slot</span>
                            </a>
                        </li>
                        <li class="bp">
                            <a href="{{route('show.bpayment')}}">
                                <i class="feather icon-circle"></i><span class="menu-item" data-i18n="Wish List">Payments</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="m nav-item">
                    <a href="#">
                        <i class="feather icon-user-plus"></i>
                        <span class="menu-title" data-i18n="Ecommerce">Memberships</span>
                    </a>
                    <ul class="menu-content">
                        <li class="membership">
                            <a href="{{route('membership')}}">
                                <i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Packages</span>
                            </a>
                        </li>
                        <li class="mem">
                            <a href="{{route('member')}}">
                                <i class="feather icon-circle"></i><span class="menu-item" data-i18n="Wish List">Members</span>
                            </a>
                        </li>
                        <li class="mr nav-item">
                        <a href="{{route('show.mpayment')}}"><i class="feather icon-circle"></i>
                        <span class="menu-title" data-i18n="Email">Payments</span></a>
                        </li>
                        
                        
                    </ul>
                </li>
                
                <li class="acc nav-item">
                    <a href="#">
                        <i class="feather icon-server"></i>
                        <span class="menu-title" data-i18n="Ecommerce">Accounts</span>
                    </a>
                    <ul class="menu-content">
                        <li class="asec">
                            <a href="{{route('show.aslist')}}">
                                <i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Parent Accounts</span>
                            </a>
                        </li>
                        <li class="agrp">
                            <a href="{{route('show.agrp')}}">
                                <i class="feather icon-circle"></i><span class="menu-item" data-i18n="Wish">Sub Accounts</span>
                            </a>
                        </li>
                        <li class="ac">
                            <a href="{{route('show.acc')}}">
                                <i class="feather icon-circle"></i><span class="menu-item" data-i18n="Wish">Accounts</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="blnc nav-item">
                    <a href="#">
                        <i class="feather icon-dollar-sign"></i>
                        <span class="menu-title" data-i18n="Ecommerce">Amounts</span>
                    </a>
                    <ul class="menu-content">
                        <li class="inc">
                            <a href="{{route('income')}}">
                                <i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Income</span>
                            </a>
                        </li>
                        <li class="exp">
                            <a href="{{route('expense')}}">
                                <i class="feather icon-circle"></i><span class="menu-item" data-i18n="Wish">Expense</span>
                            </a>
                        </li>
                        <li class="bl">
                            <a href="{{route('balance')}}">
                                <i class="feather icon-circle"></i><span class="menu-item" data-i18n="Wish">Balance</span>
                            </a>
                        </li>
                    </ul>
                </li>
            
            
<!--                <li class=" nav-item">
                    <a href="app-chat.html">
                        <i class="feather icon-message-square"></i>
                        <span class="menu-title" data-i18n="Chat">Chat</span>
                    </a>
                </li>

                <li class=" nav-item">
                    <a href="app-todo.html">
                        <i class="feather icon-check-square"></i>
                     <span class="menu-title" data-i18n="Todo">Todo</span>
                    </a>
                </li>

                <li class=" nav-item">
                    <a href="app-calender.html">
                        <i class="feather icon-calendar"></i>
                        <span class="menu-title" data-i18n="Calender">Calender</span>
                    </a>
                </li>-->


<!--                <li class=" nav-item">
                    <a href="#">
                        <i class="feather icon-shopping-cart"></i>
                        <span class="menu-title" data-i18n="Ecommerce">Ecommerce</span>
                    </a>
                    <ul class="menu-content">
                        <li><a href="app-ecommerce-shop.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Shop</span></a>
                        </li>
                        <li><a href="app-ecommerce-wishlist.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Wish List">Wish List</span></a>
                        </li>
                        <li><a href="app-ecommerce-checkout.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Checkout">Checkout</span></a>
                        </li>
                    </ul>
                </li>-->
<!--        
            <li class=" navigation-header"><span>UI Elements</span></li>

                <li class=" nav-item"><a href="#"><i class="feather icon-list"></i><span class="menu-title" data-i18n="Data List">Data List</span><span class="badge badge badge-primary badge-pill float-right mr-2">New</span></a>
                    <ul class="menu-content">
                        <li><a href="data-list-view.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List View">List View</span></a>
                        </li>
                        <li><a href="data-thumb-view.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Thumb View">Thumb View</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-layout"></i><span class="menu-title" data-i18n="Content">Content</span></a>
                    <ul class="menu-content">
                        <li><a href="content-grid.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Grid">Grid</span></a>
                        </li>
                        <li><a href="content-typography.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Typography">Typography</span></a>
                        </li>
                        <li><a href="content-text-utilities.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Text Utilities">Text Utilities</span></a>
                        </li>
                        <li><a href="content-syntax-highlighter.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Syntax Highlighter">Syntax Highlighter</span></a>
                        </li>
                        <li><a href="content-helper-classes.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Helper Classes">Helper Classes</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="colors.html"><i class="feather icon-droplet"></i><span class="menu-title" data-i18n="Colors">Colors</span></a>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-eye"></i><span class="menu-title" data-i18n="Icons">Icons</span></a>
                    <ul class="menu-content">
                        <li><a href="icons-feather.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Feather">Feather</span></a>
                        </li>
                        <li><a href="icons-font-awesome.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Font Awesome">Font Awesome</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-credit-card"></i><span class="menu-title" data-i18n="Card">Card</span></a>
                    <ul class="menu-content">
                        <li><a href="card-basic.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Basic">Basic</span></a>
                        </li>
                        <li><a href="card-advance.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Advance">Advance</span></a>
                        </li>
                        <li><a href="card-statistics.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Statistics">Statistics</span></a>
                        </li>
                        <li><a href="card-analytics.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Analytics</span></a>
                        </li>
                        <li><a href="card-actions.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Card Actions">Card Actions</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-briefcase"></i><span class="menu-title" data-i18n="Components">Components</span></a>
                    <ul class="menu-content">
                        <li><a href="component-alerts.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Alerts">Alerts</span></a>
                        </li>
                        <li><a href="component-buttons-basic.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Buttons">Buttons</span></a>
                        </li>
                        <li><a href="component-breadcrumbs.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Breadcrumbs">Breadcrumbs</span></a>
                        </li>
                        <li><a href="component-carousel.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Carousel">Carousel</span></a>
                        </li>
                        <li><a href="component-collapse.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Collapse">Collapse</span></a>
                        </li>
                        <li><a href="component-dropdowns.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Dropdowns">Dropdowns</span></a>
                        </li>
                        <li><a href="component-list-group.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List Group">List Group</span></a>
                        </li>
                        <li><a href="component-modals.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Modals">Modals</span></a>
                        </li>
                        <li><a href="component-pagination.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Pagination">Pagination</span></a>
                        </li>
                        <li><a href="component-navs-component.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Navs Component">Navs Component</span></a>
                        </li>
                        <li><a href="component-navbar.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Navbar">Navbar</span></a>
                        </li>
                        <li><a href="component-tabs-component.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Tabs Component">Tabs Component</span></a>
                        </li>
                        <li><a href="component-pills-component.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Pills Component">Pills Component</span></a>
                        </li>
                        <li><a href="component-tooltips.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Tooltips">Tooltips</span></a>
                        </li>
                        <li><a href="component-popovers.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Popovers">Popovers</span></a>
                        </li>
                        <li><a href="component-badges.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Badges">Badges</span></a>
                        </li>
                        <li><a href="component-pill-badges.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Pill Badges">Pill Badges</span></a>
                        </li>
                        <li><a href="component-progress.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Progress">Progress</span></a>
                        </li>
                        <li><a href="component-media-objects.html"><i class="feather icon-circle"></i><span class="menu-item">Media Objects</span></a>
                        </li>
                        <li><a href="component-spinner.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Spinner">Spinner</span></a>
                        </li>
                        <li><a href="component-bs-toast.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Toasts">Toasts</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-box"></i><span class="menu-title" data-i18n="Extra Components">Extra Components</span></a>
                    <ul class="menu-content">
                        <li><a href="ex-component-avatar.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Avatar">Avatar</span></a>
                        </li>
                        <li><a href="ex-component-chips.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Chips">Chips</span></a>
                        </li>
                        <li><a href="ex-component-divider.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Divider">Divider</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header"><span>Forms &amp; Tables</span>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-copy"></i><span class="menu-title" data-i18n="Form Elements">Form Elements</span></a>
                    <ul class="menu-content">
                        <li><a href="form-select.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Select">Select</span></a>
                        </li>
                        <li><a href="form-switch.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Switch">Switch</span></a>
                        </li>
                        <li><a href="form-checkbox.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Checkbox">Checkbox</span></a>
                        </li>
                        <li><a href="form-radio.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Radio">Radio</span></a>
                        </li>
                        <li><a href="form-inputs.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Input">Input</span></a>
                        </li>
                        <li><a href="form-input-groups.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Input Groups">Input Groups</span></a>
                        </li>
                        <li><a href="form-number-input.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Number Input">Number Input</span></a>
                        </li>
                        <li><a href="form-textarea.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Textarea">Textarea</span></a>
                        </li>
                        <li><a href="form-date-time-picker.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Date &amp; Time Picker">Date &amp; Time Picker</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="form-layout.html"><i class="feather icon-box"></i><span class="menu-title" data-i18n="Form Layout">Form Layout</span></a>
                </li>
                <li class=" nav-item"><a href="form-wizard.html"><i class="feather icon-package"></i><span class="menu-title" data-i18n="Form Wizard">Form Wizard</span></a>
                </li>
                <li class=" nav-item"><a href="form-validation.html"><i class="feather icon-check-circle"></i><span class="menu-title" data-i18n="Form Validation">Form Validation</span></a>
                </li>
                <li class=" nav-item"><a href="table.html"><i class="feather icon-server"></i><span class="menu-title" data-i18n="Table">Table</span></a>
                </li>
                <li class=" nav-item"><a href="table-datatable.html"><i class="feather icon-grid"></i><span class="menu-title" data-i18n="Datatable">Datatable</span></a>
                </li>
                <li class=" navigation-header"><span>pages</span>
                </li>
                <li class=" nav-item"><a href="page-user-profile.html"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Profile">Profile</span></a>
                </li>
                <li class=" nav-item"><a href="page-faq.html"><i class="feather icon-help-circle"></i><span class="menu-title" data-i18n="FAQ">FAQ</span></a>
                </li>
                <li class=" nav-item"><a href="page-knowledge-base.html"><i class="feather icon-info"></i><span class="menu-title" data-i18n="Knowledge Base">Knowledge Base</span></a>
                </li>
                <li class=" nav-item"><a href="page-search.html"><i class="feather icon-search"></i><span class="menu-title" data-i18n="Search">Search</span></a>
                </li>
                <li class=" nav-item"><a href="page-invoice.html"><i class="feather icon-file"></i><span class="menu-title" data-i18n="Invoice">Invoice</span></a>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-zap"></i><span class="menu-title" data-i18n="Starter kit">Starter kit</span></a>
                    <ul class="menu-content">
                        <li><a href="../../../starter-kit/ltr/vertical-menu-template-semi-dark/sk-layout-1-column.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="1 column">1 column</span></a>
                        </li>
                        <li><a href="../../../starter-kit/ltr/vertical-menu-template-semi-dark/sk-layout-2-columns.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="2 columns">2 columns</span></a>
                        </li>
                        <li><a href="../../../starter-kit/ltr/vertical-menu-template-semi-dark/sk-layout-fixed-navbar.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Fixed navbar">Fixed navbar</span></a>
                        </li>
                        <li><a href="../../../starter-kit/ltr/vertical-menu-template-semi-dark/sk-layout-floating-navbar.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Floating navbar">Floating navbar</span></a>
                        </li>
                        <li><a href="../../../starter-kit/ltr/vertical-menu-template-semi-dark/sk-layout-fixed.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Fixed layout">Fixed layout</span></a>
                        </li>
                        <li><a href="../../../starter-kit/ltr/vertical-menu-template-semi-dark/sk-layout-static.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Static layout">Static layout</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-unlock"></i><span class="menu-title" data-i18n="Authentication">Authentication</span></a>
                    <ul class="menu-content">
                        <li><a href="auth-login.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Login">Login</span></a>
                        </li>
                        <li><a href="auth-register.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Register">Register</span></a>
                        </li>
                        <li><a href="auth-forgot-password.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Forgot Password">Forgot Password</span></a>
                        </li>
                        <li><a href="auth-reset-password.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Reset Password">Reset Password</span></a>
                        </li>
                        <li><a href="auth-lock-screen.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Lock Screen">Lock Screen</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-file-text"></i><span class="menu-title" data-i18n="Miscellaneous">Miscellaneous</span></a>
                    <ul class="menu-content">
                        <li><a href="page-coming-soon.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Coming Soon">Coming Soon</span></a>
                        </li>
                        <li><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Error">Error</span></a>
                            <ul class="menu-content">
                                <li><a href="error-404.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="404">404</span></a>
                                </li>
                                <li><a href="error-500.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="500">500</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="page-not-authorized.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Not Authorized">Not Authorized</span></a>
                        </li>
                        <li><a href="page-maintenance.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Maintenance">Maintenance</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header"><span>Charts &amp; Maps</span>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-pie-chart"></i><span class="menu-title" data-i18n="Charts">Charts</span><span class="badge badge badge-pill badge-success float-right mr-2">3</span></a>
                    <ul class="menu-content">
                        <li><a href="chart-apex.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Apex">Apex</span></a>
                        </li>
                        <li><a href="chart-chartjs.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Chartjs">Chartjs</span></a>
                        </li>
                        <li><a href="chart-echarts.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Echarts">Echarts</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="maps-google.html"><i class="feather icon-map"></i><span class="menu-title" data-i18n="Google Maps">Google Maps</span></a>
                </li>
                <li class=" navigation-header"><span>Extensions</span>
                </li>
                <li class=" nav-item"><a href="ext-component-sweet-alerts.html"><i class="feather icon-alert-circle"></i><span class="menu-title" data-i18n="Sweet Alert">Sweet Alert</span></a>
                </li>
                <li class=" nav-item"><a href="ext-component-toastr.html"><i class="feather icon-zap"></i><span class="menu-title" data-i18n="Toastr">Toastr</span></a>
                </li>
                <li class=" nav-item"><a href="ext-component-noui-slider.html"><i class="feather icon-sliders"></i><span class="menu-title" data-i18n="NoUi Slider">NoUi Slider</span></a>
                </li>
                <li class=" nav-item"><a href="ext-component-file-uploader.html"><i class="feather icon-upload-cloud"></i><span class="menu-title" data-i18n="File Uploader">File Uploader</span></a>
                </li>
                <li class=" nav-item"><a href="ext-component-quill-editor.html"><i class="feather icon-edit"></i><span class="menu-title" data-i18n="Quill Editor">Quill Editor</span></a>
                </li>
                <li class=" nav-item"><a href="ext-component-drag-drop.html"><i class="feather icon-droplet"></i><span class="menu-title" data-i18n="Drag &amp; Drop">Drag &amp; Drop</span></a>
                </li>
                <li class=" nav-item"><a href="ext-component-tour.html"><i class="feather icon-info"></i><span class="menu-title" data-i18n="Tour">Tour</span></a>
                </li>
                <li class=" nav-item"><a href="ext-component-clipboard.html"><i class="feather icon-copy"></i><span class="menu-title" data-i18n="Clipboard">Clipboard</span></a>
                </li>
                <li class=" nav-item"><a href="ext-component-context-menu.html"><i class="feather icon-more-horizontal"></i><span class="menu-title" data-i18n="Context Menu">Context Menu</span></a>
                </li>
                <li class=" nav-item"><a href="ext-component-i18n.html"><i class="feather icon-globe"></i><span class="menu-title" data-i18n="l18n">l18n</span></a>
                </li>
                <li class=" navigation-header"><span>Others</span>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-menu"></i><span class="menu-title" data-i18n="Menu Levels">Menu Levels</span></a>
                    <ul class="menu-content">
                        <li><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Second Level">Second Level</span></a>
                        </li>
                        <li><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Second Level">Second Level</span></a>
                            <ul class="menu-content">
                                <li><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Third Level">Third Level</span></a>
                                </li>
                                <li><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Third Level">Third Level</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="disabled nav-item"><a href="#"><i class="feather icon-eye-off"></i><span class="menu-title" data-i18n="Disabled Menu">Disabled Menu</span></a>
                </li>
                <li class=" navigation-header"><span>Support</span>
                </li>
                <li class=" nav-item"><a href="changelog.html"><i class="feather icon-file"></i><span class="menu-title" data-i18n="">Changelog</span><span class="badge badge badge-pill badge-danger float-right">1.0</span></a>
                </li>
                <li class=" nav-item"><a href="https://pixinvent.com/demo/vuesax-html-admin-dashboard-template/documentation"><i class="feather icon-folder"></i><span class="menu-title" data-i18n="Documentation">Documentation</span></a>
                </li>
                <li class=" nav-item"><a href="https://pixinvent.ticksy.com/"><i class="feather icon-life-buoy"></i><span class="menu-title" data-i18n="Raise Support">Raise Support</span></a>
                </li>
                -->
            </ul>
            
            
            
            

        </div>
    </div>