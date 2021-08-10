@extends('layouts.master')
@section('title','Explore career opportunity with us')
@section('content')
	<section class="careerBanner">
        <div class="container">
            <div class="banner-caption">
                <h1>Career Opportunities</h1>
                <h3>Help us make the world of recruiting a bit easier for everyone.</h3>
            </div>
        </div>
    </section>

    <section class="careers">
        <div class="container">
            <div class="careerTxt">
                <h2>Startup in High Growth Mode</h2>
                <p>MentorMatch is an interview advisory firm looking make the world of interviewing a little bit easier
                    for
                    everyone. By leveraging our vast database, mentees can find the mentor to help them get the job they
                    always wanted at a price that is less than competitors and speaking to a person who knows exactly
                    how to
                    help.
                </p>
            </div>
			
            <div class="vacancyList">
            	@if(count($jobType) > 0)
	            	@foreach($jobType as $index => $type)
		            	@php $jobData = $type->job_details; @endphp
		            	@if(count($jobData) > 0)
			            	<h4>{{$type->title}}</h4>
			            	<ul>
			            		@foreach($jobData as $key => $job)
				                    <li><a href="{{route('carrier.description',encrypt($job->id))}}">{{$job->name}} (Posted at {{date('d M, Y',strtotime($job->created_at))}})</a></li>
			                    @endforeach
			                </ul>
		            	@endif
		            @endforeach
	            @else
		            <h4>No Vacancy</h4>
	            @endif
            </div>
        </div>
    </section>
@section('script')
	<script type="text/javascript"></script>
@stop
@endsection