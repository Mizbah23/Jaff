@extends('user.master')
@section('title'){{$title}}@stop

@section('search.con')
        <div class="container">
       	<div class="row">
        	<div class="col-md-12">
                    <div class="broad_camp_title">
                            <h3>Sign Up</h3>
                    </div><!--/.broad_camp_title-->
            </div>
		</div>
	</div>


@stop
@section('content')        
        
        
<section class="contact_page_m" style="padding-bottom: 80px;">
	<div class="container">
	    <form action="{{route('register')}}" name="registerForm" id="registerSubmitButton" method="post" accept-charset="utf-8">
                <div class="row">
                        <input type="hidden" name="lat" value="" class="lat">
                        <input type="hidden" name="long" value="" class="long">

                        <div class="col-md-4 offset-md-4">
                                <div class="form-group">
                                        <input type="text" class="form-control" name="first_name" placeholder="First Name" autofocus>
                                </div>
                                <div class="form-group">
                                        <input type="text" class="form-control" name="last_name" id="street"placeholder="Last Name">
                                </div>
                            {{csrf_field()}}
                                <div class="form-group">
                                        <input type="text" class="form-control" id="housenr" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                                </div>
                                <button type="submit" id="registerForm" class="btn btn-primary btn-block">Submit</button>
                        </div>
                </div>
	    <div id="resultInregister"></div>
	</form>	
   </div>
</section>      
@stop
@section('footer')
    @include('user.layout.footer')
@stop




