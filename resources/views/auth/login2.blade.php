@extends('user.master')
@section('title'){{$title}}@stop

@section('search.con')
    <div class="container">
       	<div class="row">
        	<div class="col-md-12">
				<div class="broad_camp_title">
					<h3>Sign In</h3>
				</div><!--/.broad_camp_title-->
			</div>
		</div>
	</div><!--/.container-->


@stop
@section('content')        
        
        
<section class="contact_page_m" style="padding-bottom: 80px;">
	<div class="container">
		<form action="{{route('login')}}" method="post" accept-charset="utf-8">
			<div class="row">
				<div class="col-md-4 offset-md-4">
					<div class="form-group">
					    <input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter Username" required autofocus> 
					</div>

					<div class="form-group">
						<input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Enter password" required autofocus> 
					</div>
                                        {{csrf_field()}}
					<button type="submit" class="btn btn-primary btn-block">Login</button>
					<div class="row" style="margin-top: 30px;">
						<div class="col-md-4">
							<span class="text-left">Login with :</span>
						</div>
						<div class="col-md-4">
							<fb:login-button scope="public_profile,email" onlogin="checkLoginState();" >
				                <span style="padding: 20px;" >Facebook</span>
				            </fb:login-button>
				        </div>
				        <div class="col-md-4">
			             	<div class="g-signin2" data-width="83" data-height="24" data-onsuccess="onSignIn" data-onfailure="onSignInFailure"></div>
			            </div>
		         	</div>
					<div class="userContent" style="display: block;"></div>
		            <!-- Display login status -->
		            <div id="status"></div>
				</div>
			</div>
		</form>	</div>
</section>    

@stop
@section('footer')
    @include('user.layout.footer')
@stop




