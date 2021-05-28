@extends('admin.app')
@section('title') All Booked Slots @endsection
@section('content')
<div class="fixed-row">
    <div class="app-title">
        <div class="active-wrap">
            <h1><i class="fa fa-file"></i> All Booked Slots</h1>
            {{-- <p>and Feedbacks</p> --}}
        </div>
        {{-- <a href="{{route('admin.slot.trashed')}}" class="btn btn-primary pull-right">Trashed</a> --}}
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
                    <table class="table table-hover custom-data-table-style table-striped" id="sampleTable">
                        <thead>
                            <tr>
                                <th> Id </th>
                                <th> Transaction Id </th>
                                <th> Mentor Name </th>
                                <th> Shift Booked Time </th>
                                <th> Booked By</th>
                                <th> Price</th>
                                <th> Created At </th>
                                <th style="width:100px; min-width:100px;" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookedSlots as $key => $slot)
                                <tr>
                                    <td>{{ $slot->id }}</td>
                                    <td>{{ $slot->transaction_detail->id }}</td>
                                    {{-- <td>{{ $slot->mentor->id }}</td> --}}
                                    <td>{{ !empty($slot->mentor) ? $slot->mentor->name:'' }}</td>
                                    <td>{{ $slot->slot_details->date }} at {{ $slot->slot_details->time_shift }}</td>
                                    <td>{{ !empty($slot->users) ? $slot->users->name:'' }}</td>
                                    <td>{{ $slot->price }}</td>
                                    <td>{{ date("d-M-Y",strtotime($slot->created_at)) }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="javascript:void(0)" data-id="{{$slot['id']}}" class="sa-remove btn btn-sm btn-danger edit-btn"><i class="fa fa-trash"></i></a>
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
                window.location.href = "slot/"+mentorid+"/delete";
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
