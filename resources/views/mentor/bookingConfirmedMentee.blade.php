@extends('layouts.master')
@section('title','Booking Slots')
@section('content')
<section class="gray-wrapper">
	<div class="setting-wrapper">
		@include('mentor.settingSidebar')
		<div class="settings-details">
			@if(count($booking) > 0)
			<table id="MyTable" class="table" border="1" style="width: 100%">
				<thead>
					<tr>
						<th>Booking Id</th>
						<th>Booking Date</th>
						<th>Name</th>
						<th>Email</th>
						<th>Mobile</th>
						<th>Booking Amount</th>
						<th>Booking Slot</th>
					</tr>
				</thead>
				<tbody>
					@foreach($booking as $book)
						<tr>
							<td>{{$book->id}}</td>
							<td>{{date('Y-m-d h:i:s',strtotime($book->created_at))}}</td>
							<td>{{$book->userDetails->name}}</td>
							<td>{{$book->userDetails->email}}</td>
							<td>{{$book->userDetails->mobile}}</td>
							<td>{{$book->price}}</td>
							<td>@if($book->slot_details){{$book->slot_details->date}} - {{$book->slot_details->time_shift}}@endif</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			@else
				<h4>You donot have any Confirmed Booking</h4>
			@endif
		</div>
	</div>
</section>
@section('script')
	<script type="text/javascript"></script>
@stop
@endsection