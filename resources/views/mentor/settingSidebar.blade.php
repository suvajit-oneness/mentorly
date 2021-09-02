<ul class="setting-list">
	<li><a href="{{route('mentor.mentee.setting')}}" class="{{Route::currentRouteName()=='mentor.mentee.setting'?'active':''}}">Account</a></li>
	<!-- <li><a href="{{route('mentor.email.setting')}}" class="{{Route::currentRouteName()=='mentor.email.setting'?'active':''}}">Email</a></li> -->
	<li><a href="{{route('mentor.password.setting')}}" class="{{Route::currentRouteName()=='mentor.password.setting'?'active':''}}">Password </a></li>
	<!-- <li><a href="#">Payment Methods</a></li> -->
	<!-- <li><a href="{{route('booking.history')}}"class="{{Route::currentRouteName()=='booking.history'?'active':''}}" >Booking History</a></li> -->
	<li><a href="{{route('booking.mylessons')}}"class="{{Route::currentRouteName()=='booking.mylessons'?'active':''}}" >My Lessons </a></li>
	<!-- <li><a href="#">Calendar</a></li> -->
	@if(get_guard() == 'mentor')
		<li><a href="{{route('mentor.booking.request')}}" class="{{Route::currentRouteName()=='mentor.booking.request'?'active':''}}" >Booking Confimed</a></li>
		<li><a href="{{route('mentor.availability.setting')}}" class="{{Route::currentRouteName()=='mentor.availability.setting'?'active':''}}">Set Availability </a></li>
		<li><a href="{{route('mentor.experience.log')}}" class="{{Route::currentRouteName()=='mentor.experience.log'?'active':''}}">Experience Log </a></li>
	@endif
	<li><a href="{{route('user.zoom.meeting')}}" class="{{Route::currentRouteName()=='user.zoom.meeting'?'active':''}}">Zoom Meeting</a></li>
</ul>