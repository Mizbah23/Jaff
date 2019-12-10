<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuesax admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuesax admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Login Page - Jaff Sports</title>
    <link rel="apple-touch-icon" href="{{asset('/public/favicon.ico')}}">
    <link rel="icon" type="image/ico" href="{{asset('/public/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/css/back/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/css/back/bootstrap-extended.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/css/back/colors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/css/back/components.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/css/back/dark-layout.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/css/back/semi-dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/css/back/vertical-menu.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/palette-gradient.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/authentication.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/style.css')}}">
    <script src="{{asset('public/css/back/vue.js')}}"></script>
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 1-column  
      navbar-floating footer-static  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" 
      data-col="1-column" data-layout="semi-dark-layout" style="background-image:url({{asset('public/img/login-bg.jpg')}})">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-xl-8 col-11 d-flex justify-content-center">
                        <div class="card bg-authentication rounded-0 mb-0">
                            <div class="row m-0">
                                <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                                    <img src="{{asset('public/img/login.png')}}" alt="branding logo">
                                </div>
                                <div class="col-lg-6 col-12 p-0">
                                    <div class="card rounded-0 mb-0 px-2">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="mb-0">Login</h4>
                                            </div>
                                        </div>
                                        <p class="px-2">Please login to your account.</p>
                                        
                                        <div class="card-content">
                                            <div class="card-body pt-1">
                                                
                                                <form id="app" @submit="checkForm" action="{{route('admin.login.submit')}}" method="post">
                                                     @if (session('message'))
                                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                            <p class="mb-0">
                                            {{ session('message') }}
                                            </p>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            @elseif(session('error'))
                                              <div class="alert alert-danger alert-dismissible fade show" role="alert">

                                            <p class="mb-0"> <i class="feather icon-info mr-1 align-middle">
                                              </i>
                                            {{ session('error') }}
                                            </p>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            @endif
                                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                        <input type="text" v-model="email" class="form-control" name="email" placeholder="Enter Admin Email." value="{{old('email')}}" required>
                                                        <div class="form-control-position">
                                                            <i class="feather icon-mail"></i>
                                                        </div>
                                                        <label for="user-name">phone</label>
                                                    </fieldset>

                                                    <fieldset class="form-label-group position-relative has-icon-left">
                                                        <input type="password" v-model="password" name="password" class="form-control" id="user-password" placeholder="Password" required>
                                                        <div class="form-control-position">
                                                            <i class="feather icon-lock"></i>
                                                        </div>
                                                        <label for="user-password">Password</label>
                                                    </fieldset>
                                            <div class="error alert-danger">{{$errors->first('password')}}</div>
                                                    
                                                    {{csrf_field()}}
                                                    <div class="form-group d-flex justify-content-between align-items-center">
                                                        <div class="text-left">
                                                            <fieldset class="checkbox">
                                                                
                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                    <input type="checkbox" id="remember" {{old('remember') ? 'checked' : ''}} >
                                                                    <span class="vs-checkbox">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                                                    
                                                                    <span class="">Remember me</span>
                                                                </div>
                                                                
                                                            </fieldset>
                                                        </div>
                                                        <!--<div class="text-right"><a href="auth-forgot-password.html" class="card-link">Forgot Password?</a></div>-->
                                                    </div>
                                               
                                                    <button type="submit" class="btn btn-primary float-left btn-inline">Login</button>
                                                </form>
                                            </div>
                                        </div>
                                                    
                                        <div class="login-footer">
                                            <div class="divider">
                                                <div class="divider-text"></div>
                                            </div>
<!--                                            <div class="footer-btn d-inline">
                                                <a href="#" class="btn btn-facebook"><span class="fa fa-facebook"></span></a>
                                                <a href="#" class="btn btn-twitter white"><span class="fa fa-twitter"></span></a>
                                                <a href="#" class="btn btn-google"><span class="fa fa-google"></span></a>
                                                <a href="#" class="btn btn-github"><span class="fa fa-github-alt"></span></a>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('public/js/back/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('public/js/back/app-menu.min.js')}}"></script>
    <script src="{{asset('public/js/back/app.min.js')}}"></script>
    <script src="{{asset('public/js/back/components.min.js')}}"></script>

<script>
const app = new Vue({
    el: '#app',
    data: {
        email: null,password: null
    },
    methods:{
        isNumber: function(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
              evt.preventDefault();;
            } else { return true;
            }
        },
        checkForm: function (e) {
          if (this.email && this.password) {
            return true;
          }
          this.errors = [];
          if (!this.email) {
            this.errors.push('Name required.');
          }
          if (!this.password) {
            this.error = 'Password required';
          }
          e.preventDefault();
        }
    }
});
</script>

</body>
<!-- END: Body-->

</html>