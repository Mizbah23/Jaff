
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
                <div id="otpForm">
                <div class="form34">
                    <center><a class="brand-logo" href="{{route('home')}}">
                    <img src="../public/img/app-logo.png" alt="Jaff logo" title="Jaff" style="height:50px;" />
                    </a> </center>
                    <center><h4 class="form-head">Reset Your Password</h4></center>
                   

                    <form action="" method="post" id="signup">
                        @csrf

     
                        <div class="">
                                          @if (session('success'))
                                          <div class="alert alert-success">
                                           {{ session('success') }}
                                           </div>
                                           @endif
                            <!-- <p class="text-head">Password</p> -->
                            <input type="password" id="password" name="password" class="input" placeholder="Password"  required="" />
                        </div>
                             <div class="error" style="color: red">{{$errors->first('password')}}</div>


                        <div class="">
                            <!-- <p class="text-head">Password</p> -->
                            <input type="password" id="cpass" name="cpass" class="input" placeholder="Confirm Password"  required="" />
                        </div>
                         <div class="error">{{$errors->first('cpass')}}</div>
                        <button type="submit" id="submit" class="signinbutton btn">Confirm</button>
                      
                    </form>
                </div>
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



























