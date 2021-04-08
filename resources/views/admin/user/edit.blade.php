@extends('admin.app')
@section('title') {{ ('Edit Mentee') }} @endsection
@section('content')
<div class="fixed-row">
    <div class="app-title">
        <div class="active-wrap">
            <h1><i class="fa fa-file"></i> {{ ('Edit Mentee') }}</h1>
            <p>{{ ('Edit Mentee') }}</p>
        </div>
        <!-- <a href="" class="btn btn-primary pull-right">Add New</a> -->
    </div>
</div>
    @include('admin.partials.flash')
    <div class="row section-mg row-md-body no-nav">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <a href="{{route('admin.user.index')}}" class="float-right">Back</a>
                    <form method="post" action="{{route('admin.user.update',$user->id)}}">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" placeholder="Name of the Mentee" class="form-control" required="" value="@if(old('name')){{old('name')}}@else{{$user->name}}@endif">
                            @error('name')<span class="text-danger">{{$message}}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="Email of the Mentee" class="form-control" required="" value="@if(old('email')){{old('email')}}@else{{$user->email}}@endif">
                            @error('email')<span class="text-danger">{{$message}}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" name="mobile" placeholder="Mobile of the Mentee" class="form-control" required="" value="@if(old('mobile')){{old('mobile')}}@else{{$user->mobile}}@endif">
                            @error('mobile')<span class="text-danger">{{$user}}</span>@enderror
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