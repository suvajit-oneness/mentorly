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
                <table class="table table-hover custom-data-table-style table-striped" id="sampleTable">
					<tr>
						<th>Id</th>
						<th>Host Id</th>
						<th>Topic</th>
						<th>Start Time</th>
						<th>Agenda</th>
						<th>Join URL</th>
						<th>Action</th>
					</tr>
					@foreach($data->meetings as $zoom)
						<tr>
							<td>{{$zoom->id}}</td>
							<td>{{$zoom->host_id}}</td>
							<td>{{$zoom->topic}}</td>
							<td>{{$zoom->start_time}}</td>
							<td>@if(!empty($zoom->agenda)){{$zoom->agenda}}@else{{'N/A'}}@endif</td>
							<td><a href="{{$zoom->join_url}}" target="_blank">Join</a></td>
							<td><a href="{{route('admin.zoom.delete',$zoom->id)}}" class="loaderEnable text-danger">Delete</a></td>
						</tr>
					@endforeach
				</table>
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
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable({"ordering": false});</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
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