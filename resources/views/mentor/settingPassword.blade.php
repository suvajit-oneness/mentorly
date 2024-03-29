@extends('layouts.master')
@section('title','Password Setting')
@section('content')
	
<section class="gray-wrapper">
	<div class="container">
		<div class="setting-wrapper">
			<div class="row m-0 mt-5">
				@include('mentor.settingSidebar')
				<div class="col-12 col-md-10 pl-2 pl-md-5">
					<div class="settings-details">
						<form method="post" action="{{route('mentor.password.update',$guard)}}">
							<input type="hidden" name="">
							@csrf
							<div class="settings-heading mb-3">Create Password</div>

							<div class="form-group row m-0">
							    <div class="col-12 col-md-6 mb-3">
							        <label>Old Password</label>
							        <input type="password" name="old_password" class="input-style" placeholder="Old password" value="{{old('old_password')}}">
									@error('old_password')
										<span class="text-danger">{{$message}}</span>
									@enderror
							    </div>
							     <div class="col-12 col-md-6 mb-3">
							        <label>New Password</label>
						        	<input type="password" name="password" class="input-style" placeholder="New password" value="{{old('password')}}">
									@error('password')
										<span class="text-danger">{{$message}}</span>
									@enderror
							    </div>
							     <div class="col-12 col-md-6 mb-3">
							        <label>Varify Password</label>
							        <input type="password" name="password_confirmation" class="input-style" placeholder="Varify password">
							    </div>
									<!--<label class="col-md-4">Old Password</label>
									<div class="col-md-8">
										<input type="password" name="old_password" class="input-style" placeholder="Old password" value="{{old('old_password')}}">
										@error('old_password')
											<span class="text-danger">{{$message}}</span>
										@enderror
									</div>-->
							</div>

							<!--<div class="form-group">
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
							</div>-->

							<div class="row justify-content-end align-items-end">
								<div class="col-md-3">
									<input type="submit" class="rounded-button-style float-lg-right" id="" value="Save settings">
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