@php
	$guard = get_guard();
	if($guard != '')$user = Auth::guard($guard)->user();
@endphp
@if($user)
	@php
        $lession = \App\Models\MentorSlotBooked::select('mentor_slot_bookeds.*','available_shifts.date','available_shifts.time_shift')->where('mentor_slot_bookeds.bookedUserId',$user->id)->where('mentor_slot_bookeds.userType',$guard)
	        ->where('mentor_slot_bookeds.bookingStatus','!=',3)->leftjoin('available_shifts','mentor_slot_bookeds.availableShiftId','=','available_shifts.id')->where('available_shifts.date','>=',date('Y-m-d'))->latest('mentor_slot_bookeds.created_at')->first();
	@endphp
	@if($lession)
		@php
			$mentor = $lession->mentor;
		@endphp
		<div class="col-12 row m-0 p-0">
		    <div class="col-12 col-md-2 user_ID">
	        	<a href="javascript:void(0)">
            		@if($guard == 'web')
            			ID : MENTEE-{{$user->id}}
            		@elseif($guard == 'mentor')
            			ID : MENTOR-{{$user->id}}
            		@endif
            	</a>
		    </div>
		    <div class="nextLession alert alert-info">
	          <table>
    				<tr>
    					<th class="pr-3">Upcoming Lession :</th>
    					<td>
    						Your Coming Session with '{{$mentor->name}}' for session '{{date('d M, Y',strtotime($lession->date))}} at {{date('h:i A',strtotime($lession->time_shift))}}'
    						@if(1==1)
    							@php
    								$zoomMeeting = \App\Models\ZoomMeeting::where('mentorSlotBookedId',$lession->id)->where('mentorId',$lession->mentorId)->where('menteeId',$lession->bookedUserId)->where('userType',$lession->userType)->latest()->first();
    								if($zoomMeeting){
    									@endphp
    										<a href="{{$zoomMeeting->join_url}}" class="btn btn-dark btn-sm ml-5 pl-3 pr-3" target="_blank">Join</a>
    									@php
    								}
    							@endphp
    						@endif
    					</td>
    				</tr>
    			</table>
		    </div>
		</div>
	@endif
@endif
<div class="col-12 col-md-2 p-0">
<ul class="setting-list">
	<li><a href="{{route('mentor.mentee.setting')}}" class="{{Route::currentRouteName()=='mentor.mentee.setting'?'active':''}}">Account</a></li>
	<!-- <li><a href="{{route('mentor.email.setting')}}" class="{{Route::currentRouteName()=='mentor.email.setting'?'active':''}}">Email</a></li> -->
	<li><a href="{{route('mentor.password.setting')}}" class="{{Route::currentRouteName()=='mentor.password.setting'?'active':''}}">Password </a></li>
	<!-- <li><a href="#">Payment Methods</a></li> -->
	<!-- <li><a href="{{route('booking.history')}}"class="{{Route::currentRouteName()=='booking.history'?'active':''}}" >Booking History</a></li> -->
	<li><a href="{{route('booking.mylessons')}}"class="{{Route::currentRouteName()=='booking.mylessons'?'active':''}}">My Lessons </a></li>
	<!-- <li><a href="#">Calendar</a></li> -->
	@if($guard == 'mentor')
		<li><a href="{{route('mentor.booking.request')}}" class="{{Route::currentRouteName()=='mentor.booking.request'?'active':''}}">Booking Confimed</a></li>
		<li><a href="{{route('mentor.availability.setting')}}" class="{{Route::currentRouteName()=='mentor.availability.setting'?'active':''}}">Set Availability </a></li>
		<li><a href="{{route('mentor.experience.log')}}" class="{{Route::currentRouteName()=='mentor.experience.log'?'active':''}}">Experience Log </a></li>
	@endif
	<li><a href="{{route('user.zoom.meeting')}}" class="{{Route::currentRouteName()=='user.zoom.meeting'?'active':''}}">Zoom Meeting</a></li>
</ul>
</div>