@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="fixed-row">
    <div class="app-title">
        <div class="active-wrap">
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
</div>
    @include('admin.partials.flash')
    <div class="row section-mg row-md-body no-nav">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('admin.faq.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">For Which Page <span class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control @error('forwhichpage') is-invalid @enderror" name="forwhichpage">
                                <option value="homepage" @if($targetFaq->forwhichpage == 'homepage') {{('selected')}} @endif>Home Page</option>
                                <option value="becomeonmentor" @if($targetFaq->forwhichpage == 'becomeonmentor') {{('selected')}} @endif>Become a Mentor Page</option>
                            </select>
                            @error('forwhichpage') {{ $message ?? '' }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="name">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('name', $targetFaq->title) }}"/>
                            <input type="hidden" name="id" value="{{ $targetFaq->id }}">
                            @error('title') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="name">Description <span class="m-l-5 text-danger"> *</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" type="text" name="description" id="description" >{{ old('name', $targetFaq->description) }}</textarea>
                        @error('description') {{ $message ?? '' }} @enderror
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update FAQ</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.faq.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection