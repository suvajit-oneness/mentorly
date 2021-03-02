@extends('layouts.master')
@section('title','mentors')
@section('content')
	
<section class="gray-wrapper">
	<div class="container-xl">
		<div class="title-place">
			Online Finance tutors & teachers
			<span><i>360</i> tutors avalable</span>
		</div>

		<div class="filter-place">
			<div class="grid-box">
				<span>Industry</span>
				<select>
					<option value="finance">Finance</option>
					<option value="healthcare">Healthcare</option>
					<option value="consulting">Consulting</option>
					<option value="engineering">engineering</option>
					<option value="publicpolicy">public policy</option>
				</select>
			</div>
			<div class="grid-box">
				<span>Seniority </span>
				<select>
					<option value="entrylevel">Entry Level</option>
					<option value="midlevel">Mid Level</option>
					<option value="seniorlevel">Senior Level</option>
				</select>
			</div>
			<div class="grid-box price-drropdown">
				<span>Price per hour </span>
				<div class="show-price">
					<input type="text" id="amount" readonly>
				</div>
				<div class="dropdown-custom">
					 <div id="slider-range" class="range-bar"></div>
				</div>
			</div>
			<div class="grid-box multiselect-dropdown">
				<span>I’m available </span>
				<div class="mul-select-show">
					<span class="hida">Select time</span>
				</div>
				<div class="mul-select-dropdown">
					<h5>Time of the day</h5>
					<ul class="day-list">
						<li>
							<label>
								<input type="checkbox" value="6-9" />
								<div class="overlay"></div>
								<figure><img src="{{asset('design/images/morning.png')}}"></figure>
								<span class="time-n">6-9</span>
								<span class="time-w">Morning</span>
								
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" value="9-12" />
								<div class="overlay"></div>
								<figure><img src="{{asset('design/images/late-morning.png')}}"></figure>
								<span class="time-n">9-12</span>
								<span class="time-w">Late morning</span>
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" value="12-15" />
								<div class="overlay"></div>
								<figure><img src="{{asset('design/images/afternoon.png')}}"></figure>
								<span class="time-n">12-15</span>
								<span class="time-w">Afternoon</span>
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" value="15-18" />
								<div class="overlay"></div>
								<figure><img src="{{asset('design/images/afternoon.png')}}"></figure>
								<span class="time-n">15-18</span>
								<span class="time-w">Late afternoon</span>
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" value="18-21" />
								<div class="overlay"></div>
								<figure><img src="{{asset('design/images/evening.png')}}"></figure>
								<span class="time-n">18-21</span>
								<span class="time-w">Evening</span>
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" value="21-24" />
								<div class="overlay"></div>
								<figure><img src="{{asset('design/images/evening.png')}}"></figure>
								<span class="time-n">21-24</span>
								<span class="time-w">Late evening</span>
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" value="0-3" />
								<div class="overlay"></div>
								<figure><img src="{{asset('design/images/night.png')}}"></figure>
								<span class="time-n">0-3</span>
								<span class="time-w">Night</span>
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" value="3-6" />
								<div class="overlay"></div>
								<figure><img src="{{asset('design/images/late-night.png')}}"></figure>
								<span class="time-n">3-6</span>
								<span class="time-w">Late night</span>
							</label>
						</li>
					</ul>

					<h5>Time of the week</h5>
					<ul class="day-list week-list">
						<li>
							<label>
								<input type="checkbox" value="sun" />
								<div class="overlay"></div>
								<span class="week">Sun</span>
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" value="mon" />
								<div class="overlay"></div>
								<span class="week">mon</span>
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" value="tue" />
								<div class="overlay"></div>
								<span class="week">Tue</span>
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" value="wed" />
								<div class="overlay"></div>
								<span class="week">Wed</span>
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" value="thu" />
								<div class="overlay"></div>
								<span class="week">Thu</span>
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" value="fri" />
								<div class="overlay"></div>
								<span class="week">Fri</span>
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" value="sat" />
								<div class="overlay"></div>
								<span class="week">Sat</span>
							</label>
						</li>
					</ul>
				</div>
			</div>
			
		</div>

		<div class="short-search-place">
			<div class="short-by-holder">
				<label>Short By: </label>
				<select>
					<option value="relevance">Relevance</option>
					<option value="popularity">Popularity</option>
					<option value="highestfirst">Highest First</option>
					<option value="lowestfirst">Lowest First</option>
					<option value="numberofreviews">Number of Reviews</option>
					<option value="bestrating">Best Rating</option>
				</select>
			</div>
			<div class="search-holder">
				<input type="text" id="" placeholder="Search by, Name, Keyword, or Company">
				<span><img src="{{asset('design/images/magnifire.png')}}"></span>
			</div>
		</div>


		<div class="profile-wrapper">

			<div class="profile-holder">

				@foreach($mentors as $key => $mentor)
					<div class="profile-details-box">
						<div class="profile-first">
							<a href="#">
								<img src="@if($mentor->image !=''){{$mentor->image}}@else{{asset('design/images/mentor1.jpg')}}@endif">
							</a>
						</div>
						<div class="profile-middle">
							<a href="#" class="profile-name">{{$mentor->name}}.</a>
							<ul class="twolist">
								<li class="company">Twitch</li>
								<li class="rating"><span><img src="{{asset('design/images/rating.png')}}"></span> 5  <a href="#">(60 reviews)</a></li>
							</ul>
							<div class="inerview-taken">
								<span><img src="{{asset('design/images/student.png')}}"></span>  51 interviews given
							</div>
						</div>

						<div class="profile-right">
							<span class="price">
								$1640 <span>/ hour</span>
							</span>

							<a href="#" class="prinery-btm blue-btm">Book mentor</a>

							<a href="#" class="prinery-btm deepblue-btm">Message</a>
						</div>
					</div>
				@endforeach

				<div class="pagination-place">
					<ul class="pagination-list">
						<li><a href="#"><i class="fas fa-chevron-left"></i></a></li>
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">---</a></li>
						<li><a href="#">8</a></li>
						<li><a href="#"><i class="fas fa-chevron-right"></i></a></li>
					</ul>
				</div>

			</div>

			<div class="right-floating-place">
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
				<a href="#" class="avality-button">View full availability</a>
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