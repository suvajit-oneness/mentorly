@extends('layouts.master')
@section('title','mentors')
@section('content')

<section class="wedo-section">
	<div class="container">
		<h2 class="page-heading">We are Mentorly</h2>

		<div class="mentor-slider">
			@foreach($data->mentor as $key => $mentor)
				<div class="mentor-grid-inner">
					<a href="javascript:void(0)">
						<figure>
							<img src="@if($mentor->image !=''){{$mentor->image}}@else{{asset('design/images/mentor1.jpg')}}@endif">
						</figure>
						<div class="about-mentor">
							<h3>{{$mentor->name}}</h3>
							<p>{{$mentor->designation}}</p>
						</div>
					</a>
					<div class="short-description">{!! $mentor->about !!}</div>
					@if($mentor->facebook_link != '' || $mentor->instagram_link != '' || $mentor->linkedin_link != '')
						<ul class="mentor-social-list">
							@if($mentor->linkedin_link != '')
								<li><a href="{{$mentor->linkedin_link}}" target="_blank"><i class="fab fa-linkedin"></i></a></li>
							@endif
							@if($mentor->facebook_link != '')
								<li><a href="{{$mentor->facebook_link}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							@endif
							@if($mentor->instagram_link != '')
								<li><a href="{{$mentor->instagram_link}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
							@endif
						</ul>
					@endif
				</div>
			@endforeach
		</div>
	</div>
</section>


<section class="white-section">
	<div class="container">
		<h2 class="page-heading">Latest News</h2>
		<ul class="news-list">
			@foreach($data->news as $key => $news)
				<li>
					<div class="box">
						<figure style="background: url('{{asset('news/'.$news->image)}}') no-repeat center center; background-size: cover;"></figure>
						<figcaption>
							<div class="date">
								<span><img src="{{asset('design/images/calender-icon.png')}}"></span>
								{{date('M d Y',strtotime($news->created_at))}}
							</div>
							<h3>{!! $news->description !!}</h3>
							<a href="javascript:void(0)" class="prinery-btm blue-btm" >Read More</a>
						</figcaption>
					</div>
				</li>
			@endforeach
		</ul>
	</div>
</section>

<section class="wedo-section">
	<div class="container">
		<h2 class="page-heading">FAQ</h2>
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
</section>

<!--  -->

@section('script')
	<script type="text/javascript"></script>
@stop
@endsection