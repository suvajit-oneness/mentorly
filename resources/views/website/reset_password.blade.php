@extends('layouts.master')
@section('title','Reset password')
@section('content')

<section class="gray-wrapper gray-wide-space">
	<div class="container">
		<div class="login-wrapper">
			<div class="login-header justify-center">
				<h3>Reset your password?</h3>
			</div>
			<form method="post" action="{{route('updatepassword')}}">
				@csrf
				<input type="hidden" name="userid" value="{{$userid}}">
				<div class="form-wrapper">
					<div class="form-group">              
						<input type="password" class="form-control" placeholder="New Password" name="password" id="txtPassword" required>
					</div>  

					<div class="form-group">              
						<input type="password" class="form-control" placeholder="Confirm Password" name="" id="txtConfirmPassword" required>
					</div>

					<div class="form-group">
						<input type="submit" class="button-style" id="" value="Submit" onclick="return Validate()">
					</div>
				</div>
			</form>
		</div>
	</div>
</section>	

@section('script')
<script type="text/javascript"></script>
  <script type="text/javascript">
    function Validate() {
        var password = document.getElementById("txtPassword").value;
        var confirmPassword = document.getElementById("txtConfirmPassword").value;
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }
        return true;
    }
	</script>
@stop
@endsection