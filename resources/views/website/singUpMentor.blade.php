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
							  	<input type="submit" class="button-style" id="" value="Sign Up">
							</div>
							<div class="disclaimer-place">
								By clicking Sign up, you agree to mentorly <br>
								<a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>



	<div class="container">

		<ul class="wedo-list">
            <li>
                <div class="box">
                    <figure><img src="{{asset('design/images/calender-new.png')}}"></figure>
                    <figcaption>
                        <h3>Calendar for Lessons</h3>
                        <p>Set work hours and manage lessons in your personal Mentorly Calendar</p>
                    </figcaption>
                </div>
            </li>
            <li>
                <div class="box">
                    <figure><img src="{{asset('design/images/flexibility-new.png')}}"></figure>
                    <figcaption>
                        <h3>Flexibility</h3>
                        <p>Work hours that fit your lifestyle: decide when and how many lessons to teach</p>
                    </figcaption>
                </div>
            </li>
            <li>
                <div class="box">
                    <figure><img src="{{asset('design/images/hourly-rate-new.png')}}"></figure>
                    <figcaption>
                        <h3>You set your own hourly rate</h3>
                        <p>You can set and change your hourly rate at any time</p>
                    </figcaption>
                </div>
            </li>
            <li>
                <div class="box">
                    <figure><img src="{{asset('design/images/secure-payments-new.png')}}"></figure>
                    <figcaption>
                        <h3>Secure Payments</h3>
                        <p>You receive earnings directly from your platform account to your bank card/account or other wallet via secure payment channels</p>
                    </figcaption>
                </div>
            </li>
        </ul>

<!-- 		<div class="mentor-info-box" style="background:url('../design/images/process-image.jpg') no-repeat center center; background-size:cover">
			<ul class="info-list">
				<li>
					<div class="list-box list-box-heading">
						<h2>Grow your <br> business/money </h2>
					</div>
					<div class="list-box">
						<figure><img src="images/calender.png"></figure>
						<h4>Calendar for Lessons</h4>
						<p>Set work hours and manage lessons in your personal Mentorly Calendar</p>
					</div>
					<div class="list-box">
						<figure><img src="images/flexiable.png"></figure>
						<h4>Flexibility</h4>
						<p>Work hours that fit your lifestyle: decide when and how many lessons to teach</p>
					</div>
				</li>
				<li>
					<div class="list-box list-box-heading">
						<h2>Earn on <br> your time</h2>
					</div>
					<div class="list-box">
						<figure><img src="images/hourly-rate.png"></figure>
						<h4>You set your own hourly rate</h4>
						<p>You can set and change your hourly rate at any time</p>
					</div>
					<div class="list-box">
						<figure><img src="images/secure.png"></figure>
						<h4>Secure Payments</h4>
						<p>You receive earnings directly from your platform account to your bank card/account or other wallet via secure payment channels</p>
					</div>
				</li>

			</ul>
		</div> -->

		<ul class="mentor-comments">
			<li>
				<a href="#">
					<div class="box">
						<div class="comments-header">
							<span class="mentor-image">
								<img src="{{asset('design/images/mentor3.jpg')}}">
							</span>
							<div class="mentor-pro-details">
								<h5>Manuela</h5>
								<span>Italian language</span>
							</div>
						</div>
						<p>It’s way better than all the other language learning services because it represents a good opportunity from the very beginning and it is much easier to find new students.</p>
					</div>
				</a>
			</li>
			<li>
				<a href="#">
					<div class="box">
						<div class="comments-header">
							<span class="mentor-image">
								<img src="{{asset('design/images/mentor1.jpg')}}">
							</span>
							<div class="mentor-pro-details">
								<h5>Manuela</h5>
								<span>Italian language</span>
							</div>
						</div>
						<p>It’s way better than all the other language learning services because it represents a good opportunity from the very beginning and it is much easier to find new students.</p>
					</div>
				</a>
			</li>
			<li>
				<a href="#">
					<div class="box">
						<div class="comments-header">
							<span class="mentor-image">
								<img src="{{asset('design/images/mentor2.jpg')}}">
							</span>
							<div class="mentor-pro-details">
								<h5>Manuela</h5>
								<span>Italian language</span>
							</div>
						</div>
						<p>It’s way better than all the other language learning services because it represents a good opportunity from the very beginning and it is much easier to find new students.</p>
					</div>
				</a>
			</li>
			<li>
				<a href="#">
					<div class="box">
						<div class="comments-header">
							<span class="mentor-image">
								<img src="{{asset('design/images/mentor4.jpg')}}">
							</span>
							<div class="mentor-pro-details">
								<h5>Manuela</h5>
								<span>Italian language</span>
							</div>
						</div>
						<p>It’s way better than all the other language learning services because it represents a good opportunity from the very beginning and it is much easier to find new students.</p>
					</div>
				</a>
			</li>
			<li>
				<a href="#">
					<div class="box">
						<div class="comments-header">
							<span class="mentor-image">
								<img src="{{asset('design/images/mentor5.jpg')}}">
							</span>
							<div class="mentor-pro-details">
								<h5>Manuela</h5>
								<span>Italian language</span>
							</div>
						</div>
						<p>It’s way better than all the other language learning services because it represents a good opportunity from the very beginning and it is much easier to find new students.</p>
					</div>
				</a>
			</li>
			<li>
				<a href="#">
					<div class="box">
						<div class="comments-header">
							<span class="mentor-image">
								<img src="{{asset('design/images/mentor2.jpg')}}">
							</span>
							<div class="mentor-pro-details">
								<h5>Manuela</h5>
								<span>Italian language</span>
							</div>
						</div>
						<p>It’s way better than all the other language learning services because it represents a good opportunity from the very beginning and it is much easier to find new students.</p>
					</div>
				</a>
			</li>
			<li>
				<a href="#">
					<div class="box">
						<div class="comments-header">
							<span class="mentor-image">
								<img src="{{asset('design/images/mentor4.jpg')}}">
							</span>
							<div class="mentor-pro-details">
								<h5>Manuela</h5>
								<span>Italian language</span>
							</div>
						</div>
						<p>It’s way better than all the other language learning services because it represents a good opportunity from the very beginning and it is much easier to find new students.</p>
					</div>
				</a>
			</li>
			<li>
				<a href="#">
					<div class="box">
						<div class="comments-header">
							<span class="mentor-image">
								<img src="{{asset('design/images/mentor5.jpg')}}">
							</span>
							<div class="mentor-pro-details">
								<h5>Manuela</h5>
								<span>Italian language</span>
							</div>
						</div>
						<p>It’s way better than all the other language learning services because it represents a good opportunity from the very beginning and it is much easier to find new students.</p>
					</div>
				</a>
			</li>
		</ul>

		<div class="question-place">
			<h2 class="page-heading">Most common questions</h2>

			<div class="faq-place">
				<div class="dropdown">
					<a href="javascript:void(0)" class="dropdown-toggle dropdown-active">
						<span class="caret minus"><img src="{{asset('design/images/minus.png')}}"></span>
						<span class="caret plus"><img src="{{asset('design/images/plus.png')}}"></span>	
						When should I start? 
					</a>
					<div class="dropdown-inner open">
					    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
					</div>
				</div>

				<div class="dropdown">
					<a href="javascript:void(0)" class="dropdown-toggle">
						<span class="caret minus"><img src="{{asset('design/images/minus.png')}}"></span>
						<span class="caret plus"><img src="{{asset('design/images/plus.png')}}"></span>	
						How much does it cost? 
					</a>
					<div class="dropdown-inner">
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into</p>
					</div>
				</div>

				<div class="dropdown">
					<a href="javascript:void(0)" class="dropdown-toggle">
						<span class="caret minus"><img src="{{asset('design/images/minus.png')}}"></span>
						<span class="caret plus"><img src="{{asset('design/images/plus.png')}}"></span>	
						Time Commitment
					</a>
				  	<div class="dropdown-inner">
				    	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of</p>
				  	</div>
				</div>
			</div>
		</div>

	</div>
</section>

@section('script')
	<script type="text/javascript"></script>
@stop
@endsection
