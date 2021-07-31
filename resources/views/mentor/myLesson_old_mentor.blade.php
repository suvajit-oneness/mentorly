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


					<nav aria-label="breadcrumb">
					  <div class="table-responsive zoomTable">
							<h5>Next Lesson</h5>
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
										<th>Booking Slot</th>
									</tr>
								</thead>
								<tbody>
									@foreach($recentlesson as $pur)
										<tr>
											<td>{{$pur->id}}</td>
											<td>{{date('Y-m-d h:i:s',strtotime($pur->created_at))}}</td>
											<td>{{$pur->mentor->name}}</td>
											<td>{{$pur->mentor->email}}</td>
											<td>{{$pur->mentor->mobile}}</td>
											<td>{{$pur->price}}</td>
											<td>{{$pur->slot_details->date}} - {{$pur->slot_details->time_shift}}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							@else
								<h4 class="text-center p-3">You donot have any Booking</h4>
							@endif
						</div>
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
										<th>Booking Slot</th>
									</tr>
								</thead>
								<tbody>
									@foreach($recentlesson as $pur)
										<tr>
											<td>{{$pur->id}}</td>
											<td>{{date('Y-m-d h:i:s',strtotime($pur->created_at))}}</td>
											<td>{{$pur->mentor->name}}</td>
											<td>{{$pur->mentor->email}}</td>
											<td>{{$pur->mentor->mobile}}</td>
											<td>{{$pur->amount}}</td>
											<td>{{$pur->slot_details->date}} - {{$pur->slot_details->time_shift}}</td>
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