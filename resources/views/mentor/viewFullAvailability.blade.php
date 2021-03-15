@extends('layouts.master')
@section('title','Full Availabilty')
@section('content')


<section class="gray-wrapper">
	<div class="container-xl">
		<div class="profile-wrapper">
			<div class="profile-holder">
				<div class="profile-details-box">
					<div class="profile-first">
						<a href="#">
							<img src="@if($mentor->image !=''){{$mentor->image}}@else{{asset('design/images/mentor1.jpg')}}@endif">
						</a>
					</div>
					<div class="profile-middle">
						<a href="{{route('mentor.details',$mentor->id)}}" class="profile-name">{{$mentor->name}}.</a>
						<ul class="twolist">
							<li class="company">Twitch</li>
							<li class="rating">
								<span><img src="{{asset('design/images/rating.png')}}"></span>
								{{avgRatingOfMentors($mentor->reviews)}}
								<a href="#">({{count($mentor->reviews)}} Reviews)</a>
							</li>
						</ul>
						<div class="inerview-taken">
							<span><img src="{{asset('design/images/student.png')}}"></span>  51 interviews given
						</div>
					</div>
					<div class="profile-right">
						<span class="price">
							${{$mentor->charge_per_hour}} <span>/ hour</span>
						</span>
						<a href="javascript:void(0)" class="messageToMentor" data-mentor="{{$mentor->id}}" data-name="{{$mentor->name}}" class="prinery-btm deepblue-btm">Message</a>
					</div>
				</div>

				<!-- Schedule For Mentor -->
				<div class="settings-heading">Schedule of ({{$mentor->name}})</div>
				<h6>
					<a href="{{url()->current()}}?date={{date('Y-m-d',strtotime($originalDate.'-7 days'))}}"><&nbsp;</a>
						{{$originalDate}} to {{$date}}
					<a href="{{url()->current()}}?date={{date('Y-m-d',strtotime($date.'+1 days'))}}">&nbsp;></a>
				</h6>
				<ul class="date">
					@foreach($daysData as $day)
						<li class="day">
							<strong>{{$day['day']}}<br>({{$day['short_date']}})</strong>
							<ul>
								@foreach($day['available'] as $slot)
									<li class="slots">
										<a href="javascript:void(0)" class="slotBooking" data-slotid="{{$slot['id']}}" data-slot="{{$slot['time_shift']}}">{{$slot['time_shift']}}</a>
									</li>
								@endforeach
							</ul>
						</li>	
					@endforeach
				</ul>
				<!-- Schedule End For Mentor -->
			</div>
		</div>
		<!-- Ratings and Reviews -->
		<div class="profile-details-box">
			<div class="settings-heading">Rating and Reviews 
				<span>
					<img src="{{asset('design/images/rating.png')}}">
				</span> {{avgRatingOfMentors($mentor->reviews)}}
				<a href="#">({{count($mentor->reviews)}} Reviews)</a>
			</div>
			@foreach($mentor->reviews as $review)
				<div class="mentorReviews">
					<ul>
						<li>
							<img src="@if($review->image == ''){{(asset('design/images/mentor1.jpg'))}}@else{{$review->image}}@endif" height="60" width="60">
						</li>
						<li>{{$review->name}}</li>
						<li>{{date('Y-m-d',strtotime($review->created_at))}}</li>
						<li>{{$review->review}}</li>
					</ul>
				</div>
			@endforeach
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