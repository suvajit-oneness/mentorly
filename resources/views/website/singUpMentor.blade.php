@extends('layouts.master')
@section('title','Mentor Registration')
@section('content')
<section class="mentor-signup-place">

		<div class="login-place-top" style="background:url('../design/images/process-image.jpg') no-repeat center top; background-size:cover">
			
			<div class="container">
				<div class="left-login">
					<form method="post" action="{{route('registration.mentee_mentor')}}">
						@csrf
						<input type="hidden" name="registration_type" value="mentor" readonly required>
						<div class="form-wrapper">

							<h3>Mentor Online with Mentorly</h3>
							<p>Earn money sharing your expert knowledge anywhere, anytime.</p>

							@error('signup')
				  				<span class="text-success">{{$message}}</span>
			      			@enderror

							<div class="form-group">
							  	<input type="email" name="email" class="input-style" id="email" placeholder="Email address" required value="{{old('email')}}">
							  	@error('email')
							  		<span class="text-danger">{{$message}}</span>
			                  	@enderror
							</div>

							<div class="form-group">
							  	<input type="password" name="password" class="input-style" id="password" placeholder="New password">
							  	@error('password')
							  		<span class="text-danger">{{$message}}</span>
			                  	@enderror
							</div>

							<div class="form-group">
							  	<input type="password" name="password_confirmation" class="input-style" id="password_confirmation" placeholder="Confirm password">
							</div>

							<div class="form-group">
								<input type="text" name="referral_code" id="code" class="input-style" placeholder="Referral code (optional)" @if(!empty($req->referral_code))value="{{(old('referral_code') ? old('referral_code') : $req->referral_code ) }}" @endif>
								@error('referral_code')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							
							<div class="form-group">
							  	<input type="submit" class="button-style" id="" value="Sign Up">
							</div>
							<div class="disclaimer-place">
								By clicking Sign up, you agree to mentorly <br>
								<a href="{{route('terms.condition')}}">Terms of Service</a> and <a href="{{route('policy')}}">Privacy Policy</a>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>



	<div class="container">

		<ul class="wedo-list">
			@foreach($data->becomeMentor as $key => $becomMentorSteps)
                <li>
                    <div class="box">
                        <figure><img src="{{asset($becomMentorSteps->media)}}"></figure>
                        <figcaption>
                            <h3>{{$becomMentorSteps->title}}</h3>
                        </figcaption>
                    </div>
                </li>
            @endforeach
        </ul>

		<ul class="mentor-comments row">
			@foreach($data->mentor as $key => $mentor)
				<li class=" col-12 col-sm-6 col-md-4 col-lg-3">
					<a href="{{route('mentor.details',base64_encode($mentor->id))}}?date={{date('Y-m-d')}}">
						<div class="box">
							<div class="comments-header">
								<span class="mentor-image">
									<img src="{{asset('design/images/mentor3.jpg')}}">
								</span>
								<div class="mentor-pro-details">
									<h5>{{$mentor->name}}</h5>
									<span>{{$mentor->designation}}</span>
								</div>
							</div>
							<p>{{$mentor->about}}</p>
						</div>
					</a>
				</li>
			@endforeach
		</ul>

		<div class="question-place">
			<h2 class="page-heading">Most common questions</h2>
			<div class="faq-place">
				@foreach($data->faq as $key => $faqs)
	                <div class="dropdown">
	                    <a href="javascript:void(0)" class="dropdown-toggle @if($key == 0){{('dropdown-active')}}@endif">
	                        <span class="caret minus faq-minus"><img src="{{asset('design/images/minus.png')}}"></span>
	                        <span class="caret plus faq-plus"><img src="{{asset('design/images/plus.png')}}"></span> 
	                        {{$faqs->title}}
	                    </a>
	                    <div class="dropdown-inner @if($key == 0){{('open')}}@endif">
	                        <p>{!! $faqs->description !!}</p>
	                    </div>
	                </div>
	            @endforeach
			</div>
		</div>

	</div>
</section>

@section('script')
	<script type="text/javascript"></script>
@stop
@endsection
