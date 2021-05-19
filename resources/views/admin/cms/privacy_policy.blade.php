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
                            @case('focus_ontheskill_you_need')
                                <h3>Privacy Policy</h3>
                                <div class="form-group">
                                    <label class="control-label" for="description">Description <span class="m-l-5 text-danger"> *</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Description">{{ old('description') ? old('description') : (($data) ? $data->description : '') }}</textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
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