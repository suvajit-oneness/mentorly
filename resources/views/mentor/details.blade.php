@extends('layouts.master')
@section('title','Mentor Detail')
@section('content')

<section class="gray-wrapper">
	<div class="container-xl">
		
		<div class="mentor-details-wrapper">
			<div class="left-panel">

				<div class="mentor-det-details">
					<div class="det-photo">
						<img src="{{asset('design/images/mentor1.jpg')}}">
					</div>
					<div class="mentor-bio">
						<h3 class="profile-name mb-0">Gowoon S.</h3>
						<span class="small-info">Certified developer with 10 years experience.</span>
						<div class="inerview-taken mt-3">
							<span><img src="{{asset('design/images/company.png')}}"></span>  Twitch
						</div>
						<div class="inerview-taken mt-3">
							<span><img src="{{asset('design/images/student.png')}}"></span>  51 interviews given
						</div>
					</div>
				</div>

				<div class="mentor-det-details no-flex">
					<h2 class="medium-heading">About the mentor</h2>
					<p>
						It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
					</p>
				</div>


				<div class="mentor-det-details no-flex available-place">
					<h2 class="medium-heading">Mentor availability</h2>

					<div class="calender-holder">
						<div class="calender-header">
							<div class="date-scroll">
								<a href="#" class="pre-handle"><i class="fas fa-chevron-left"></i></a>
								<a href="#" class="next-handle"> <i class="fas fa-chevron-right"></i></a>
								<span class="date">Feb 3–9, 2021</span>
							</div>
							<div class="time-zone">
								<select class="select-style" id="sel1">
									@foreach($timezone as $key => $zone)
										<option value="{{$zone->id}}" @if($mentor->timezone_id == $zone->id){{'selected'}}@endif>{{$zone->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="calender-body">
							<div class="calender-head">
								<div class="dayname">Wed</div>
								<div class="dayname">Thu</div>
								<div class="dayname">Fri</div>
								<div class="dayname">Sat</div>
								<div class="dayname">Sun</div>
								<div class="dayname">Mon</div>
								<div class="dayname">Tue</div>
							</div>
							<div class="calender-time">
								<div class="time-avali">
									<div class="time-slot"><a href="#">15:30</a></div>
									<div class="time-slot"><a href="#">16:00</a></div>
									<div class="time-slot"><a href="#">16:30</a></div>
									<div class="time-slot"><a href="#">04:30</a></div>
									<div class="time-slot"><a href="#">05:00</a></div>
								</div>
								<div class="time-avali">
									<div class="time-slot"><a href="#">15:30</a></div>
									<div class="time-slot"><a href="#">16:00</a></div>
									<div class="time-slot"><a href="#">16:30</a></div>
									<div class="time-slot"><a href="#">04:30</a></div>
									<div class="time-slot"><a href="#">05:00</a></div>
								</div>
								<div class="time-avali">
									<div class="time-slot"><a href="#">15:30</a></div>
									<div class="time-slot"><a href="#">16:00</a></div>
									<div class="time-slot"><a href="#">16:30</a></div>
									<div class="time-slot"><a href="#">04:30</a></div>
									<div class="time-slot"><a href="#">05:00</a></div>
								</div>
								<div class="time-avali">
									<div class="time-slot"><a href="#">15:30</a></div>
									<div class="time-slot"><a href="#">16:00</a></div>
									<div class="time-slot"><a href="#">16:30</a></div>
									<div class="time-slot"><a href="#">04:30</a></div>
									<div class="time-slot"><a href="#">05:00</a></div>
									<div class="time-slot"><a href="#">15:30</a></div>
									<div class="time-slot"><a href="#">16:00</a></div>
									<div class="time-slot"><a href="#">16:30</a></div>
									<div class="time-slot"><a href="#">04:30</a></div>
									<div class="time-slot"><a href="#">05:00</a></div>
								</div>
								<div class="time-avali">
									<div class="time-slot"><a href="#">15:30</a></div>
									<div class="time-slot"><a href="#">16:00</a></div>
									<div class="time-slot"><a href="#">16:30</a></div>
									<div class="time-slot"><a href="#">04:30</a></div>
									<div class="time-slot"><a href="#">05:00</a></div>
								</div>
								<div class="time-avali">
									<div class="time-slot"><a href="#">15:30</a></div>
									<div class="time-slot"><a href="#">16:00</a></div>
									<div class="time-slot"><a href="#">16:30</a></div>
									<div class="time-slot"><a href="#">04:30</a></div>
									<div class="time-slot"><a href="#">05:00</a></div>
								</div>
								<div class="time-avali">
									<div class="time-slot"><a href="#">15:30</a></div>
									<div class="time-slot"><a href="#">16:00</a></div>
									<div class="time-slot"><a href="#">16:30</a></div>
									<div class="time-slot"><a href="#">04:30</a></div>
									<div class="time-slot"><a href="#">05:00</a></div>
								</div>
							</div>
						</div>
					</div>

				</div>

				@if(count($mentor->review) > 0)
				<div class="mentor-det-details no-flex reviews-place">
					<h2 class="medium-heading">Reviews <span>({{count($mentor->review)}})</span></h2>

					<ul class="review-list">
						@foreach($mentor->review as $key => $review)
						<li>
							<div class="box">
								<div class="box-inner">
									<div class="viewer-image">
										<img src="@if($review->user->image == ''){{asset('design/images/mentor2.jpg')}}@else{{$review->user->image}}@endif">
									</div>
									<div class="reviewer-content">
										<h3 class="profile-name mb-0">{{$review->user->name}}</h3>
										<span class="small-info date-text">{{date('M, d Y',strtotime($review->created_at))}}</span>
										<div class="comment">
											<p>{{$review->review}}.</p>
										</div>
									</div>
								</div>
							</div>
						</li>
						@endforeach
					</ul>
				</div>
				@endif

				<div class="mentor-det-details no-flex resume-place">
					<h2 class="medium-heading">Resume</h2>

					<ul class="edu-list">
						<li>
							<div class="year">2015 — 2019</div>
							<div class="study">
								Kwansei Gakuin University Integrated Psychological Sciences
							</div>
						</li>
						<li>
							<div class="year">2015 — 2019</div>
							<div class="study">
								Kwansei Gakuin University Integrated Psychological Sciences
							</div>
						</li>
					</ul>
				</div>

			</div>
			<div class="right-panel">
				<div class="calender">
					<div class="row-grid">
						<div class="row-title"></div>
						<div class="row-cell">
							<div class="cell">Mon</div>
							<div class="cell">Tue</div>
							<div class="cell">Wed</div>
							<div class="cell">Tus</div>
							<div class="cell">Fri</div>
							<div class="cell">Sat</div>
							<div class="cell">Sun</div>
						</div>
					</div>
					<div class="row-grid">
						<div class="row-title">
							<span class="daytime">Morning</span>
							<span class="time">06:00—12:00</span>
						</div>
						<div class="row-cell">
							<div class="cell cell-light"></div>
							<div class="cell cell-deep"></div>
							<div class="cell cell-deep"></div>
							<div class="cell cell-deep"></div>
							<div class="cell cell-deep"></div>
							<div class="cell cell-deep"></div>
							<div class="cell cell-light"></div>
						</div>
					</div>
					<div class="row-grid">
						<div class="row-title">
							<span class="daytime">Afternoon</span>
							<span class="time">12:00—18:00</span>
						</div>
						<div class="row-cell">
							<div class="cell cell-light"></div>
							<div class="cell cell-light"></div>
							<div class="cell cell-light"></div>
							<div class="cell cell-light"></div>
							<div class="cell cell-deep"></div>
							<div class="cell cell-deep"></div>
							<div class="cell cell-light"></div>
						</div>
					</div>
					<div class="row-grid">
						<div class="row-title">
							<span class="daytime">Evening</span>
							<span class="time">18:00—24:00</span>
						</div>
						<div class="row-cell">
							<div class="cell cell-light"></div>
							<div class="cell cell-light"></div>
							<div class="cell cell-light"></div>
							<div class="cell cell-light"></div>
							<div class="cell cell-deep"></div>
							<div class="cell cell-deep"></div>
							<div class="cell cell-light"></div>
						</div>
					</div>
					<div class="row-grid">
						<div class="row-title">
							<span class="daytime">Night</span>
							<span class="time">00:00—06:00</span>
						</div>
						<div class="row-cell">
							<div class="cell cell-light"></div>
							<div class="cell cell-light"></div>
							<div class="cell cell-light"></div>
							<div class="cell cell-light"></div>
							<div class="cell cell-deep"></div>
							<div class="cell cell-deep"></div>
							<div class="cell cell-light"></div>
						</div>
					</div>
				</div>

				<div class="show-review">
					<span><img src="{{asset('design/images/rating.png')}}"></span> 5  <a href="#">(60 reviews)</a>
				</div>

				<div class="button-place">
					<a href="#" class="prinery-btm blue-btm">Book mentor</a>
					<a href="#" class="prinery-btm deepblue-btm">Message</a>
				</div>

			</div>
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