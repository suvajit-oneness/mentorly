@extends('layouts.master')
@section('title','mentors')
@section('content')

<section class="gray-wrapper">
	<div class="setting-wrapper">
		<ul class="setting-list">
			<li><a href="{{route('mentor.mentee.setting')}}" class="active">Account</a></li>
			<li><a href="{{route('mentor.email.setting')}}">Email</a></li>
			<li><a href="{{route('mentor.password.setting')}}">Password </a></li>
			<li><a href="#">Payment Methods</a></li>
			<li><a href="#">Payment History</a></li>
			<li><a href="#">Calendar</a></li>
		</ul>
		<div class="settings-details">
			<form method="post" action="{{route('mentor.mentee.account_update')}}" enctype="multipart/form-data">
				@csrf
				<div class="settings-heading">Account Settings</div>

				<h4 class="small-heading">Profile image</h4>

				<div class="profile-picture-setting">
					<div class="mentee-image">
						<img id="blah" src="@if($user->image == ''){{asset('design/images/mentor5.jpg')}}@else{{$user->image}}@endif" alt="your image" title="">
					</div>
					<div class="upload-image">
						<input type="file" id="file-upload" name="image">
						<div class="file-style">
							<span><img src="{{asset('design/images/photo.png')}}"></span>
							Upload image
						</div>
					</div>
				</div>

				<div class="form-group">
					<?php $name = explode(' ',$user->name);
						$firstName = '';$lastName = '';
						if(count($name) > 0){
							$firstName = $name[0];
							$lastName = !empty($name[1]) ? $name[1] : '';
						}
					?>
					<div class="row align-items-center">
						<label class="col-md-4">First name</label>
						<div class="col-md-8">
				  			<input type="text" name="first_name" class="input-style" placeholder="Enter your First name" value="{{$firstName}}">
				  		</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row align-items-center">
						<label class="col-md-4">Last name</label>
						<div class="col-md-8">
				  			<input type="text" name="last_name" class="input-style" placeholder="Enter your last name" value="{{$lastName}}">
				  		</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row align-items-center">
						<label class="col-md-4">Phone number</label>
						<div class="col-md-8">
				  			<input type="text" name="mobile" onkeypress="return isNumberKey(event)" maxlength="15" class="input-style" placeholder="Enter your phone number" value="{{$user->mobile}}">
				  		</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row align-items-center">
						<label class="col-md-4">Timezone</label>
						<div class="col-md-8">
						  <select class="select-style" id="sel1" name="timezone">
								@foreach($timezone as $key => $zone)
									<option value="{{$zone->id}}" @if($user->timezone_id == $zone->id){{'selected'}}@endif>{{$zone->name}}</option>
								@endforeach
						  </select>
				  		</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row align-items-center">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<div class="form-group">
				  				<input type="submit" class="rounded-button-style" id="" value="Save settings">
				  			</div>
				  		</div>
				  		<!-- <div class="col-md-4">
				  			<div class="form-group">
				  				<input type="button" class="rounded-button-style" id="" value="Detete account">
				  			</div>
				  		</div> -->
					</div>
				</div>
			</form>
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