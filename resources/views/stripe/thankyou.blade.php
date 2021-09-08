@extends('layouts.master')
@section('title','Invite-friends')
@section('content')
    <div class="container">
        <div class="row justify-content-center payment_done">
            <div class="col-12 text-center">
                <h1>
                    Your payment was successfull
                    <small class="d-block">Note : Please Save the Below Details for future Referance</small>
                </h1>
                <p>Transaction Id : <b>{{$stripe->transactionId}}</b></p>
                <p>Amount Charged : <b>$ {{$stripe->amount/100}}</b></p>
                	<a href="{{url('/')}}">Click here to go home</a>
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

<style>
    .payment_done{
        margin:50px 0;
    }
    .payment_done h1{
        color: #000;
        font-family: GT Walsheim Pro;
        font-weight: 700;
        font-size: 38px;
        margin-bottom: 10px;
        text-align: center;
        text-transform: capitalize;
    }
    .payment_done h1 small{
        color: #2e2b2b;
        font-size: 15px;
        font-weight: 400;
        line-height: 1.8;
        text-align: center;
        margin-bottom:20px;
    }
    .payment_done p{
        font-size: 16px;
        line-height: 22px;
        font-weight: 400;
        margin-bottom: 8px;
    }
    .payment_done a{
        font-family: GT Walsheim Pro;
        font-size: 14px;
        text-transform: capitalize;
        margin:50px auto;
        color: #fff;
        padding: 0 31px;
        height: 39px;
        border-radius: 60px;
        display: block;
        line-height: 39px;
        background: #1cb3d3;
        text-align: center;
        border: none;
        width:208px;
    }
</style>