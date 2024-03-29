@extends('layouts.master')
@section('title','Mentee Registration')
@section('content')
	
	<section class="gray-wrapper gray-wide-space ">
	<div class="container">
		<div class="login-wrapper">
			<div class="login-header justify-center">
				<h3>Sign up as mentee</h3>
			</div>
			
			<div class="col-md-12 border-bottom row m-0 mt-4 pb-4 justify-content-center flex-column">
			    <div>
				    <a href="{{route('socialite.login',['web','google'])}}" class="google-btn">
    					<i class="fab fa-google"></i>Signup with Google
    				</a>
				</div>
			    <div>
			        <a href="{{route('socialite.login',['web','facebook'])}}" class="fbook-btn">
    					<i class="fab fa-facebook-square"></i>Signup with Facebook
    				</a>
			    </div>
			</div>

			<form method="post" action="{{route('registration.mentee_mentor')}}">
				@csrf
				<div class="form-wrapper">
					@error('signup')
		  				<span class="text-success">{{$message}}</span>
          			@enderror
				</div>
				<input type="hidden" name="registration_type" value="mentee" required readonly>
				<div class="form-wrapper">
					<div class="form-group">
					  	<input type="text" name="first_name" class="input-style" id="firstname" placeholder="First name" value="{{old('first_name')}}">
					  	@error('first_name')
					  		<span class="text-danger">{{$message}}</span>
                      	@enderror
					</div>
					<div class="form-group">
					  	<input type="text" class="input-style" name="last_name" id="Lastname" placeholder="Last name" value="{{old('last_name')}}">
					  	@error('last_name')
					  		<span class="text-danger">{{$message}}</span>
                      	@enderror
					</div>
					<div class="form-group">
					  	<input type="email" class="input-style" name="email" id="email" placeholder="Email address" value="{{old('email')}}">
					  	@error('email')
					  		<span class="text-danger">{{$message}}</span>
                      	@enderror
					</div>
					<div class="form-group">
					  	<input type="password" class="input-style" name="password" id="password" placeholder="New password">
					  	@error('password')
					  		<span class="text-danger">{{$message}}</span>
                      	@enderror
					</div>
					<div class="form-group">
					  <input type="password" class="input-style" name="password_confirmation" id="password_confirmation" placeholder="Confirm password">
					</div>
					<div class="form-group">
						<input type="text" class="input-style" name="referral_code" id="code" placeholder="Referral code (optional)" @if(!empty($req->referral_code))value="{{(old('referral_code') ? old('referral_code') : $req->referral_code ) }}" @endif>
						@error('referral_code')
							<span class="text-danger">{{$message}}</span>
						@enderror
				  	</div>
					<div class="form-group">
					  <input type="submit" class="button-style" id="" value="Submit">
					</div>
					<div class="disclaimer-place">
						By clicking Sign up, you agree to mentorly <br>
						<a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

@section('script')
	<script type="text/javascript">
		// $(function() {
		// 	alert('works');
		// });
	</script>
@stop
@endsection