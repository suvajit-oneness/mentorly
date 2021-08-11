@extends('admin.app')
@section('title') Add Job @endsection
@section('content')
<div class="fixed-row">
    <div class="app-title">
        <div class="active-wrap">
            <h1><i class="fa fa-file"></i> Add Job</h1>
            <a href="{{route('admin.job.detail.index')}}" class="btn btn-primary pull-right AddNewJobCategory">Back</a>
        </div>
    </div>
</div>
    @include('admin.partials.flash')
    <div class="row section-mg row-md-body no-nav">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <div class="tile-body">
                    <form action="{{ route('admin.job.detail.store') }}" method="POST" role="form">
                        @csrf
                        <div class="tile-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="name">Job Type <span class="m-l-5 text-danger"> *</span></label>
                                    <select class="form-control @error('jobTypeId') is-invalid @enderror" name="jobTypeId" id="jobTypeId">
                                        <option value="" hidden>-Select-</option>
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                    @error('jobTypeId') {{ $message ?? '' }} @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="name">Valid Till <span class="m-l-5 text-danger"> *</span></label>
                                    <input class="form-control @error('valid_till') is-invalid @enderror" type="date" name="valid_till" id="valid_till" value="{{ old('valid_till') }}"/>
                                    @error('valid_till') {{ $message ?? '' }} @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Job Name<span class="m-l-5 text-danger"> *</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name"/>
                                @error('name') {{ $message }} @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Location <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('location') is-invalid @enderror" type="text" name="location" id="location" value="{{ old('location') }}"/>
                            @error('location') {{ $message ?? '' }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Description <span class="m-l-5 text-danger"> *</span></label>
                            <textarea name="description">{{ old('description') }}</textarea>
                            @error('description') {{ $message ?? '' }} @enderror
                        </div>
                        
                        <div class="tile-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Job</button>
                            &nbsp;&nbsp;&nbsp;
                            <a class="btn btn-secondary" href="{{ route('admin.job.detail.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                        </div>
                    </form>
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
