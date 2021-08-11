@extends('admin.app')
@section('title') Job Requirement @endsection
@section('content')
<div class="fixed-row">
    <div class="app-title">
        <div class="active-wrap">
            <h1><i class="fa fa-file"></i> Job Requirement</h1>
        </div>
        <a href="javascript:void(0)" class="btn btn-primary pull-right AddNewJobRequirement">Add New</a>
    </div>
</div>
    @include('admin.partials.flash')
    <div class="row section-mg row-md-body no-nav">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    @if(Session::has('message'))
                        <p class="alert alert-success">{{ Session::get('message') }}</p>
                    @endif
                    <table class="table table-hover custom-data-table-style table-striped" id="sampleTable">
                        <thead>
                            <tr>
                                <th> Id </th>
                                <th> Job Type</th>
                                <th> Job Name</th>
                                <th> Requirement</th>
                                <th> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requirement as $index => $data)
                                <tr>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->job_details->type->title}}</td>
                                    <td>{{$data->job_details->name}}</td>
                                    <td>{{$data->name}}</td>
                                    <td><a href="javascript:void(0)" class="text-success editJobRequirement" data-details="{{json_encode($data)}}">Edit</a> | <a href="javascript:void(0)" class="text-danger deleteJobRequirement" data-id="{{$data->id}}">Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Job Category Modal -->
    <div class="modal fade" id="addJobRequirementModalLong" tabindex="-1" role="dialog" aria-labelledby="addJobRequirementModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJobRequirementModalLongTitle">Add New Job Requirement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('admin.job.requirement.saveOrUpdate')}}">
                    @csrf
                    <input type="hidden" name="jobId" value="{{$jobId}}">
                    <input type="hidden" name="form_type" value="add">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="name" id="requirementName" placeholder="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror">
                            @error('name')<span class="text-danger errorMessage">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Job Category Modal -->
    <div class="modal fade" id="editJobRequirementModalLong" tabindex="-1" role="dialog" aria-labelledby="editJobRequirementModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editJobRequirementModalLongTitle">Edit Job Requirement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('admin.job.requirement.saveOrUpdate')}}">
                    @csrf
                    <input type="hidden" name="jobId" value="{{$jobId}}">
                    <input type="hidden" name="form_type" value="edit">
                    <input type="hidden" name="requirementId" id="requirementId" value="{{old('requirementId')}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="name" id="requirementName" placeholder="Name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror">
                            @error('name')<span class="text-danger errorMessage">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        <button type="submit" class="btn btn-primary">Update</button>
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

        @if(old('form_type') == 'add')
            $('#addJobRequirementModalLong').modal('show');
        @endif

        @if(old('form_type') == 'edit')
            $('#editJobRequirementModalLong').modal('show');
        @endif

        $(document).on('click','.AddNewJobRequirement',function(){
            $('#addJobRequirementModalLong .form-control').removeClass('is-invalid');$('.errorMessage').remove();
            $('#addJobRequirementModalLong #requirementName').val('');
            $('#addJobRequirementModalLong').modal('show');
        });

        $(document).on('click','.editJobRequirement',function(){
            var details = JSON.parse($(this).attr('data-details'));
            $('#editJobRequirementModalLong #requirementId').val(details.id);
            $('#editJobRequirementModalLong #requirementName').val(details.name);
            $('#editJobRequirementModalLong .form-control').removeClass('is-invalid');$('.errorMessage').remove();
            $('#editJobRequirementModalLong').modal('show');
        });

        $(document).on('click','.deleteJobRequirement',function(){
            var deleteJobRequirement = $(this);
            var JobRequirementId = $(this).attr('data-id');
            swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this Job requirement!",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: false
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        type : 'POST',
                        dataType : 'JSON',
                        url : "{{route('admin.job.requirement.delete')}}",
                        data : {JobRequirementId:JobRequirementId,_token:'{{csrf_token()}}'},
                        success:function(data){
                            if(data.error == false){
                                deleteJobRequirement.closest('tr').remove();
                                swal('Success',"Poof! Job category has been deleted!", 'success');
                            }else{
                                swal('Error',data.message);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endpush
