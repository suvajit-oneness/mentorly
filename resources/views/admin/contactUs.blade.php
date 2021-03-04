@extends('admin.app')
@section('title') Contact Us @endsection
@section('content')
	
<div class="fixed-row">
    <div class="app-title">
        <div class="active-wrap">
            <h1><i class="fa fa-tags"></i> Contact Us</h1>
        </div>
    </div>
</div>
@include('admin.partials.flash')
<div class="row section-mg row-md-body no-nav">
    <div class="col-md-8 mx-auto">
        <div class="tile">
            <h3 class="tile-title">Contact Us</h3>
            <hr>
            <form action="{{ route('admin.contactus.store') }}" method="POST" role="form" enctype="multipart/form-data">
                @csrf
                @error('success')<span class="text-success">{{$message}}</span>@enderror
                <input type="hidden" name="contactUsId" value="{{$contact->id}}">
                <div class="form-group">
                	<label class="control-label" for="title">Title</label>
                	<input type="text" name="title" id="title" class="form-control @error('title'){{'is-invalid'}}@enderror" placeholder="Title" value="@if(old('title')){{old('title')}}@else{{$contact->title}}@endif">
                	@error('title')<span class="text-danger">{{$message}}</span>@enderror
                </div>

                <div class="form-group">
                	<label class="control-label" for="mobile">Contact No.</label>
                	<input type="text" name="mobile" id="mobile" class="form-control @error('mobile'){{'is-invalid'}}@enderror" placeholder="Contact No." value="@if(old('mobile')){{old('mobile')}}@else{{$contact->mobile}}@endif">
                	@error('mobile')<span class="text-danger">{{$message}}</span>@enderror
                </div>

                <div class="form-group">
                	<label class="control-label" for="email">Email.</label>
                	<input type="email" name="email" id="email" class="form-control @error('email'){{'is-invalid'}}@enderror" placeholder="Email Id." value="@if(old('email')){{old('email')}}@else{{$contact->email}}@endif">
                	@error('email')<span class="text-danger">{{$message}}</span>@enderror
                </div>

                <div class="form-group">
                	<label class="control-label" for="address">Address</label>
                	<textarea name="address" id="address" class="form-control @error('address'){{'is-invalid'}}@enderror" placeholder="Address">@if(old('address')){{old('address')}}@else{{$contact->address}}@endif</textarea>
                	@error('address')<span class="text-danger">{{$message}}</span>@enderror
                </div>

                <div class="form-group">
                	<label class="control-label" for="twitterLink">Twitter Link.</label>
                	<input type="url" name="twitterLink" id="twitterLink" class="form-control @error('twitterLink'){{'is-invalid'}}@enderror" placeholder="Twitter Link." value="@if(old('twitterLink')){{old('twitterLink')}}@else{{$contact->twitterLink}}@endif">
                	@error('twitterLink')<span class="text-danger">{{$message}}</span>@enderror
                </div>

                <div class="form-group">
                	<label class="control-label" for="facebookLink">Facebook Link.</label>
                	<input type="url" name="facebookLink" id="facebookLink" class="form-control @error('facebookLink'){{'is-invalid'}}@enderror" placeholder="Facebook Link." value="@if(old('facebookLink')){{old('facebookLink')}}@else{{$contact->facebookLink}}@endif">
                	@error('facebookLink')<span class="text-danger">{{$message}}</span>@enderror
                </div>

                <div class="form-group">
                	<label class="control-label" for="instagramLink">Instagram Link.</label>
                	<input type="url" name="instagramLink" id="instagramLink" class="form-control @error('instagramLink'){{'is-invalid'}}@enderror" placeholder="Instagram Link." value="@if(old('instagramLink')){{old('instagramLink')}}@else{{$contact->instagramLink}}@endif">
                	@error('instagramLink')<span class="text-danger">{{$message}}</span>@enderror
                </div>

                <div class="form-group">
                	<label class="control-label" for="linkedinLink">LinkedIn Link.</label>
                	<input type="url" name="linkedinLink" id="linkedinLink" class="form-control @error('linkedinLink'){{'is-invalid'}}@enderror" placeholder="LinkedIn Link." value="@if(old('linkedinLink')){{old('linkedinLink')}}@else{{$contact->linkedinLink}}@endif">
                	@error('linkedinLink')<span class="text-danger">{{$message}}</span>@enderror
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                    &nbsp;&nbsp;&nbsp;
                    <a class="btn btn-secondary" href="{{ route('admin.contactus.show') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection