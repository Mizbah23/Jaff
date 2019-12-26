@extends('user.master')
@section('title'){{$title}}@stop
@section('style')

@stop

@section('header')
    @include('user.layout.common_header')
@stop

@section('content')
<div class="content">

<div class="path-section" style="background-image: url({{asset('public/img/slide-1.jpg')}})">
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
                            <input type="checkbox">
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
       
        </div>

    </section>
                <!-- // Full calendar end -->

            </div>
        </div>
                   
                        
                    
                

                
        
    </div>

</div>
</div>
@stop

@section('footer')
    @include('user.layout.footer')
@stop
@section('script')
@stop