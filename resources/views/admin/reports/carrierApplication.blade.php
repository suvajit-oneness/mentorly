@extends('admin.app')
@section('title') Job Application @endsection
@section('content')
<div class="fixed-row">
    <div class="app-title">
        <div class="active-wrap">
            <h1><i class="fa fa-file"></i> Job Application</h1>
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
                                <th> First Name </th>
                                <th> Last Name </th>
                                <th> Email Id </th>
                                <th> Phone No </th>
                                <th> Resume</th>
                                <th> Posted At </th>
                                <!-- <th> Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($application as $index => $appl)
                                @php
                                    $job_details = $appl->job_details;
                                    $type = $job_details->type;
                                @endphp
                                <tr>
                                    <td>{{$appl->id}}</td>
                                    <td>{{$type->title}}</td>
                                    <td>{{$job_details->name}}</td>
                                    <td>{{$appl->f_name}}</td>
                                    <td>{{$appl->l_name}}</td>
                                    <td>{{$appl->email}}</td>
                                    <td>{{$appl->mobile}}</td>
                                    <td><a href="{{asset($appl->resume)}}" target="_blank">View</a></td>
                                    <td>{{date('D m, Y H:i:A',strtotime($appl->created_at))}}</td>
                                    <!-- <td></td> -->
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
