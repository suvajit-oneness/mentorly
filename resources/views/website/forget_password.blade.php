@extends('layouts.master')
@section('title','Forget password')
@section('content')

<section class="gray-wrapper gray-wide-space">
	<div class="container">
		<div class="login-wrapper">
			<div class="login-header justify-center">
				<h3>Forgot your password?</h3>
			</div>
			<form method="post" action="{{route('both.forget.password.post',$userType)}}">
				@csrf
				<div class="form-wrapper">
					<div class="form-group">
						@error('success')
					  		<span class="text-success">{{$message}}</span>
					  	@enderror
					  	<input type="text" class="input-style" name="email" id="email" placeholder="Enter your email address" value="{{old('email')}}">
						@error('email')
					  		<span class="text-danger">{{$message}}</span>
					  	@enderror

					</div>
					<div class="form-group">
					  <input type="submit" class="button-style" id="" value="Submit">
					</div>
				</div>
			</form>
		</div>
	</div>
</section>	

@section('script')
	<script type="text/javascript"></script>
@stop
@endsection