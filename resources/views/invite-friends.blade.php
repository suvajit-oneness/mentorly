@extends('layouts.master')
@section('title','Invite-friends')
@section('content')

<div class="container">
	<center>
		<h1>Refer a friend,</h1>
		<h1>get a discount</h1>
		<p>Invite your friends to get {{$masterRef->off_percentage}}% off {{$masterRef->offer_detail}}, and you’ll get</p>
		<p>${{$masterRef->reward_amount}} (that's {{$masterRef->reward_amount * 100}} INR) in credit after they take their lesson!</p>
	</center>

	<div class="row">
		<div class="form-group col-md-4">
			<input type="text" name="referrallink" value="" placeholder="your referral link" class="form-control">
		</div>
		<div class="form-group col-md-3">
			<button class="btn btn-primary">Copy Link</button>
		</div>
	</div>
</div>

@section('script')
    <script type="text/javascript"></script>
@stop
@endsection