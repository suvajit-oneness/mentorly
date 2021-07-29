@extends('layouts.master')
@section('title','Mentor Detail')
@section('content')

<section class="gray-wrapper">
	<div class="container-xl">
		
		<div class="mentor-details-wrapper">
			<div class="left-panel">



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


				@php $resume = $mentor->resume; @endphp
				
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
			var existingSlotId = '{{ Request::segment(5) }}';
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
							url : '{{Route('mentor.booking.reschduleslot')}}',
							type: 'post',
							data: {slotId:slotId,existingSlotId:existingSlotId,mentorId:mentorId,'_token':'{{csrf_token()}}'},
							success:function(data){
								console.log(data);
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