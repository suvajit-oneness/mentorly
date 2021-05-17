@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="fixed-row">
    <div class="app-title">
        <div class="active-wrap">
            <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
    </div>
</div>
    @include('admin.partials.flash')
    <div class="row section-mg row-md-body no-nav">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <caption><h3>Where our mentor’s work at <a href="{{route('admin.cms.homepage.add','where_our_mentor_work_at')}}" class="float-right btn">Add New</a></h3></caption><br>
                    <table class="table table-hover custom-data-table-style table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($setting->get_data('where_our_mentor_work_at') as $key => $whereWork)
                                <tr>
                                    <td><img src="{{asset($whereWork->icon)}}" height="50" width="100"></td>
                                    <td><a href="{{route('admin.cms.homepage.edit',[$whereWork->id,'where_our_mentor_work_at'])}}" class="text-success">Edit</a> | <a href="javascript:void(0)" class="text-danger delete" data-id="{{$whereWork->id}}" data-key="{{$whereWork->key}}">Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="tile">
                <div class="tile-body">
                    <caption><h3>What We Do <a href="{{route('admin.cms.homepage.add','what_we_do')}}" class="float-right btn">Add New</a></h3></caption><br>
                    <table class="table table-hover custom-data-table-style table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($setting->get_data('what_we_do') as $key => $whatwedo)
                                <tr>
                                    <td><img src="{{asset($whatwedo->icon)}}" height="50" width="100"></td>
                                    <td>{!! $whatwedo->title !!}</td>
                                    <td>{!! $whatwedo->description !!}</td>
                                    <td><a href="{{route('admin.cms.homepage.edit',[$whatwedo->id,'what_we_do'])}}" class="text-success">Edit</a> | <a href="javascript:void(0)" class="text-danger delete" data-id="{{$whatwedo->id}}" data-key="{{$whatwedo->key}}">Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>
            <div class="tile">
                <div class="tile-body">
                    <caption><h3>Focus On The Skill You Need <a href="{{route('admin.cms.homepage.add','focus_ontheskill_you_need')}}" class="float-right btn">Add New</a></h3></caption><br>
                    <table class="table table-hover custom-data-table-style table-striped">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($setting->get_data('focus_ontheskill_you_need') as $key => $focus_ontheskill_you_need)
                                <tr>
                                    <td>{!! $focus_ontheskill_you_need->description !!}</td>
                                    <td><a href="{{route('admin.cms.homepage.edit',[$focus_ontheskill_you_need->id,'focus_ontheskill_you_need'])}}" class="text-success">Edit</a> | <a href="javascript:void(0)" class="text-danger delete" data-id="{{$focus_ontheskill_you_need->id}}" data-key="{{$focus_ontheskill_you_need->key}}">Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>
            <div class="tile">
                <div class="tile-body">
                    <caption><h3>Our Sucess Story <a href="{{route('admin.cms.homepage.add','our_sucess_story')}}" class="float-right btn">Add New</a></h3></caption><br>
                    <table class="table table-hover custom-data-table-style table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($setting->get_data('our_sucess_story') as $key => $our_sucess_story)
                                <tr>
                                    <td><img src="{{asset($our_sucess_story->media)}}" height="50" width="100"></td>
                                    <td>{!! $our_sucess_story->title !!}</td>
                                    <td>{!! $our_sucess_story->designation !!}</td>
                                    <td>{!! $our_sucess_story->description !!}</td>
                                    <td><a href="{{route('admin.cms.homepage.edit',[$our_sucess_story->id,'our_sucess_story'])}}" class="text-success">Edit</a> | <a href="javascript:void(0)" class="text-danger delete" data-id="{{$our_sucess_story->id}}" data-key="{{$our_sucess_story->key}}">Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>
            <div class="tile">
                <div class="tile-body">
                    <caption><h3>How Mentory Works <a href="{{route('admin.cms.homepage.add','how_mentory_works')}}" class="float-right btn">Add New</a></h3></caption><br>
                    <table class="table table-hover custom-data-table-style table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>SL No.</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($setting->get_data('how_mentory_works') as $key => $how_mentory_works)
                                <tr>
                                    <td><img src="{{asset($how_mentory_works->media)}}" height="50" width="100"></td>
                                    <td>{!! $how_mentory_works->title !!}</td>
                                    <td>{!! $how_mentory_works->description !!}</td>
                                    <td><a href="{{route('admin.cms.homepage.edit',[$how_mentory_works->id,'how_mentory_works'])}}" class="text-success">Edit</a> | <a href="javascript:void(0)" class="text-danger delete" data-id="{{$how_mentory_works->id}}" data-key="{{$how_mentory_works->key}}">Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>
            <div class="tile">
                <div class="tile-body">
                    <caption><h3>Become Mentor <a href="{{route('admin.cms.homepage.add','become_mentor_home_page')}}" class="float-right btn">Add New</a></h3></caption><br>
                    <table class="table table-hover custom-data-table-style table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($setting->get_data('become_mentor_home_page') as $key => $become_mentor_home_page)
                                <tr>
                                    <td><img src="{{asset($become_mentor_home_page->media)}}" height="50" width="100"></td>
                                    <td>{!! $become_mentor_home_page->title !!}</td>
                                    <td><a href="{{route('admin.cms.homepage.edit',[$become_mentor_home_page->id,'become_mentor_home_page'])}}" class="text-success">Edit</a> | <a href="javascript:void(0)" class="text-danger delete" data-id="{{$become_mentor_home_page->id}}" data-key="{{$become_mentor_home_page->key}}">Delete</a></td>
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
    <script type="text/javascript">
        $(document).on('click','.delete',function(){
            var thisClicked = $(this);
            var key = $(this).attr('data-key'),id = $(this).attr('data-id');
            $.ajax({
                url : "{{route('admin.cms.homepage.delete')}}",
                type: 'post',
                data : {key : key, id:id,_token:'{{csrf_token()}}'},
                success:function(data){
                    console.log(data);
                    if(data.error == false){
                        thisClicked.closest('tr').remove();
                        swal('success',data.message);
                    }else{
                        swal('error',data.message);
                    }
                }
            });
        });
    </script>
@endpush