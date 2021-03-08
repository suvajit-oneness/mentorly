@extends('layouts.master')
@section('title','mentors')
@section('content')

<section class="wedo-section">
	<div class="container">
		<div class="contact-place">
			<div class="contact-image" style="background: url('design/images/contact-bg.jpg')"></div>
			<div class="contact-details">
				<h2 class="medium-heading deepblue">{{$contact->title}}</h2>
				<ul class="address-list">
					<li>
						<span><img src="{{asset('design/images/place-icon.png')}}"></span>
						{!! $contact->address !!}
					</li>
					<li>
						<span><img src="{{asset('design/images/call-icon.png')}}"></span>
						<a href="tel:0433 019 012">{{$contact->mobile}}</a>
					</li>
					<li>
						<span><img src="{{asset('design/images/mail-icon.png')}}"></span>
						<a href="mailto:info@gmail.com">{{$contact->email}}</a>
					</li>
				</ul>
				@if($contact->linkedinLink != '' || $contact->facebookLink != '' || $contact->instagramLink != '' || $contact->twitterLink != '')
					<h2 class="medium-heading deepblue">Follow us on</h2>
					<ul class="social-list">
						@if($contact->linkedinLink != '')
							<li><a href="{{$contact->linkedinLink}}" target="_blank"><i class="fab fa-linkedin"></i></a></li>
						@endif
						@if($contact->facebookLink != '')
							<li><a href="{{$contact->facebookLink}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						@endif
						@if($contact->instagramLink != '')
							<li><a href="{{$contact->instagramLink}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
						@endif
						@if($contact->twitterLink != '')
							<li><a href="{{$contact->twitterLink}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
						@endif
					</ul>
				@endif
			</div>
		</div>
	</div>
</section>


<section class="footer-top" style="background: url('./images/footer-top.jpg') no-repeat center center; background-size: cover; ">
	<div class="container">
		<h4>Every year n people prepare to interview confidently on mentorly. Get fast results with professional mentors. Prepare to achieve your goals today. </h4>

		<a href="#" class="prinery-btm blue-btm">Get Started</a>
	</div>
</section>

@section('script')
	<script type="text/javascript"></script>
@stop
@endsection