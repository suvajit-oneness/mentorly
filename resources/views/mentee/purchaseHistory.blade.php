@extends('layouts.master')
@section('title','Shift Available')
@section('content')
<section class="gray-wrapper">
	<div class="setting-wrapper">
		@include('mentor.settingSidebar')
		<div class="settings-details">
			@if(count($purchase) > 0)
			<table class="table" border="1" style="width: 100%">
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
					@foreach($purchase as $pur)
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
				<h4>You donot have any Booking</h4>
			@endif
		</div>
	</div>
</section>

@section('script')
	<script type="text/javascript"></script>
@stop
@endsection