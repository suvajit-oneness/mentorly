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
                    <form method="post" enctype="multipart/form-data" action="{{route('admin.csm.homepage.save',$key)}}">
                        @csrf
                        <input type="hidden" name="key" value="{{$key}}">
                        <input type="hidden" name="task" value="{{$task}}">
                        @switch($key)
                            @case('where_our_mentor_work_at')
                                <h1>where_our_mentor_work_at</h1>
                            @break
                            @case('what_we_do')
                                <h1>what_we_do</h1>
                            @break
                            @case('focus_ontheskill_you_need')
                                <h1>focus_ontheskill_you_need</h1>
                            @break
                            @case('our_sucess_story')
                                <h1>our_sucess_story</h1>
                            @break
                            @case('how_mentory_works')
                                <h1>how_mentory_works</h1>
                            @break
                            @case('become_mentor_home_page')
                                <h1>become_mentor_home_page</h1>
                            @break
                            @default
                        @endswitch
                        <input type="submit" name="">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript"></script>
@endpush