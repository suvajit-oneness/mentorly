@extends('layouts.master')
@section('title','Invite-friends')
@section('content')

	<h1>Your Payment was successFull</h1>
	<br>
	<h3>Note : Please Save the Below Details for future Referance</h3><br>
	<span>Transaction Id : <strong>{{$stripe->transactionId}}</strong></span><br>
	<span>Amount Charged : $ .<strong>{{$stripe->amount/100}} </strong></span>

	<br><br><br><br>
	<a href="{{url('/')}}">Click here to go home</a>
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