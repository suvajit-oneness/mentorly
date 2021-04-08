@extends('layouts.master')
@section('title','Zoom Meeting')
@section('content')
<section class="gray-wrapper">
	<div class="setting-wrapper">
		@include('mentor.settingSidebar')
		<div class="settings-details">
			<table class="table table-hover custom-data-table-style table-striped" id="sampleTable">
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
						<td><a href="{{$zoom->join_url}}" target="_blank">Join</a></td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>
</section>

@section('script')
	<script type="text/javascript"></script>
@stop
@endsection