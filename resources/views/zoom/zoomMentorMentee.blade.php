@extends('layouts.master')
@section('title','Zoom Meeting')
@section('content')
<section class="gray-wrapper">
	<div class="container">
		<div class="setting-wrapper">
			<div class="row m-0 mt-5">
				@include('mentor.settingSidebar')
				<div class="col-12 col-md-10 pl-2 pl-md-5">
					<div class="settings-details p-1" style="max-width: none;">
						<div class="table-responsive zoomTable">
							<table class="table table-hover custom-data-table-style table-striped table-sm table-bordered" id="sampleTable">
								<tr>
									<th>Id</th>
									<th>Meeting Id</th>
									<th>Host Id</th>
									<th>Mentor Details</th>
									<th>Mentee Details</th>
									<th>Topic</th>
									<th>Start Time</th>
									<th>Agenda</th>
									<th>Join URL</th>
									<th>Action</th>
								</tr>
								@foreach($data as $zoom)
									<tr>
										<td>{{$zoom->id}}</td>
										<td>{{$zoom->meetingId}}</td>
										<td>{{$zoom->host_id}}</td>
										<td>@if($zoom->mentor){{$zoom->mentor->name}} ({{$zoom->mentor->email}})@else{{('N/A')}}@endif</td>
										<td>@if($zoom->mentee){{$zoom->mentee->name}} ({{$zoom->mentee->email}})@else{{('N/A')}}@endif</td>
										<td>{{$zoom->topic}}</td>
										<td>{{$zoom->start_time}}</td>
										<td>@if(!empty($zoom->agenda)){{$zoom->agenda}}@else{{'N/A'}}@endif</td>
										<td><a href="{{$zoom->join_url}}" target="_blank" class="zoomBtn">Join</a></td>
										<td><a href="{{route('user.zoom.meeting.cancel',$zoom->id)}}">Cancel</a></td>
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