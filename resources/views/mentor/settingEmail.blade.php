@extends('layouts.master')
@section('title','Email Setting')
@section('content')
<section class="gray-wrapper">
	<div class="setting-wrapper">
		<ul class="setting-list">
			<li><a href="{{route('mentor.mentee.setting')}}">Account</a></li>
			<li><a href="{{route('mentor.email.setting')}}" class="active">Email</a></li>
			<li><a href="{{route('mentor.password.setting')}}">Password </a></li>
			<li><a href="#">Payment Methods</a></li>
			<li><a href="#">Payment History</a></li>
			<li><a href="#">Calendar</a></li>
		</ul>
		<div class="settings-details">
			<form method="post" action="{{route('mentor.email.update')}}">
				@csrf
				<div class="settings-heading mb-5">Email</div>
				<div class="form-group">
					<div class="row align-items-center">
						<label class="col-md-4">Email</label>
						<div class="col-md-8">
							<input type="hidden" name="guardType" value="{{$guard}}">
							<input type="hidden" name="authId" value="{{$user->id}}">
				  			<input type="text" name="email" class="input-style" id="email" placeholder="Enter your email address" value="@if(old('email')){{old('email')}}@else{{$user->email}}@endif">
				  			@error('email')
				  				<span class="text-danger">{{$message}}</span>
				  			@enderror
				  		</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row align-items-center">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<div class="form-group">
				  				<input type="submit" class="rounded-button-style" id="" value="Save settings">
				  			</div>
				  		</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

<section class="footer-top" style="background: url('./design/images/footer-top.jpg') no-repeat center center; background-size: cover; ">
	<div class="container">
		<h4>Every year n people prepare to interview confidently on mentorly. Get fast results with professional mentors. Prepare to achieve your goals today. </h4>

		<a href="#" class="prinery-btm blue-btm">Get Started</a>
	</div>
</section>

@section('script')
	<script type="text/javascript"></script>
@stop
@endsection