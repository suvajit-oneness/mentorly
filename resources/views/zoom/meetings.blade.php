@if($guard == 'admin')
	@extends('admin.app')
	@section('title') {{'Zoom Meetings'}} @endsection
	@section('content')
	<div class="fixed-row">
	    <div class="app-title">
	        <div class="active-wrap">
	            <h1><i class="fa fa-file"></i> Zoom Meeting</h1>
	        </div>
	        <a href="javascript:void(0)" class="btn btn-primary pull-right addNewZoomMeetings">Add New</a>
	    </div>
	</div>
	@include('admin.partials.flash')
	<div class="row section-mg row-md-body no-nav">
	    <div class="col-md-12">
	        <div class="tile">
	            <div class="tile-body">
	                <table class="table table-hover table-responsive custom-data-table-style table-striped" id="sampleTable">
						<thead>
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
						</thead>
						<tbody>
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
								<td><a href="{{route('admin.zoom.delete',$zoom->meetingId)}}" class="loaderEnable text-danger">Delete</a></td>
							</tr>
						@endforeach
						</tbody>
					</table>
					{{-- {{$data->links()}} --}}
	            </div>
	        </div>
	    </div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="zoomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title" id="exampleModalLabel">Create Meeting</h5>
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          			<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
	      		<form method="post" action="{{route('admin.zoom.meeting.create')}}">
	      		@csrf
		      		<div class="modal-body">
		      			<div class="form-group">
		      				<label>Topic</label>
		      				<input type="text" name="topic" class="form-control @error('topic'){{'is-invalid'}}@enderror" placeholder="Topic Here" value="{{old('topic')}}">
		      				@error('topic')
		      					<span class="text-danger">{{$message}}</span>
		      				@enderror
		      			</div>
		      			<div class="form-group">
		      				<label>Agenda</label>
		      				<input type="text" name="agenda" class="form-control @error('agenda'){{'is-invalid'}}@enderror" placeholder="Agenda Here" value="{{old('agenda')}}">
		      				@error('agenda')
		      					<span class="text-danger">{{$message}}</span>
		      				@enderror
		      			</div>
		      			<div class="form-group">
		      				<label>Date and Time</label>
		      				<input type="datetime-local" name="start_time" class="form-control @error('start_time'){{'is-invalid'}}@enderror" value="{{old('start_time')}}" onkeypress="return false;">
		      				@error('start_time')
		      					<span class="text-danger">{{$message}}</span>
		      				@enderror
		      			</div>
		      			<div class="form-group">
		      				<label>Mentor</label>
		      				<select class="form-control" name="mentor">
		      					<option value="" selected="">Select Mentor</option>
		      					@foreach($mentor as $teacher)
		      						<option value="{{$teacher->id}}">{{$teacher->name}} ({{$teacher->email}})</option>
		      					@endforeach
		      				</select>
		      			</div>
		      			<div class="form-group">
		      				<label>Mentee</label>
		      				<select class="form-control" name="mentee">
		      					<option value="" selected="">Select Mentee</option>
		      					@foreach($mentee as $student)
		      						<option value="{{$student->id}}">{{$student->name}} ({{$student->email}})</option>
		      					@endforeach
		      				</select>
		      			</div>
		      		</div>
		      		<div class="modal-footer">
		        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        		<button type="submit" class="btn btn-primary loaderEnable">Save changes</button>
		      		</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
	@endsection
	@push('scripts')
	   
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
		<script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
		<script type="text/javascript">$('#sampleTable').DataTable({"ordering": false});</script>
	    <script type="text/javascript">
	    	@if($errors->any())
	    		$('#zoomModal').modal('show');
	    	@endif

	    	@if(Session::has('Status'))
	    		swal('Success','{{Session::get('Status')}}')
	    	@endif

	    	$(document).on('click','.addNewZoomMeetings',function(){
	    		$('#zoomModal').modal('show');
	    	});

	    	$(document).ready(function() {
	            $('.loading-data').hide();
	        });

	        $(document).on('click','.loaderEnable',function(){
	        	$('.loading-data').show();
	        });
	    </script>
	@endpush
@else
	<h1>Mentee or Mentor Part</h1>
@endif