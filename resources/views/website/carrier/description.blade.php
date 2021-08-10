@extends('layouts.master')
@section('title','Explore career opportunity with us')
@section('content')
	<section class="JDtext text-center">
        <div class="container">
            <h4>{{$job->name}}</h4>
            <span>REMOTE</span>
            <p>{{$job->location}}</p>
        </div>
    </section>
    <section class="JDtabs">
        <ul>
            <li class="active" id="overviewBTN" onclick="overview()">OVERVIEW</li>
            <li id="applicationBTN" onclick="application()">APPLICATION</li>
        </ul>
    </section>

    <section class="JobDetails">
        <div class="container">
            <div id="overview">
            
                <div class="descriptionHeading">
                    <h6>Description</h6>
                    <!-- <a href="#"> <i class="fab fa-share-alt"></i> Share this job</a> -->
                </div>
                
                {!! $job->description !!}
                
                <div class="descriptionHeading">
                    <h6>Requirements</h6>
                </div>
    
                <ul>
                    @foreach($job->requirement as $req)
                        <li>{{$req->name}}</li>
                    @endforeach
                </ul>
            </div>


            <div id="application" class="d-none">
                <p class="required">Required</p>
                <form action="{{route('carrier.job.application.post',$job->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="personalDetails">
                        <h5>Personal Information</h5>
                        <button type="reset" class="clear">Clear</button>
                    </div>
                    <div class="nameSec">
                        <input type="hidden" name="jobId" value="{{$job->id}}">
                        @error('jobId')<span class="text-danger">{{$message}}</span>@enderror
                        <div class="name">
                            <label for="fname" class="required">First Name</label>
                            <input type="text" name="first_name" placeholder="First Name" required value="{{old('first_name')}}">
                            @error('first_name')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="name">
                            <label for="lname" class="required">Last Name</label>
                            <input type="text" placeholder="Last Name" name="last_name" required value="{{old('last_name')}}">
                            @error('last_name')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <label for="email" class="required">Email</label>
                    <input type="email" placeholder="Email" name="email" required value="{{old('email')}}">
                    @error('email')<span class="text-danger">{{$message}}</span>@enderror

                    <label for="pnum" class="required">Phone Number</label>
                    <input type="text" placeholder="Phone Number" name="phone_number" required value="{{old('phone_number')}}" onkeypress="return isNumberKey(event);" maxlength="10">
                    @error('phone_number')<span class="text-danger">{{$message}}</span>@enderror

                    <label for="resume" class="required">Upload Your Resume</label>
                    <input type="file" name="resume" required>
                    @error('resume')<span class="text-danger">{{$message}}</span>@enderror

                    <div class="applicationSubmit">
                        <button type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@section('script')
	<script type="text/javascript">
        $(document).ready(function(){
            @if($errors->any())
                application();
            @endif
        });
        function application() {
            var applicationSection = document.getElementById('application');
            var overviewSection = document.getElementById('overview');
            var applicationBTN = document.getElementById('applicationBTN')
            var overviewBTN = document.getElementById('overviewBTN')
            applicationSection.classList.remove('d-none')
            overviewSection.classList.add('d-none')
            applicationBTN.classList.add('active')
            overviewBTN.classList.remove('active')
        }
        
        function overview() {
            var applicationSection = document.getElementById('application');
            var overviewSection = document.getElementById('overview');
            var applicationBTN = document.getElementById('applicationBTN')
            var overviewBTN = document.getElementById('overviewBTN')
            applicationSection.classList.add('d-none')
            overviewSection.classList.remove('d-none')
            applicationBTN.classList.remove('active')
            overviewBTN.classList.add('active')
        }
    </script>
@stop
@endsection