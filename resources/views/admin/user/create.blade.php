@extends('admin.app')
@section('title') {{ ('Add User') }} @endsection
@section('content')
<div class="fixed-row">
    <div class="app-title">
        <div class="active-wrap">
            <h1><i class="fa fa-file"></i> {{ ('Add User') }}</h1>
            <p>{{ ('Add New User') }}</p>
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
                    <form method="post" action="{{route('admin.user.save')}}">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" placeholder="Name of the User" class="form-control" required="" value="{{old('name')}}">
                            @error('name')<span class="text-danger">{{$message}}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="Email of the User" class="form-control" required="" value="{{old('email')}}">
                            @error('email')<span class="text-danger">{{$message}}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" name="mobile" placeholder="Mobile of the User" class="form-control" required="" value="{{old('mobile')}}">
                            @error('mobile')<span class="text-danger">{{$message}}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Password" class="form-control" required>
                            @error('password')<span class="text-danger">{{$message}}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control" required>
                        </div>

                        <input type="submit" name="" value="Create" class="btn">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript"></script>
@endpush