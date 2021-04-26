@extends('layouts.master')
@section('title','Email Setting')
@section('content')
<section class="gray-wrapper">
	<div class="container">
		<div class="setting-wrapper">
			<div class="row m-0 mt-5">
				<div class="col-12 col-md-2 p-0">
					@include('mentor.settingSidebar')
				</div>
				<div class="col-12 col-md-10 pl-2 pl-md-5">
					<div class="settings-details">
						<form method="post" action="{{route('mentor.email.update')}}">
							@csrf
							<div class="settings-heading mb-5">Email</div>
							<div class="form-group">
								<div class="row align-items-center">
									<label class="col-md-4">Email</label>
									<div class="col-md-8">
										<input type="hidden" name="guardType" value="{{$guard}}">
										<input type="hidden" name="authId" value="{{$user->id}}">
										<input type="text" name="email" class="input-style" id="email" placeholder="Enter your email address" value="@if(old('email')){{old('email')}}@else{{$user->email}}@endif">
										@error('email')
											<span class="text-danger">{{$message}}</span>
										@enderror
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
			</div>
		</div>
	</div>
</section>

@section('script')
	<script type="text/javascript"></script>
@stop
@endsection