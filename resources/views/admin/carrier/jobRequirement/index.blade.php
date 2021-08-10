@extends('admin.app')
@section('title') Job Requirement @endsection
@section('content')
<div class="fixed-row">
    <div class="app-title">
        <div class="active-wrap">
            <h1><i class="fa fa-file"></i> Job Requirement</h1>
        </div>
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
                                    <td><a href="javascript:void(0)" class="text-success">Edit</a> | <a href="javascript:void(0)" class="text-danger">Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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

    </script>
@endpush
