@extends('layouts.master')
@section('title','Booking Slots')
@section('content')
<section class="gray-wrapper">
	<div class="container">
		<div class="setting-wrapper">
			<div class="row m-0 mt-5">
					@include('mentor.settingSidebar')
				<div class="col-12 col-md-10 pl-2 pl-md-5">
					<div class="settings-details table-responsive zoomTable">
						@if(count($booking) > 0)
						<table id="MyTable" class="table table-hover table-sm table-bordered">
							<thead>
								<tr>
									<th>Booking Id</th>
									<th>Booking Date</th>
									<th>Name</th>
									<th>Email</th>
									<th>Mobile</th>
									<th>Booking Amount</th>
									<th>Booking Slot</th>
									<th>Status</th>
									<th>Change Status</th>
								</tr>
							</thead>
							<tbody>
								@foreach($booking as $book)
								@php
									$user = $book->userDetails;
								@endphp
								<tr>
									<td>{{$book->id}}</td>
									<td>{{date('Y-m-d h:i:s',strtotime($book->created_at))}}</td>
									<td>{{($user) ? $user->name : 'N/A'}}</td>
									<td>{{($user) ? $user->email : 'N/A'}}</td>
									<td>{{($user) ? $user->mobile : 'N/A'}}</td>
									<td>$ {{$book->transaction_detail->amount / 100}}</td>
									<td>@if($book->slot_details){{$book->slot_details->date}} - {{$book->slot_details->time_shift}}@endif</td>
									<td>
										@if($book->rescheduleStatus==0)
										@if($book->bookingStatus==0)
										<span style="color: blue;">
											Pending
										</span>
										@elseif($book->bookingStatus==1)
										<span style="color: green;">
											Approved
										</span>
										@elseif($book->bookingStatus==2)
										<span style="color: red;">
											Rejected
										</span>
										@endif
										@elseif($book->rescheduleStatus==1)
										<span style="color: blue">Reschedule</span>
										@endif
									</td>
									<td>
										@if($book->bookingStatus==0)
										<a href="{{route('booking.request.approve',$book->id)}}" onclick="return confirm('Are you sure to active this ?	')">
										<button class="btn-success">Approve</button>
										</a>
										<!-- <a href="{{route('booking.request.reject',$book->id)}}" onclick="return confirm('Are you sure to Reject this ?	')">
										<button class="btn-danger">Reject</button>
										</a> -->
										<a href="{{route('booking.request.reschedule',['id'=>$book->id,
											'mentorId'=>base64_encode($book->mentorId)])}}" onclick="return confirm('Are you sure to Reschedule this ?	')">
										<button class="btn-warning">Reschedule</button>
										</a>
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						@else
						<h4>You donot have any Confirmed Booking</h4>
						@endif
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