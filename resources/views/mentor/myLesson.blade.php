@extends('layouts.master')
@section('title','Shift Available')
@section('content')
<section class="gray-wrapper">
	<div class="container">
		<div class="setting-wrapper">
			<div class="row m-0 mt-5">
				@include('mentor.settingSidebar')
				<div class="col-12 col-md-10 pl-2 pl-md-5">
					<div class="settings-details p-1" style="max-width: none;">
						<h5>Next Lesson</h5>
						<div class="table-responsive zoomTable">
							@if(count($nextlesson) > 0)
							<table class="table table-hover table-sm table-bordered">
								<thead>
									<tr>
										<th>Booking Id</th>
										<th>Booking Date</th>
										<th>Mentor Name</th>
										<th>Mentor Email</th>
										<th>Mentor Mobile</th>
										<th>Booking Amount</th>
										<th>Booking Status</th>
										<th>Booking Slot</th>
									</tr>
								</thead>
								<tbody>
									@foreach($nextlesson as $pur)
										<tr>
											<td>{{$pur->slotbookid}}</td>
											<td><?php echo date('m-d-y',strtotime($pur->classbooked)) ?></td>
											<td>{{$pur->name}}</td>
											<td>{{$pur->email}}</td>
											<td>{{$pur->mobile}}</td>
											<td>$ {{$pur->amount/100}}</td>
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

											<td>{{$pur->date}} - {{$pur->time_shift}}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							@else
								<h4 class="text-center p-3">You donot have any Booking</h4>
							@endif
						</div>


					<nav aria-label="breadcrumb">
					 
					</nav>


						<div class="table-responsive zoomTable">
							<h5>My Lesson</h5>
							@if(count($recentlesson) > 0)
							<table class="table table-hover table-sm table-bordered">
								<thead>
									<tr>
										<th>Booking Id</th>
										<th>Booking Date</th>
										<th>Mentor Name</th>
										<th>Mentor Email</th>
										<th>Mentor Mobile</th>
										<th>Booking Amount</th>
										<th>Booking Status</th>
										<th>Booking Slot</th>
									</tr>
								</thead>
								<tbody>
									@foreach($recentlesson as $pur)
										<tr>
											<td>{{$pur->slotbookid}}</td>
											<td><?php echo date('m-d-y',strtotime($pur->classbooked)) ?></td>
											<td>{{$pur->name}}</td>
											<td>{{$pur->email}}</td>
											<td>{{$pur->mobile}}</td>
											<td>$ {{$pur->amount/100}}</td>
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
											<td>{{$pur->date}} - {{$pur->time_shift}}</td>

											
										</tr>
									@endforeach
								</tbody>
							</table>
							@else
								<h4 class="text-center p-3">You donot have any Booking</h4>
							@endif
						</div>
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