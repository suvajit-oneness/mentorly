@extends('layouts.master')
@section('title','Password Setting')
@section('content')
	
<section class="gray-wrapper">
	<div class="setting-wrapper">
		@include('mentor.settingSidebar')
		<div class="settings-details">
			<form method="post" action="{{route('mentor.password.update',$guard)}}">
				<input type="hidden" name="">
				@csrf
				<div class="settings-heading mb-5">Create Password</div>

				<div class="form-group">
					<div class="row align-items-center">
						<label class="col-md-4">Old Password</label>
						<div class="col-md-8">
				  			<input type="password" name="old_password" class="input-style" placeholder="Old password" value="{{old('old_password')}}">
				  			@error('old_password')
				  				<span class="text-danger">{{$message}}</span>
				  			@enderror
				  		</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row align-items-center">
						<label class="col-md-4">New Password</label>
						<div class="col-md-8">
				  			<input type="password" name="password" class="input-style" placeholder="New password" value="{{old('password')}}">
				  			@error('password')
				  				<span class="text-danger">{{$message}}</span>
				  			@enderror
				  		</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row align-items-center">
						<label class="col-md-4">Varify Password</label>
						<div class="col-md-8">
				  			<input type="password" name="password_confirmation" class="input-style" placeholder="Varify password">
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
					</div>
				</div>

			</form>
		</div>
	</div>
</section>
	
@section('script')
	<script type="text/javascript"></script>
@stop
@endsection