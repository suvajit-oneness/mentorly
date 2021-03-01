@extends('layouts.master')
@section('title','mentors')
@section('content')

<section class="wedo-section">
	<div class="container">
		<h2 class="page-heading">We are Mentorly</h2>

		<div class="mentor-slider">
			<div class="mentor-grid-inner">
				<a href="#">
					<figure>
						<img src="{{asset('design/images/mentor1.jpg')}}">
					</figure>
					<div class="about-mentor">
						<h3>Sam Harper</h3>
						<p>product strategy mentor</p>
					</div>
				</a>
				<div class="short-description">
					Sam has led product vision, strategy, and development at SoftBank Robotics, where he launched an innovative
				</div>
				<ul class="mentor-social-list">
					<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
					<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
					<li><a href="#"><i class="fab fa-instagram"></i></a></li>
				</ul>
			</div>
			<div class="mentor-grid-inner">
				<a href="#">
					<figure>
						<img src="{{asset('design/images/mentor3.jpg')}}">
					</figure>
					<div class="about-mentor">
						<h3>Sam Harper</h3>
						<p>product strategy mentor</p>
					</div>
				</a>
				<div class="short-description">
					Sam has led product vision, strategy, and development at SoftBank Robotics, where he launched an innovative
				</div>
				<ul class="mentor-social-list">
					<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
					<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
					<li><a href="#"><i class="fab fa-instagram"></i></a></li>
				</ul>
			</div>
			<div class="mentor-grid-inner">
				<a href="#">
					<figure>
						<img src="{{asset('design/images/mentor2.jpg')}}">
					</figure>
					<div class="about-mentor">
						<h3>Olga Boldarieva</h3>
						<p>Data science mentor</p>
					</div>
				</a>
				<div class="short-description">
					Sam has led product vision, strategy, and development at SoftBank Robotics, where he launched an innovative
				</div>
				<ul class="mentor-social-list">
					<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
					<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
					<li><a href="#"><i class="fab fa-instagram"></i></a></li>
				</ul>
			</div>
			<div class="mentor-grid-inner">
				<a href="#">
					<figure>
						<img src="{{asset('design/images/mentor1.jpg')}}">
					</figure>
					<div class="about-mentor">
						<h3>Sam Harper</h3>
						<p>product strategy mentor</p>
					</div>
				</a>
				<div class="short-description">
					Sam has led product vision, strategy, and development at SoftBank Robotics, where he launched an innovative
				</div>
				<ul class="mentor-social-list">
					<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
					<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
					<li><a href="#"><i class="fab fa-instagram"></i></a></li>
				</ul>
			</div>
		</div>

	</div>
</section>


<section class="white-section">
	<div class="container">
		<h2 class="page-heading">Latest News</h2>


		<ul class="news-list">
			<li>
				<div class="box">
					<figure style="background: url('images/news1.jpg') no-repeat center center; background-size: cover;"></figure>
					<figcaption>
						<div class="date">
							<span><img src="{{asset('design/images/calender-icon.png')}}"></span>
							March 5 2020
						</div>
						<h3>DriveWealth CEO Bob Cortright: A note on this week’s markets</h3>
						<a href="#" class="prinery-btm blue-btm" >Read More</a>
					</figcaption>
				</div>
			</li>
			<li>
				<div class="box">
					<figure style="background: url('images/news1.jpg') no-repeat center center; background-size: cover;"></figure>
					<figcaption>
						<div class="date">
							<span><img src="{{asset('design/images/calender-icon.png')}}"></span>
							March 5 2020
						</div>
						<h3>DriveWealth CEO Bob Cortright: A note on this week’s markets</h3>
						<a href="#" class="prinery-btm blue-btm" >Read More</a>
					</figcaption>
				</div>
			</li>
			<li>
				<div class="box">
					<figure style="background: url('images/news1.jpg') no-repeat center center; background-size: cover;"></figure>
					<figcaption>
						<div class="date">
							<span><img src="{{asset('design/images/calender-icon.png')}}"></span>
							March 5 2020
						</div>
						<h3>DriveWealth CEO Bob Cortright: A note on this week’s markets</h3>
						<a href="#" class="prinery-btm blue-btm" >Read More</a>
					</figcaption>
				</div>
			</li>
		</ul>

	</div>
</section>

<section class="wedo-section">
	<div class="container">
		<h2 class="page-heading">FAQ</h2>

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