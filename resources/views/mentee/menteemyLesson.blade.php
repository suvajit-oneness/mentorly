@extends('layouts.master')
@section('title','Shift Available')
@section('content')
<section class="gray-wrapper">
	<div class="container">
		<div class="setting-wrapper">
			<div class="row m-0 mt-5">
				<div class="col-12 col-md-2 p-0">
					@include('mentor.settingSidebar')
				</div>

				<div class="col-12 col-md-10 pl-2 pl-md-5">



					<div class="settings-details p-1" style="max-width: none;">
						<h5>Upcoming Lesson</h5>
						<div class="table-responsive zoomTable">
							@if(count($lession) > 0)
							<table class="table table-hover table-sm table-bordered">
								<thead>
									<tr>
										<th>Booking Id</th>
										<th>Booking Date</th>
										<th>Mentor Name</th>
										<th>Mentor Email</th>
										<th>Mentor Mobile</th>
										<th>Booking Slot</th>
										<th>Booking Amount</th>
										<th>Booking Status</th>
										<th>Transaction Id</th>
									</tr>
								</thead>
								<tbody>
									@php $counter = 0;@endphp
									@foreach($lession as $index => $pur)
									@if($index <= 5)
									@php
									$mentor = $pur->mentor;
									$transaction = $pur->transaction_detail;
									$slot = $pur->slot_details;
									@endphp
									<tr>
										<td>{{$pur->id}}</td>
										<td>{{date('m-d-y',strtotime($pur->created_at))}}</td>
										<td>{{$mentor->name}}</td>
										<td>{{$mentor->email}}</td>
										<td>{{$mentor->mobile}}</td>
										<td>{{$slot->date}} - {{$slot->time_shift}}</td>
										<td>$ {{$transaction->amount/100}}</td>
										<td>	
											@if($pur->bookingStatus==0)
											<span style="color: blue;">
												Pending
											</span>
											@elseif($pur->bookingStatus==1)
											<span style="color: green;">
												Approved
											</span>
											@elseif($pur->bookingStatus==2)
											<span style="color: red;">
												Rejected
											</span>
											@endif
										</td>
										<td>{{$transaction->transactionId}}</td>
									</tr>
									@php $counter++; @endphp
									@else
									@break
									@endif
									@endforeach
								</tbody>
							</table>
							@else
							<h4 class="text-center p-3">You donot have any Booking</h4>
							@endif
						</div>
						<nav aria-label="breadcrumb"></nav>
						@if(count($lession) > 5 && $counter >= 5)
						<h5>My Lesson</h5>
						<div class="table-responsive zoomTable">
							<table class="table table-hover table-sm table-bordered">
								<thead>
									<tr>
										<th>Booking Id</th>
										<th>Booking Date</th>
										<th>Mentor Name</th>
										<th>Mentor Email</th>
										<th>Mentor Mobile</th>
										<th>Booking Slot</th>
										<th>Booking Amount</th>
										<th>Booking Status</th>
										<th>Transaction Id</th>
									</tr>
								</thead>
								<tbody>
									@foreach($lession as $key => $pur)
									@if($key > 5)
									@php
									$mentor = $pur->mentor;
									$transaction = $pur->transaction_detail;
									$slot = $pur->slot_details;
									@endphp
									<tr>
										<td>{{$pur->id}}</td>
										<td>{{date('m-d-y',strtotime($pur->created_at))}}</td>
										<td>{{$mentor->name}}</td>
										<td>{{$mentor->email}}</td>
										<td>{{$mentor->mobile}}</td>
										<td>{{$slot->date}} - {{$slot->time_shift}}</td>
										<td>$ {{$transaction->amount/100}}</td>
										<td>	
											@if($pur->bookingStatus==0)
											<span style="color: blue;">
												Pending
											</span>
											@elseif($pur->bookingStatus==1)
											<span style="color: green;">
												Approved
											</span>
											@elseif($pur->bookingStatus==2)
											<span style="color: red;">
												Rejected
											</span>
											@endif
										</td>
										<td>{{$transaction->transactionId}}</td>
									</tr>
									@endif
									@endforeach
								</tbody>
							</table>
						</div>
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