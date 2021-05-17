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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" enctype="multipart/form-data" action="{{route('admin.csm.homepage.saveorupdate',$key)}}">
                        @csrf
                        <input type="hidden" name="key" value="{{$key}}">
                        <input type="hidden" name="task" value="{{$task}}">
                        @if(!empty($data))
                            <input type="hidden" name="id" value="{{$data->id}}">
                        @endif
                        @switch($key)
                            @case('where_our_mentor_work_at')
                                <h3>Where Our Mentor Work At <span>( {{strtoupper($task)}} )</span></h3>
                                @if(!empty($data))
                                    <img src="{{asset($data->icon)}}" height="100" width="200">
                                @endif
                                <div class="form-group">
                                    <label class="control-label">Icon</label>
                                    <input class="form-control @error('icon') is-invalid @enderror" type="file" id="icon" name="icon" @if(empty($data)) required @endif/>
                                    @error('icon') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            @break
                            @case('what_we_do')
                                <h3>What We Do <span>( {{strtoupper($task)}} )</span></h3>
                                @if(!empty($data))
                                    <img src="{{asset($data->icon)}}" height="100" width="200">
                                @endif
                                <div class="form-group">
                                    <label class="control-label">Icon</label>
                                    <input class="form-control @error('icon') is-invalid @enderror" type="file" id="icon" name="icon" @if(empty($data)) required @endif />
                                    @error('icon') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="name">Title <span class="m-l-5 text-danger"> *</span></label>
                                    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') ? old('title') : (($data) ? $data->title : '') }}" placeholder="Title" required="">
                                    @error('title') <span class="text-danger">{{ $message ?? '' }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="description">Description <span class="m-l-5 text-danger"> *</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Description">{{ old('description') ? old('description') : (($data) ? $data->description : '') }}</textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            @break
                            @case('focus_ontheskill_you_need')
                                <h3>Focus On The Skill You Need <span>( {{strtoupper($task)}} )</span></h3>
                                <div class="form-group">
                                    <label class="control-label" for="description">Description <span class="m-l-5 text-danger"> *</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Description">{{ old('description') ? old('description') : (($data) ? $data->description : '') }}</textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            @break
                            @case('our_sucess_story')
                                <h3>Our Sucess Story <span>( {{strtoupper($task)}} )</span></h3>
                                @if(!empty($data))
                                    <img src="{{asset($data->media)}}" height="100" width="200">
                                @endif
                                <div class="form-group">
                                    <label class="control-label">Image</label>
                                    <input class="form-control @error('media') is-invalid @enderror" type="file" id="media" name="media" @if(empty($data)) required @endif />
                                    @error('media') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="name">Name <span class="m-l-5 text-danger"> *</span></label>
                                    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') ? old('title') : (($data) ? $data->title : '') }}" placeholder="Title" required="">
                                    @error('title') <span class="text-danger">{{ $message ?? '' }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="designation">Designation <span class="m-l-5 text-danger"> *</span></label>
                                    <input class="form-control @error('designation') is-invalid @enderror" type="text" name="designation" id="designation" value="{{ old('designation') ? old('designation') : (($data) ? $data->designation : '') }}" placeholder="Designation" required="">
                                    @error('designation') <span class="text-danger">{{ $message ?? '' }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="description">Description <span class="m-l-5 text-danger"> *</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Description">{{ old('description') ? old('description') : (($data) ? $data->description : '') }}</textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            @break
                            @case('how_mentory_works')
                                <h3>How Mentory Works <span>( {{strtoupper($task)}} )</span></h3>
                                @if(!empty($data))
                                    <img src="{{asset($data->media)}}" height="100" width="200">
                                @endif
                                <div class="form-group">
                                    <label class="control-label">Image</label>
                                    <input class="form-control @error('media') is-invalid @enderror" type="file" id="media" name="media" @if(empty($data)) required @endif />
                                    @error('media') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="name">Sl no <span class="m-l-5 text-danger"> *</span></label>
                                    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{old('title') ? old('title') : (($data) ? $data->title : '')}}" placeholder="Title" required="">
                                    @error('title') <span class="text-danger">{{ $message ?? '' }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="description">Description <span class="m-l-5 text-danger"> *</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Description">{{old('description') ? old('description') : (($data) ? $data->description : '')}}</textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            @break
                            @case('become_mentor_home_page')
                                <h3>Become Mentor <span>( {{strtoupper($task)}} )</span></h3>
                                @if(!empty($data))
                                    <img src="{{asset($data->media)}}" height="100" width="200">
                                @endif
                                <div class="form-group">
                                    <label class="control-label">Image</label>
                                    <input class="form-control @error('media') is-invalid @enderror" type="file" id="media" name="media" @if(empty($data)) required @endif />
                                    @error('media') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="name">Title <span class="m-l-5 text-danger"> *</span></label>
                                    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{old('title') ? old('title') : (($data) ? $data->title : '')}}" placeholder="Title" required="">
                                    @error('title') <span class="text-danger">{{ $message ?? '' }}</span> @enderror
                                </div>
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