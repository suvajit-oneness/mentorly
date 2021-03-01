@extends('layouts.master')
@section('title','mentors')
@section('content')

<section class="wedo-section">
	<div class="container">
		<div class="contact-place">
			<div class="contact-image" style="background: url('design/images/contact-bg.jpg')"></div>
			<div class="contact-details">
				<h2 class="medium-heading deepblue">Headquater</h2>
				<ul class="address-list">
					<li>
						<span><img src="{{asset('design/images/place-icon.png')}}"></span>
						35 Nowland St, Seven Hills, NSW 2147
					</li>
					<li>
						<span><img src="{{asset('design/images/call-icon.png')}}"></span>
						<a href="tel:0433 019 012">0433 019 012</a>
					</li>
					<li>
						<span><img src="{{asset('design/images/mail-icon.png')}}"></span>
						<a href="mailto:info@gmail.com">info@gmail.com</a>
					</li>
				</ul>
				<h2 class="medium-heading deepblue">Follow us on</h2>
				<ul class="social-list">
					<li><a href="#" ><i class="fab fa-linkedin"></i></a></li>
					<li><a href="#" ><i class="fab fa-facebook-f"></i></a></li>
					<li><a href="#" ><i class="fab fa-instagram"></i></a></li>
				</ul>
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