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
						<h3 class="profile-name mb-0">{{$mentor->name}}.</h3>
						<span class="small-info">Certified developer with 10 years experience.</span>
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
					<p>
						It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
					</p>
				</div>


				<div class="mentor-det-details no-flex available-place">
					<h2 class="medium-heading">Mentor availability</h2>

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
											<div class="time-slot"><a href="javascript:void(0)" class="slotBooking" data-slotid="{{$slot['id']}}" data-slot="{{$slot['time_shift']}}">{{$slot['time_shift']}}</a></div>
										@endforeach
									</div>
								@endforeach
							</div>
						</div>
					</div>

				</div>

				@if(count($mentor->reviews) > 0)
				<div class="mentor-det-details no-flex reviews-place">
					<h2 class="medium-heading">Reviews <span>({{count($mentor->reviews)}})</span></h2>

					<ul class="review-list">
						@foreach($mentor->reviews as $key => $review)
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

				<!-- <div class="mentor-det-details no-flex resume-place">
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
				</div> -->

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
					<span><img src="{{asset('design/images/rating.png')}}"></span> {{avgRatingOfMentors($mentor->reviews)}} <a href="#">({{count($mentor->reviews)}} reviews)</a>
				</div>

				<div class="button-place">
					<a href="#" class="prinery-btm blue-btm">Book mentor</a>
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
				alert('you have to perform login before sending message');
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
							url : '{{Route('mentor/booking/slot')}}',
							type: 'post',
							data: {slotId:slotId,mentorId:mentorId,price:'{{$mentor->charge_per_hour}}','_token':'{{csrf_token()}}'},
							success:function(data){
								if(data.error == false){
									swal(data.msg, {
				      					icon: "success",
				    				});
				    				setTimeout(function(){ 
				    					location.reload();
				    				},2000);
								}else{
									swal('Error',data.msg);
								}
							}
						});
				  	}
				});
			}
		});
	</script>
@stop
@endsection