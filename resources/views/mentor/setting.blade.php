@extends('layouts.master')
@section('title','Profile')
@section('content')

<section class="gray-wrapper">
	<div class="container">
		<div class="setting-wrapper">
			<!--<h2 class="page-heading">Keep your profile Uptodate</h2>-->
			<div class="row m-0 mt-5">
				@include('mentor.settingSidebar')
				<div class="col-12 col-md-10 pl-2 pl-md-5">
					<div class="settings-details">
						<form method="post" action="{{route('mentor.mentee.account_update')}}" enctype="multipart/form-data">
							@csrf
							<div class="settings-heading mb-4">Account Settings</div>
                            <div class="row m-0">
                                <div class="col-12 col-md-3 p-0">
                                    <label>Profile image</label>
        							<div class="profile-picture-setting">
        								<div class="mentee-image">
        									<img id="blah" src="@if($user->image == ''){{asset('design/images/mentor5.jpg')}}@else{{$user->image}}@endif" alt="your image" title="">
        								</div>
        								<div class="upload-image">
        									<input type="file" id="file-upload" name="image">
        									<div class="file-style">
        										<span><img src="{{asset('design/images/photo.png')}}"></span>
        										<!--Upload image-->
        									</div>
        								</div>
        							</div>
                                </div>
                                <div class="col-12 col-md-9 p-0">
                                    <div class="form-group row m-0">
        								<?php $name = explode(' ',$user->name);
        									$firstName = '';$lastName = '';
        									if(count($name) > 0){
        										$firstName = $name[0];
        										$lastName = !empty($name[1]) ? $name[1] : '';
        									}
        								?>
        								<div class="col-12 col-md-6 mb-3">
        									<label>First name</label>
        									<input type="text" name="first_name" class="input-style" placeholder="Enter your First name" value="{{$firstName}}">
        								</div>
        								<div class="col-12 col-md-6 mb-3">
        							    	<label>Last name</label>
        							    	<input type="text" name="last_name" class="input-style" placeholder="Enter your last name" value="{{$lastName}}">
        								</div>
        								<div class="col-12 col-md-6 mb-3">
        								    <label>Email</label>
        								    <input type="text" class="input-style" id="email" placeholder="Enter your email address" value="@if(old('email')){{old('email')}}@else{{$user->email}}@endif" readonly="">
        									@error('email')
        										<span class="text-danger">{{$message}}</span>
        									@enderror
        								</div>
        								<div class="col-12 col-md-6 mb-3">
        								    <label>Phone number</label>
        								    <input type="text" name="mobile" onkeypress="return isNumberKey(event)" maxlength="15" class="input-style" placeholder="Enter your phone number" value="{{$user->mobile}}">
        								</div>
        								<div class="col-12 col-md-6 mb-3">
        								    <label>Timezone</label>
        								    <select class="select-style" id="sel1" name="timezone">
        										@foreach($timezone as $key => $zone)
        											<option value="{{$zone->id}}" @if($user->timezone_id == $zone->id){{'selected'}}@endif>{{$zone->name}}</option>
        										@endforeach
        								    </select>
        								</div>
        								@if(get_guard() == 'mentor')
        								<div class="col-12 col-md-6 mb-3">
        								    <label>Carrier Started Date</label>
        								    <input type="date" name="carrier_started" class="input-style" value="{{$user->carrier_started}}" onkeypress="return false;">
        								</div>
        								<div class="col-12 col-md-6 mb-3">
        								    <label>Designation</label>
        								    <input type="text" name="designation" class="input-style" value="{{$user->designation}}" placeholder="Your Designation">
        								</div>
        								<div class="col-12 col-md-6 mb-3">
        								    <label>Price Per Hour ($)</label>
        								    <input type="text" name="price_per_hour" onkeypress="return isNumberKey(event)" maxlength="5" class="input-style" placeholder="Price Per Hour" value="{{$user->charge_per_hour}}">
        								</div>
        								<div class="col-12 col-md-12 mb-3">
        								    <label>About</label>
        								    <textarea name="about" class="input-style" placeholder="About You max (200) Character">{{$user->about}}</textarea>
        								</div>
        								@endif
        							</div>
                                </div>
                            </div>
							

							<!--<div class="form-group">
								<div class="row align-items-center">
									<label class="col-md-4">Last name</label>
									<div class="col-md-8">
										<input type="text" name="last_name" class="input-style" placeholder="Enter your last name" value="{{$lastName}}">
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row align-items-center">
									<label class="col-md-4">Email</label>
									<div class="col-md-8">
										<input type="text" class="input-style" id="email" placeholder="Enter your email address" value="@if(old('email')){{old('email')}}@else{{$user->email}}@endif" readonly="">
										@error('email')
											<span class="text-danger">{{$message}}</span>
										@enderror
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
							@if(get_guard() == 'mentor')

								<div class="form-group">
									<div class="row align-items-center">
										<label class="col-md-4">Carrier Started Date</label>
										<div class="col-md-8">
											<input type="date" name="carrier_started" class="input-style" value="{{$user->carrier_started}}" onkeypress="return false;">
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row align-items-center">
										<label class="col-md-4">Designation</label>
										<div class="col-md-8">
										  	<input type="text" name="designation" class="input-style" value="{{$user->designation}}" placeholder="Your Designation">
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row align-items-center">
										<label class="col-md-4">Price Per Hour ($)</label>
										<div class="col-md-8">
											<input type="text" name="price_per_hour" onkeypress="return isNumberKey(event)" maxlength="5" class="input-style" placeholder="Price Per Hour" value="{{$user->charge_per_hour}}">
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row align-items-center">
										<label class="col-md-4">About</label>
										<div class="col-md-8">
										  <textarea name="about" class="input-style" placeholder="About You max (200) Character">{{$user->about}}</textarea>
										</div>
									</div>
								</div>
								
							@endif-->
							<div class="form-group">
								<div class="row justify-content-end align-items-end">
									<div class="col-md-3">
										<input type="submit" class="rounded-button-style float-lg-right" id="" value="Save settings">
									</div>
									<!-- <div class="col-md-4">
										<div class="form-group">
											<input type="button" class="rounded-button-style" id="" value="Delete account">
										</div>
									</div> -->
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
</section>

@section('script')
	<script type="text/javascript"></script>
@stop
@endsection