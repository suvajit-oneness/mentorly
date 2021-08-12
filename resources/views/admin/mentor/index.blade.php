@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="fixed-row">
    <div class="app-title">
        <div class="active-wrap">
            <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        <!-- <a href="" class="btn btn-primary pull-right">Add New</a> -->
        <a href="{{route('admin.mentor.create')}}" class="btn btn-primary pull-right">Add New</a>
    </div>
</div>
    @include('admin.partials.flash')
    <div class="row section-mg row-md-body no-nav">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    {{-- <a href="{{route('admin.mentor.create')}}" class="float-right">Add Mentor</a> --}}
                    @if(Session::has('message'))
                        <p class="alert alert-success">{{ Session::get('message') }}</p>
                    @endif
                    <table class="table table-hover table-responsive custom-data-table-style table-striped" id="sampleTable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th> Name </th>
                                <th> Email Id </th>
                                <th> Phone No </th>
                                <th> Designation </th>
                                <th> Charge per hour </th>
                                <th> Experience </th>
                                <th> verified</th>
                                <th> Created At </th>
                                <th> Status </th>
                                <th style="width:100px; min-width:100px;" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mentor as $key => $mentor)
                                <tr>
                                    <td>{{ $mentor->id }}</td>
                                    <td>{{ $mentor->name }}</td>
                                    <td>{{ $mentor->email }}</td>
                                    <td>{{ $mentor->mobile }}</td>
                                    <td>{{ $mentor->designation }}</td>
                                    <td>$ {{$mentor->charge_per_hour}}</td>
                                    <td>{{dateDifferenceFromNow($mentor->carrier_started)}}</td>
                                    <td>
                                        <span>@if($mentor->is_verified == 1){{('Yes')}}@else{{('No')}}@endif</span>
                                        <input type="checkbox" name="verified" data-mentor="{{$mentor->id}}" data-currentStatus="{{$mentor->is_verified}}" class="verifiedToggle" @if($mentor->is_verified == 1){{('checked')}}@endif>
                                    </td>
                                    <td>{{ date("d-M-Y",strtotime($mentor->created_at)) }}</td>
                                    <td class="text-center">
                                    <div class="toggle-button-cover margin-auto">
                                        <div class="button-cover">
                                            <div class="button-togglr b2" id="button-11">
                                                <input id="toggle-block" type="checkbox" name="status" class="checkbox" data-mentor_id="{{ $mentor['id'] }}" {{ $mentor['status'] == 1 ? 'checked' : '' }}>
                                                <div class="knobs"><span>Inactive</span></div>
                                                <div class="layer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="{{route('admin.mentor.edit',$mentor->id)}}" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0)" data-id="{{$mentor['id']}}" class="sa-remove btn btn-sm btn-danger edit-btn"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
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
     {{-- New Add --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
    <script type="text/javascript">
        $('.sa-remove').on("click",function(){
            var mentorid = $(this).data('id');
            swal({
              title: "Are you sure?",
              text: "Your will not be able to recover the record!",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: false
            },
            function(isConfirm){
              if (isConfirm) {
                window.location.href = "mentor/"+mentorid+"/delete";
                } else {
                  swal("Cancelled", "Record is safe", "error");
                }
            });
        });
        $('input[id="toggle-block"]').change(function() {
            var mentor_id = $(this).data('mentor_id');
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var check_status = 0;
          if($(this).is(":checked")){
              check_status = 1;
          }else{
            check_status = 0;
          }
          $.ajax({
                type:'POST',
                dataType:'JSON',
                url:"{{route('admin.mentor.updateStatus')}}",
                data:{ _token: CSRF_TOKEN, id:mentor_id, check_status:check_status},
                success:function(response)
                {
                  swal("Success!", response.message, "success");
                },
                error: function(response)
                {

                  swal("Error!", response.message, "error");
                }
              });
        });

        $(document).on('click','.verifiedToggle',function(){
            var thisCheckbox = $(this),currentStatus = thisCheckbox.attr('data-currentStatus'),mentorId = thisCheckbox.attr('data-mentor');
            $.ajax({
                url : '{{route('admin.mentor.verified.update')}}',
                type : 'post',
                data : {currentStatus:currentStatus,mentorId:mentorId,_token:'{{csrf_token()}}'},
                success:function(data){
                    if(data.error == false){
                        thisCheckbox.attr('data-currentStatus',data.currentStatus);
                        if(data.currentStatus == 1){
                            thisCheckbox.closest('td').find('span').text('Yes');
                        }else{
                            thisCheckbox.closest('td').find('span').text('No');
                        }
                    }else{
                        swal('Error',data.message);
                    }
                }
            });
        });

    </script>
@endpush
