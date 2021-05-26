@extends('layouts.master')
@section('title','Message Logs')
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
						<div class="table-responsive zoomTable">
							<table class="table table-hover custom-data-table-style table-striped table-sm table-bordered" id="sampleTable">
								<tr>
									<th>Message Id</th>
									<th>Sender Details</th>
									<th>Receiver Details</th>
									<th>Message</th>
									<!-- <th>Action</th> -->
								</tr>
								@foreach($data as $msg)
									<tr>
										<td>{{$msg->id}}</td>
										<td>
											@if($msg->sender)
											<ul>
												<li>Name : {{$msg->sender->name}}</li>
												<li>Email : {{$msg->sender->email}}</li>
											</ul>
											@else
												{{('N/A')}}
											@endif
										</td>
										<td>
											@if($msg->receiver)
											<ul>
												<li>Name : {{$msg->receiver->name}}</li>
												<li>Email : {{$msg->receiver->email}}</li>
											</ul>
											@else
												{{('N/A')}}
											@endif
										</td>
										<td>{!! $msg->message !!}</td>
										<!-- <td><a href="javascript:void(0)">Reply</a></td> -->
									</tr>
								@endforeach
							</table>
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