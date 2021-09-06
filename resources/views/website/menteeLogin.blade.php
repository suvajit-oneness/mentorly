@extends('layouts.master')
@section('title','Login')
@section('content')

	<section class="gray-wrapper gray-wide-space">
	<div class="container">
		<div class="login-wrapper">
			<div class="login-header">
				<h3>Log In</h3>
				<ul class="log-list">
					<li><a href="{{route('singup.mentee')}}">Sign up as mentee</a></li>
					<li><a href="{{route('singup.mentor')}}">Sign up as mentor</a></li>
				</ul>
			</div>
			
			<div class="col-md-12 border-bottom row m-0 mt-4 pb-4 justify-content-center">
			    <div>
			        <a href="{{route('socialite.login',['web','facebook'])}}" class="fbook-btn">
    					<i class="fab fa-facebook-square"></i>Login with Facebook
    				</a>
			    </div>
				<div>
				    <a href="{{route('socialite.login',['web','google'])}}" class="google-btn">
    					<i class="fab fa-google"></i>Login with Google
    				</a>
				</div>
			</div>

			<form method="post" action="{{url('/mentor/mentee/login')}}">
				@csrf
				<input type="hidden" name="loginType" value="mentee">
				<div class="form-wrapper">
					<div class="form-group">
					  	<input type="email" id="email" name="email" class="input-style" placeholder="Enter your email address" autocomplete="email" value="{{ old('email') }}">
					  	@error('email')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    	@enderror
					</div>
					<div class="form-group">
					  	<input type="password" name="password" class="input-style" placeholder="Enter your password">
					  	@error('password')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    	@enderror
					</div>
					<div class="form-text-custom">
					  	<label class="form-check-label-custom">
					    	<input type="checkbox" class="form-check-input" value=""> Remember me<i></i>
					  	</label>
					 	<a href="{{route('both.forget.password','mentee')}}" class="text-link">Forgot your password?</a>
					</div>
					<div class="form-group">
					  	<input type="submit" class="button-style" id="" value="Log In">
					</div>
				</div>
			</form>

			 <!--<div class="row">
        <div class="col-md-12 row-block">
            <a href="{{route('socialite.login',['web','google'])}}" class="btn btn-lg btn-primary btn-block">
                <strong>Login With Google</strong>
            </a>     
        </div>
    </div>-->


    
		</div>
	</div>
</section>

@section('script')
	<script type="text/javascript"></script>
@stop
@endsection
