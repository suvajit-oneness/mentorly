@extends('layouts.master')
@section('title','mentors')
@section('content')
	
<section class="gray-wrapper">
	<div class="container-xl">
		<div class="title-place">
			Online Finance tutors & teachers
			<span><i>{{count($mentors)}}</i> tutors avalable</span>
			@if(url()->full() != url()->current())
				<a href="{{url()->current()}}" class="btn btn-danger">Reset Filter</a>
			@endif
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
				<select name="seniority" id="senioritylevel">
					<option value="">Select Seniority</option>
					@foreach($seniority as $senior)
						<option value="{{$senior->id}}" @if(!empty($request['seniority']) && $request['seniority'] == $senior->id){{('selected')}}@endif>{{$senior->title}}</option>
					@endforeach
				</select>
			</div>
			<div class="grid-box price-drropdown">
				<span>Price per hour </span>
				<div class="show-price">
					<input type="text" id="amount" readonly="">
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
				<label>Sort By: </label>
				<select name="sort_by" id="sort_by">
					<option value="relevance">Relevance</option>
					<option value="popularity">Popularity</option>
					<option value="highestfirst">Highest First</option>
					<option value="lowestfirst">Lowest First</option>
					<option value="numberofreviews">Number of Reviews</option>
					<option value="bestrating">Best Rating</option>
				</select>
			</div>
			<div class="search-holder">
				<input type="text" id="searchby" name="searchby" placeholder="Search by, Name, Keyword, or Company" value="@if(!empty($request['keyword'])){{$request['keyword']}}@endif">
				<span><img src="{{asset('design/images/magnifire.png')}}" id="searchFinalBtn"></span>
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
							<a href="{{route('mentor.details',base64_encode($mentor->id))}}?date={{date('Y-m-d')}}" class="profile-name" target="_blank">{{$mentor->name}}.</a>
							<ul class="twolist">
								<li class="company">Twitch</li>
								<li class="rating"><span><img src="{{asset('design/images/rating.png')}}"></span> {{avgRatingOfMentors($mentor->reviews)}} <a href="#">({{count($mentor->reviews)}} Reviews)</a></li>
							</ul>
							<!-- <div class="inerview-taken">
								<span><img src="{{asset('design/images/student.png')}}"></span>  51 interviews given
							</div> -->
						</div>

						<div class="profile-right">
							<span class="price">
								${{$mentor->charge_per_hour}} <span>/ hour</span>
							</span>

							<a href="{{route('mentor.details',base64_encode($mentor->id))}}?date={{date('Y-m-d')}}" class="prinery-btm blue-btm">Book mentor</a>

							<a href="javascript:void(0)" class="messageToMentor" data-mentor="{{$mentor->id}}" data-name="{{$mentor->name}}" class="prinery-btm deepblue-btm">Message</a>
						</div>
					</div>
					<!-- Mentor Availability Calender -->
					<div class="right-floating-place">
						<div class="calender">
							<div class="row-grid">
								<div class="row-title"></div>
								<div class="row-cell">
									@foreach($days as $day)
										<div class="cell">{{$day->short_day}}</div>	
									@endforeach
								</div>
							</div>
							@foreach($mentor->timeShift as $timeShift)
								<div class="row-grid">
									<div class="row-title">
										<span class="daytime">{{$timeShift['shift_name']}}</span>
										<span class="time">{{$timeShift['shift']}}</span>
									</div>
									<div class="row-cell">
										@foreach($timeShift['days'] as $av_day)
											<div class="cell @if($av_day['available']>0){{'cell-light'}}@else{{'cell-deep'}}@endif"></div>
										@endforeach
									</div>
								</div>
							@endforeach
						</div>
						<a href="{{route('mentor.details',base64_encode($mentor->id))}}?date={{date('Y-m-d')}}" class="avality-button" target="_blank">View full availability</a>
					</div>
					<!-- Mentor Availability Calender END -->
				@endforeach

			</div>

			<!-- <div class="right-floating-place">
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
			</div> -->

		</div>

	</div>
</section>

<!-- Message Modal -->
<div class="modal fade" id="messageToMentorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Message to <span id="mentorName"></span></h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">
      			<div class="form-group">
      				<textarea placeholder="Your message" name="message" id="mentorMessage" class="form-control"></textarea>
      				<span id="errorMessage" class="text-danger"></span>
      			</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        		<button type="button" id="modalMessageSendBtn" class="btn btn-primary">Send Message</button>
      		</div>
    	</div>
  	</div>
</div>

@section('script')
	<script type="text/javascript">
		var seniorityLevel = 0,keyword = '';
		@if(!empty($request['seniority']) && $request['seniority'] > 0)
			seniorityLevel = parseInt('{{$request["seniority"]}}');
		@endif
		@if(!empty($request['keyword']))
			keyword = "{{$request['keyword']}}";
		@endif
		$(document).on('change','select#senioritylevel',function(){
			seniorityLevel = $('select#senioritylevel option:selected').val();
			dataRetriving();
		});

		$(document).on('click','#searchFinalBtn',function(){
			keyword = $('#searchby').val();
			if(keyword == ''){}
			else{
				dataRetriving();
			}
		});

		function dataRetriving()
		{
			var originalURL = '{{url()->current()}}?',price = $('#amount').val();
			if(parseInt(seniorityLevel) > 0){
				originalURL += 'seniority='+seniorityLevel+'&';
			}
			if(keyword != ''){
				originalURL += 'keyword='+keyword+'&';
			}
			originalURL += 'price='+price+'&';
			originalURL = originalURL.substring(0, originalURL.length-1); // removing last character from String
			window.location.href = originalURL;
		}

		var mentorId = 0;
		$(document).on('click','.messageToMentor',function(){
			var checkGuard = '{{get_guard()}}';$('#errorMessage').empty();
			mentorId = parseInt($(this).attr('data-mentor'));
			if(checkGuard == '' || checkGuard == 'admin'){
				alert('you have to perform login before sending message');
			}/*else if(checkGuard == 'mentor' && parseInt(mentorId) == parseInt('authuserId')){
				alert('you can not send message yourself');
			}*/else{
				var mentorName = $(this).attr('data-name');
				$('#messageToMentorModal #mentorName').text('( '+mentorName+' )');
				$('#messageToMentorModal #mentorMessage').val('');
				$('#messageToMentorModal').modal('show');
			}
		});

		$(document).on('click','#modalMessageSendBtn',function(){
			var submitBtn = $(this);
			$('#errorMessage').empty();
			var message = $('#messageToMentorModal #mentorMessage').val();
			if(message == ''){
				$('#errorMessage').empty().append('Please type your message');
			}else{
				submitBtn.attr('disabled',true);
				$.ajax({
					url : '{{Route('message.submit.to.mentor')}}',
					type: 'post',
					data: {message:message,mentorId:mentorId,'_token':'{{csrf_token()}}'},
					success:function(data){
						if(data.error == true){
							$('#messageToMentorModal #errorMessage').text(data.message);
						}else{
							$('#messageToMentorModal').modal('hide');
						}
						submitBtn.attr('disabled',false);
					}
				});
			}
		});

		// price range
	$(function() {
		$( "#slider-range" ).slider({
  			range: true,
  			min: 30,
  			max: 2000,
  			values: [ 30, 2000 ],
  			@if(!empty($request['price']))
  				<?php $range = explode('-',removeDollerSign($request['price'])); ?>
  				values: [ {{$range[0]}}, {{$range[1]}} ],
  			@endif
  			slide: function( event, ui ) {
				$( "#amount" ).val( "$" + ui.values[ 0 ] + "-$" + ui.values[ 1 ] );
				// $( "#amount" ).val( ui.values[ 0 ] + "-" + ui.values[ 1 ] );
  			}
		});
		$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + "-$" + $( "#slider-range" ).slider( "values", 1 ) );
		// $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ) + "-" + $( "#slider-range" ).slider( "values", 1 ) );
	});

	$(function() {
		$('.price-drropdown').click(function(){
			$('.dropdown-custom').toggleClass('show');
			if($('.dropdown-custom').hasClass('show')){}
			else{
				dataRetriving();
			}
		});
		$('.multiselect-dropdown').click(function(){
			$('.mul-select-dropdown').toggleClass('show');
		});
	});
	</script>
@stop
@endsection