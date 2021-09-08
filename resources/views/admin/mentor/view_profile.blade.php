@extends('layouts.master')
@section('title','Mentor Profile')
@section('content')
<section class="gray-wrapper">
	<div class="container-xl">
		<div class="mentor-details-wrapper">
			<div class="left-panel">

				<div class="mentor-det-details">
					<div class="det-photo">
						<img src="@if($mentor->image !=''){{$mentor->image}}@else{{asset('design/images/mentor1.jpg')}}@endif">
					</div>
					<div class="mentor-bio">
						<h3 class="profile-name mb-0">{{$mentor->name}}.</h3>
						<span class="small-info">Certified developer with {{dateDifferenceFromNow($mentor->carrier_started)}} experience.</span>
						<div class="inerview-taken mt-3">
							<span>Email : {{$mentor->email}}</span>
							<!-- <span><img src="{{asset('design/images/company.png')}}"></span>  Twitch -->
						</div>
						<div class="inerview-taken mt-3"><br>
							<span>Charge per hour : {{$mentor->charge_per_hour}} $</span>
							<!-- <span><img src="{{asset('design/images/student.png')}}"></span>  0 interviews given -->
						</div>
					</div>
				</div>

				<div class="mentor-det-details no-flex">
					<h2 class="medium-heading">About the mentor</h2>
					<p>{{$mentor->about}}</p>
				</div>

				@php $experience = $mentor->experience; @endphp
				@if(count($experience) > 0)
					<div class="mentor-det-details no-flex resume-place">
						<h2 class="medium-heading">Experience</h2>
						<ul class="edu-list">
							@foreach($experience as $index => $res)
							<li>
								<div class="year">{{date('M, Y',strtotime($res->start))}} — {{($res->end != '0000-00-00' ? date('M, Y',strtotime($res->end)) : 'Till Now')}}</div>
								<div class="study">
									{{$res->name}}
								</div>
							</li><hr>
							@endforeach
						</ul>
					</div>
				@endif

				@if(count($mentor->reviews) > 0)
				<div class="mentor-det-details no-flex reviews-place">
					<h2 class="medium-heading">Reviews <span>({{count($mentor->reviews)}})</span></h2>

					<ul class="review-list">
						@foreach($mentor->reviews as $key => $review)
						<li>
							<div class="box">
								<div class="box-inner justify-content-start">
									@php
										$reviewUser = $review->user;
									@endphp
									@if($reviewUser)
										<div class="viewer-image">
											<img src="@if($reviewUser->image == ''){{asset('design/images/mentor2.jpg')}}@else{{$reviewUser->image}}@endif">
										</div>
										<div class="reviewer-content">
											<h3 class="profile-name mb-0">{{$reviewUser->name}}</h3>
											<small class="small-info date-text d-block text-muted" style="font-size:13px;">{{date('M, d Y',strtotime($review->created_at))}}</small>
											<div class="comment mt-1">
												<p>{{$review->review}}.</p>
											</div>
										</div>
									@endif
								</div>
							</div>
						</li>
						@endforeach
					</ul>
				</div>
				@endif
			</div>
			<a href="javascript:void(0)" class="prinery-btm deepblue-btm verifiedToggle" data-currentStatus="{{$mentor->is_verified}}">@if($mentor->is_verified == 1)<span class="text-danger">{{('Verified')}}</span>@else<span class="text-success">{{('Unverified')}}</span>@endif</a>
		</div>
	</div>
</section>

@section('script')
<script type="text/javascript">
	$(document).on('click','.verifiedToggle',function(){
		$('.loading-data').show();
        var thisButton = $(this),currentStatus = thisButton.attr('data-currentStatus');
        $.ajax({
            url : '{{route('admin.mentor.verified.update')}}',
            type : 'post',
            data : {currentStatus:currentStatus,mentorId:'{{$mentor->id}}',_token:'{{csrf_token()}}'},
            success:function(data){
                if(data.error == false){
                    thisButton.attr('data-currentStatus',data.currentStatus);
                    if(data.currentStatus == 1){
                        thisButton.empty().append('<span class="text-danger">Verified</span>');
                    }else{
                        thisButton.empty().append('<span class="text-success">Unverified</span>');
                    }
                }else{
                    swal('Error',data.message);
                }
                $('.loading-data').hide();
            }
        });
    });
</script>
@stop
@endsection