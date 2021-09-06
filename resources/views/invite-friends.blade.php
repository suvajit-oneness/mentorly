@extends('layouts.master')
@section('title','Invite-friends')
@section('content')

<div class="container">
	<div class="frend-headding">
		<h1>Refer a friend, get a discount</h1>
		<p>
		    Invite your friends to get {{$masterRef->off_percentage}}% off {{$masterRef->offer_detail}}, and you’ll get 
		    ${{$masterRef->reward_amount}} in credit after they take their lesson!
		</p> <!--(that's {{$masterRef->reward_amount * 100}} INR)-->
    </div>
	<div class="row justify-content-center">
		<div class="form-group d-flex col-12 col-md-6 link_copy">
			<input type="text" name="referrallink" id="referrallink" value="{{url('registration')}}/{{$urlParamerer}}?referral={{$referral->code}}" placeholder="your referral link" class="form-control">
			<button class="btn btn-primary" onclick="clipFunc()" id="copyLinkBtn">Copy Link</button>
		</div>
	</div>

	<div class="row justify-content-center mb-5">
			{{-- <h5>STEP 1</h5>
			<p class="text-muted">Copy your Referral Link</p>
			<h5>STEP 2</h5>
			<p class="text-muted">Share</p> --}}
			<a href="http://www.facebook.com/sharer.php?s=100&p[title]=Hey I found this app !&p[summary]=Hey I found this app !&p[url]={{url('registration')}}/{{$urlParamerer}}?referral={{$referral->code}}" class="btn btn-primary mr-1 btn-sm mb-2" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a>

			<a href="#" class="btn btn-info mb-2 mr-1 btn-sm" target="_blank"><i class="fab fa-linkedin"></i> Linkedin</a>

			<a href="#" class="btn btn-warning mb-2 mr-1 btn-sm" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>

			<a href="https://wa.me/?text=Hey I found this app !%0A%0A{{url('registration')}}/{{$urlParamerer}}?referral={{$referral->code}}" class="btn btn-success mr-1 btn-sm mb-2" target="_blank"><i class="fab fa-whatsapp"></i> WhatsApp</a>
		
	</div>
</div>
<style>
    .frend-headding{
        margin:50px 0;
    }
    .frend-headding h1{
        color: #000;
        font-family: GT Walsheim Pro;
        font-weight: 700;
        font-size: 38px;
        margin-bottom: 10px;
        text-align:center;
    }
    .frend-headding p{
        font-family: 'Lato', sans-serif;
        color: #2e2b2b;
        font-size: 15px;
        font-weight: 400;
        line-height: 1.8;
        text-align:center;
    }
    .link_copy input{
        border-radius:5px 0 0 5px;
        height:40px;
    }
    .link_copy .btn{
        border-radius:0 5px 5px 0;
        height:40px;
        width:115px;
        background: #1cb3d3;
        border-color:#1cb3d3;
    }
    .link_copy .btn:hover{
         background: #000;
         border-color:#000;
    }
</style>
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