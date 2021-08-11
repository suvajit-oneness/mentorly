@extends('admin.app')
@section('title') Job Category @endsection
@section('content')
<div class="fixed-row">
    <div class="app-title">
        <div class="active-wrap">
            <h1><i class="fa fa-file"></i> Job Category</h1>
        </div>
        <a href="javascript:void(0)" class="btn btn-primary pull-right AddNewJobCategory">Add New</a>
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
                                <th> Total Job</th>
                                <th> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($type as $index => $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->title}}</td>
                                <td>
                                    <a href="{{route('admin.job.design.index')}}?category={{encrypt($category->id)}}">{{count($category->job_details)}}</a>
                                </td>
                                <td><a href="javascript:void(0)" class="text-success editJobCategory" data-details="{{json_encode($category)}}">Edit</a> | <a href="javascript:void(0)" class="text-danger deleteJobCategory" data-id="{{$category->id}}">Delete</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Job Category Modal -->
    <div class="modal fade" id="addJobCategoryModalLong" tabindex="-1" role="dialog" aria-labelledby="addJobCategoryModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJobCategoryModalLongTitle">Add New Job Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Job Category Modal -->
    <div class="modal fade" id="editJobCategoryModalLong" tabindex="-1" role="dialog" aria-labelledby="editJobCategoryModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editJobCategoryModalLongTitle">Edit Job Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
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
            $('#addJobCategoryModalLong').modal('show');
        @endif

        @if(old('form_type') == 'edit')
            $('#editJobCategoryModalLong').modal('show');
        @endif

        $(document).on('click','.AddNewJobCategory',function(){
            $('#AddNewJobCategory .form-control').removeClass('is-invalid');$('.errorMessage').remove();
            $('#AddNewJobCategory').modal('show');
        });

        $(document).on('click','.editJobCategory',function(){
            var details = JSON.parse($(this).attr('data-details'));
            // $('#editJobCategoryModalLong #planIdForUpdate').val(details.id);
            // $('#editJobCategoryModalLong #typeIdforUpdate').val(details.type);
            // $('#editJobCategoryModalLong #titleForUpdate').val(details.title);
            $('#editJobCategoryModalLong .form-control').removeClass('is-invalid');$('.errorMessage').remove();
            $('#editJobCategoryModalLong').modal('show');
        });

        $(document).on('click','.deleteJobCategory',function(){
            var deleteJobCategory = $(this);
            var categoryId = $(this).attr('data-id');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Job plan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type : 'POST',
                        dataType : 'JSON',
                        url : "",
                        data : {jobCategoryId:categoryId,_token:'{{csrf_token()}}'},
                        success:function(data){
                            if(data.error == false){
                                deleteJobCategory.closest('tr').remove();
                                swal('Success',"Poof! Company Plan has been deleted!", 'success');
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
