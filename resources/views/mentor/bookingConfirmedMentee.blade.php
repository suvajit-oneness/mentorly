@extends('layouts.master')
@section('title','Booking Slots')
@section('content')
<section class="gray-wrapper">
	<div class="container">
		<div class="setting-wrapper">
			<div class="row m-0 mt-5">
				<div class="col-12 col-md-2 p-0">
					@include('mentor.settingSidebar')
				</div>
				<div class="col-12 col-md-10 pl-2 pl-md-5">
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
										<td>{{($book->userDetails) ? $book->userDetails->name : 'N/A'}}</td>
										<td>{{($book->userDetails) ? $book->userDetails->email : 'N/A'}}</td>
										<td>{{($book->userDetails) ? $book->userDetails->mobile : 'N/A'}}</td>
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
			</div>
		</div>
	</div>
</section>
@section('script')
	<script type="text/javascript"></script>
@stop
@endsection