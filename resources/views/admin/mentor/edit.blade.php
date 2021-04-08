@extends('admin.app')
@section('title') {{ ('Edit Mentor') }} @endsection
@section('content')
<div class="fixed-row">
    <div class="app-title">
        <div class="active-wrap">
            <h1><i class="fa fa-file"></i> {{ ('Edit Mentor') }}</h1>
            <p>{{ ('Edit Mentor') }}</p>
        </div>
        <!-- <a href="" class="btn btn-primary pull-right">Add New</a> -->
    </div>
</div>
    @include('admin.partials.flash')
    <div class="row section-mg row-md-body no-nav">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <a href="{{route('admin.mentor.index')}}" class="float-right">Back</a>
                    <form method="post" action="{{route('admin.mentor.update',$mentor->id)}}">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" placeholder="Name of the Mentor" class="form-control" required="" value="@if(old('name')){{old('name')}}@else{{$mentor->name}}@endif">
                            @error('name')<span class="text-danger">{{$message}}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="Email of the Mentor" class="form-control" required="" value="@if(old('email')){{old('email')}}@else{{$mentor->email}}@endif">
                            @error('email')<span class="text-danger">{{$message}}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" name="mobile" placeholder="Mobile of the Mentor" class="form-control" required="" value="@if(old('mobile')){{old('mobile')}}@else{{$mentor->mobile}}@endif">
                            @error('mobile')<span class="text-danger">{{$message}}</span>@enderror
                        </div>

                        <input type="submit" name="" value="Update" class="btn">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript"></script>
@endpush