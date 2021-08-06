@extends('layouts.master')
@section('title','Mentor Detail')
@section('content')

<section class="gray-wrapper">
	<div class="container-xl">
		
		<div class="mentor-details-wrapper">
			<div class="left-panel">

				<div class="mentor-det-details">
					<div class="det-photo">
						<img src="@if($mentor->image !=''){{$mentor->image}}@else{{asset('design/images/mentor1.jpg')}}@endif">
					</div>
					<div class="mentor-bio">
						<h3 class="profile-name mb-0">@php if(get_guard() == 'mentor' && (Auth::guard('mentor')->user()->id == $mentor->id)) echo "Welcome" @endphp {{$mentor->name}}.</h3>
						<span class="small-info">Certified developer with {{dateDifferenceFromNow($mentor->carrier_started)}} experience.</span>
						<div class="inerview-taken mt-3">
							<span><img src="{{asset('design/images/company.png')}}"></span>  Twitch
						</div>
						<div class="inerview-taken mt-3">
							<span><img src="{{asset('design/images/student.png')}}"></span>  0 interviews given
						</div>
					</div>
				</div>

				<div class="mentor-det-details no-flex">
					<h2 class="medium-heading">About the mentor</h2>
					<p>{{$mentor->about}}</p>
				</div>

				<div class="mentor-det-details no-flex available-place">
					<h2 class="medium-heading">Mentor availability</h2>

					<!-- mentor time sectioon start -->
					<div class="calender-holder">
						<div class="calender-header">
							<div class="date-scroll">
								<a href="{{url()->current()}}?date={{date('Y-m-d',strtotime($originalDate.'-7 days'))}}" class="pre-handle"><i class="fas fa-chevron-left"></i></a>
								<a href="{{url()->current()}}?date={{date('Y-m-d',strtotime($date.'+1 days'))}}" class="next-handle"> <i class="fas fa-chevron-right"></i></a>
								<span class="date">{{date('M, d Y',strtotime($originalDate))}} - {{date('M, d Y',strtotime($date))}}</span>
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
								@foreach($daysData as $day)
								<div class="dayname">{{$day['day']}}<br>({{$day['short_date']}})</div>	
								@endforeach
							</div>
							<div class="calender-time">
								@foreach($daysData as $day)
								<div class="time-avali">
									@foreach($day['available'] as $slot)

									@if($slot['available'] == 2)
									<div class="time-slot time_stot_active">
										<a href="javascript:void(0)" style="color: #fff">{{$slot['time_shift']}}</a>
									</div>
									@else
									<div class="time-slot">
										<a href="javascript:void(0)" class="slotBooking" data-slotid="{{$slot['id']}}" data-slot="{{$slot['time_shift']}}">{{$slot['time_shift']}}</a>
									</div>
									@endif
									@endforeach
								</div>
								@endforeach
							</div>
						</div>
					</div>
					<!-- mentor time sectioon end  -->

				</div>


				<!-- review start -->
				<div class="mentor-det-details no-flex reviews-place">
					<h2 class="medium-heading">Reviews <span>({{count($mentor->reviews)}})</span></h2>

					<form class="form-horizontal poststars" action="{{route('reviewpost')}}" id="addStar" method="POST">
						{{ csrf_field() }}
						<div class="form-group required">
							  @php
						        $guard = get_guard();$notification = [];
						        if($guard != ''){
						            $user = Auth::guard($guard)->user();
						        }
						    @endphp
						    <input type="hidden" name="currenturl" value="{{url()->full()}}">
							<input type="hidden" name="userid" value="{{$user->id}}"> 
							<input type="hidden" name="mentor_id" value="{{$mentor->id}}"> 

							<div class="rating">
								<input class="star star-5" value="5" id="star-5" type="radio" name="rating"/>
								<label class="star star-5" for="star-5"></label>
								<input class="star star-4" value="4" id="star-4" type="radio" name="rating"/>
								<label class="star star-4" for="star-4"></label>
								<input class="star star-3" value="3" id="star-3" type="radio" name="rating"/>
								<label class="star star-3" for="star-3"></label>
								<input class="star star-2" value="2" id="star-2" type="radio" name="rating"/>
								<label class="star star-2" for="star-2"></label>
								<input class="star star-1" value="1" id="star-1" type="radio" name="rating"/>
								<label class="star star-1" for="star-1"></label>
							</div>


							<div>
								<textarea name="review" class="form-control"></textarea>
							</div>

							<div>
							<button type="submit" name="submit" class="btn btn-primary">Post</button>
							</div>

						</div>
					</form>
				</div>

				<!-- review end -->

				@if(count($mentor->reviews) > 0)
				<div class="mentor-det-details no-flex reviews-place">
					<h2 class="medium-heading">Reviews <span>({{count($mentor->reviews)}})</span></h2>

					<ul class="review-list">
						@foreach($mentor->reviews as $key => $review)
						<li>
							<div class="box">
								<div class="box-inner justify-content-start">
									<div class="viewer-image">
										<img src="@if($review->user->image == ''){{asset('design/images/mentor2.jpg')}}@else{{$review->user->image}}@endif">
									</div>
									<div class="reviewer-content">
										<h3 class="profile-name mb-0">{{$review->user->name}}</h3>
										<small class="small-info date-text d-block text-muted" style="font-size:13px;">{{date('M, d Y',strtotime($review->created_at))}}</small>
										<div class="comment mt-1">
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

				@php $resume = $mentor->resume; @endphp
				@if(count($resume) > 0)
				<div class="mentor-det-details no-flex resume-place">
					<h2 class="medium-heading">Resume</h2>
					<ul class="edu-list">
						@foreach($resume as $index => $res)
						<li>
							<div class="year">{{date('M, Y',strtotime($res->start))}} — {{($res->end != '0000-00-00' ? date('M, Y',strtotime($res->end)) : 'Till Now')}}</div>
							<div class="study">
								{{$res->name}}
							</div>
						</li><hr>
						@endforeach
					</ul>					
				</div>
				@endif
			</div>
			<div class="right-panel">
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

				<div class="show-review">
					<span><img src="{{asset('design/images/rating.png')}}"></span> {{number_format(avgRatingOfMentors($mentor->reviews),2)}} <a href="javascript:void(0)">({{count($mentor->reviews)}} reviews)</a>
				</div>

				<div class="button-place">
					
					<a href="javascript:void(0)" data-mentor="{{$mentor->id}}" data-name="{{$mentor->name}}" class="prinery-btm deepblue-btm messageToMentor">Message</a>
				</div>

			</div>
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
	var mentorId = '{{$mentor->id}}';
	$(document).on('click','.messageToMentor',function(){
		var checkGuard = '{{get_guard()}}';$('#errorMessage').empty();
		mentorId = parseInt($(this).attr('data-mentor'));
		if(checkGuard == '' || checkGuard == 'admin'){
			alert('you have to perform login before sending message');
		}else{
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

	$(document).on('click','.slotBooking',function(){
		var guard = '{{get_guard()}}';
		if(guard == '' || guard == 'admin'){
			alert('you have to perform login before booking slot');
		}else{
			var slot = $(this).attr('data-slot'),slotId = $(this).attr('data-slotid');
			swal({
				title: "Are you sure?",
				text: "you want to proceed the booking Slot "+slot+'?',
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
						url : '{{Route('mentor.booking.slot')}}',
						type: 'post',
						data: {slotId:slotId,mentorId:mentorId,'_token':'{{csrf_token()}}'},
						success:function(data){
							if(data.error == false){
								window.location.href=data.redirectURL;
							}else{
								swal('Error',data.msg);
							}
						}
					});
				}
			});
		}
	});

	$(document).on('click','.bookMentorButton',function(){
		alert('Please select the slot from available Slots List');
	});
</script>
@stop
@endsection