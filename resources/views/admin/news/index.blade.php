@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="fixed-row">
    <div class="app-title">
        <div class="active-wrap">
            <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary pull-right">Add New</a>
    </div>
</div>
    @include('admin.partials.flash')
    <div class="row section-mg row-md-body no-nav">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover custom-data-table-style table-striped" id="sampleTable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th> Title </th>
                                <th> Image </th>
                                <th> Description </th>
                                <th> Status </th>
                                <th style="width:100px; min-width:100px;" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $key => $news)
                                <tr>
                                    <td>{{ $news->id }}</td>
                                    <td>{{ $news->title }}</td>
                                    <td>
                                        @if($news->image!='')
                                        <img style="width: 150px;height: 100px;" src="{{URL::to('/').'/news/'}}{{$news->image}}">
                                        @endif
                                    </td>
                                    <td>{!! $news->description !!}</td>
                                    <td class="text-center">
                                    <div class="toggle-button-cover margin-auto">
                                        <div class="button-cover">
                                            <div class="button-togglr b2" id="button-11">
                                                <input id="toggle-block" type="checkbox" name="status" class="checkbox" data-news_id="{{ $news['id'] }}" {{ $news['status'] == 1 ? 'checked' : '' }}>
                                                <div class="knobs"><span>Inactive</span></div>
                                                <div class="layer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="{{ route('admin.news.edit', $news['id']) }}" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-edit"></i></a>
                                        <a href="#" data-id="{{$news['id']}}" class="sa-remove btn btn-sm btn-danger edit-btn"><i class="fa fa-trash"></i></a>
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
            var newsid = $(this).data('id');
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
                    window.location.href = "news/"+newsid+"/delete";
                } else {
                    swal("Cancelled", "Record is safe", "error");
                }
            });
        });
        $('input[id="toggle-block"]').change(function() {
            var news_id = $(this).data('news_id');
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var check_status = 0;
            if($(this).is(":checked")){
                check_status = 1;
            }
            $.ajax({
                type:'POST',
                dataType:'JSON',
                url:"{{route('admin.news.updateStatus')}}",
                data:{ _token: CSRF_TOKEN, id:news_id, check_status:check_status},
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
    </script>
@endpush