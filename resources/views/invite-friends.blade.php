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
			<input type="text" name="referrallink" id="referrallink" value="{{url('registration')}}/{{$urlParamerer}}?referral={{$referral->code}}" placeholder="your referral link" class="form-control">
		</div>
		<div class="form-group col-md-3">
			<button class="btn btn-primary" onclick="clipFunc()" id="copyLinkBtn">Copy Link</button>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			{{-- <h5>STEP 1</h5>
			<p class="text-muted">Copy your Referral Link</p>
			<h5>STEP 2</h5>
			<p class="text-muted">Share</p> --}}
			<a href="http://www.facebook.com/sharer.php?s=100&p[title]=Hey I found this app !&p[summary]=Hey I found this app !&p[url]={{url('registration')}}/{{$urlParamerer}}?referral={{$referral->code}}" class="btn btn-primary mb-2" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a>

			<a href="#" class="btn btn-info mb-2" target="_blank"><i class="fab fa-linkedin"></i> Linkedin</a>

			<a href="#" class="btn btn-warning mb-2" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>

			<a href="https://wa.me/?text=Hey I found this app !%0A%0A{{url('registration')}}/{{$urlParamerer}}?referral={{$referral->code}}" class="btn btn-success mb-2" target="_blank"><i class="fab fa-whatsapp"></i> WhatsApp</a>
		</div>
	</div>
</div>

@section('script')
	<script type="text/javascript">
		function clipFunc() {
			var referrallink = document.getElementById("referrallink");
			var btn = document.getElementById("copyLinkBtn");
			referrallink.select();
			referrallink.setSelectionRange(0, 99999); /* For mobile devices */
			navigator.clipboard.writeText(referrallink.value);
			btn.innerHTML = "Link copied";
			// btn.innerHTML = "Link copied";
			// alert("Copied the text: " + referrallink.value);
		}
	</script>
@stop
@endsection