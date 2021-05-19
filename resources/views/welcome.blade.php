@extends('layouts.master')
@section('title','Welcome')
@section('content')
<section class="banner" style="background: url('./design/images/banner-image.jpg') no-repeat center center; background-size: cover;">
    <div class="container">
        <div class="banner-caption ">
            <h1>Get the job you always wanted with the best mentors.</h1>
            <div class="search-place">
                <input type="text" name="search" id="exploreInput" placeholder="Search by mentor, company, industry, seniority">
                <input type="submit" id="exploreBtn" value="Explore" style="display: none;">
            </div>
        </div>
    </div>
</section>

<section class="logo-slider-area">
    <div class="container logo-section">
        <h2>Where our mentor’s work at</h2>
        <div class="logo-slider">
            @foreach($data->whereourmentor_work as $key => $work)
                <div class="logo-holder"><img src="{{asset($work->icon)}}"></div>
            @endforeach
        </div>
    </div>
</section>

<section class="wedo-section">
    <div class="container">
        <h2 class="page-heading">What we do</h2>
        <div class="short-content-place">
            <p>
                Mentorly is an interview advisory network that connects you to the mentor you need to ace that interview and land that next job you always wanted no matter the industry, seniority, or the company
            </p>
        </div>
        <ul class="wedo-list">
            @foreach($data->whatwedo as $key => $whatwedo)
                <li>
                    <div class="box">
                        <figure><img src="{{asset($whatwedo->icon)}}"></figure>
                        <figcaption>
                            <h3>{{$whatwedo->title}}</h3>
                            <p>{!! $whatwedo->description !!}</p>
                        </figcaption>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</section>

<section class="skill-section">
    <div class="container">
        <h2 class="page-heading">Focus on the skills you need</h2>
        <div class="shorten-place">
            <ul class="common-list">
                @foreach($data->focusonSkill as $key => $skill)
                    <li>{!! $skill->description !!}</li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

<section class="wedo-section">
    <div class="container">
        <h2 class="page-heading">Our Success Stories</h2>
        <div class="short-content-place">
            <p>Our mentors have helped thousands of people land that next job. </p>
        </div>
        <div class="profile-slider">
            @foreach($data->story as $key => $story)
                <div class="inner">
                    <div class="prifile-content">
                        <h3>{{$story->title}}</h3>
                        <span class="designation">{{$story->designation}}</span>
                        <p>{!! $story->description !!}</p>
                        <a href="#" class="prinery-btm blue-btm">More Review</a>
                    </div>
                    <div class="profile-image" style="background: url({{asset($story->media)}}) no-repeat center center; background-size: cover;"></div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="skill-section">
    <div class="container">
        <h2 class="page-heading">How Mentorly works</h2>
        <ul class="work-list">
            @foreach($data->howmentory_works as $key => $howitwork)
                <li>
                    <div class="step-first">
                        <span>{{$howitwork->title}}</span>
                        <h3>{!! $howitwork->description !!}</h3>
                    </div>
                    <div class="step-second">
                        <img src="{{asset($howitwork->media)}}">
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</section>

<section class="wedo-section">
    <div class="container">
        <h2 class="page-heading">Become a mentor</h2>
        <div class="short-content-place">
            <p>Earn money sharing your expert knowledge with mentees. Sign up to start mentoring online with MentorMatch</p>
        </div>
        <ul class="wedo-list become-mentor">
            @foreach($data->becomeMentor as $key => $becomMentorSteps)
                <li>
                    <div class="box">
                        <figure><img src="{{asset($becomMentorSteps->media)}}"></figure>
                        <figcaption>
                            <h3>{{$becomMentorSteps->title}}</h3>
                        </figcaption>
                    </div>
                </li>
            @endforeach
        </ul>
        @if(get_guard() == '' || get_guard() != 'mentor')
            <a href="{{route('singup.mentor')}}" class="prinery-btm blue-btm">Becoming a mentor</a>
        @endif
    </div>
</section>

<section class="white-section">
    <div class="container">
        <h2 class="page-heading">Most common questions</h2>
        <div class="faq-place">
            @foreach($data->faq as $key => $faqs)
                <div class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle @if($key == 0){{('dropdown-active')}}@endif">
                        <span class="caret minus faq-minus"><img src="{{asset('design/images/minus.png')}}"></span>
                        <span class="caret plus faq-plus"><img src="{{asset('design/images/plus.png')}}"></span> 
                        {{$faqs->title}}
                    </a>
                    <div class="dropdown-inner @if($key == 0){{('open')}}@endif">
                        <p>{!! $faqs->description !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@section('script')
    <script type="text/javascript">
        // logo slider
        $('.logo-slider').slick({
          centerMode: false,
          centerPadding: '60px',
          slidesToShow: 5,
          arrows:true,
          nextArrow: '<span class="next"><img src="design/images/next-arrow.png"></span>',
          prevArrow: '<span class="pre"><img src="design/images/pre-arrow.png"></span>',
          responsive: [
            {
              breakpoint: 768,
              settings: {
                arrows: true,
                centerMode: true,
                centerPadding: '10px',
                slidesToShow: 3
              }
            },
            {
              breakpoint: 480,
              settings: {
                arrows: true,
                centerMode: true,
                centerPadding: '10px',
                slidesToShow: 1
              }
            }
          ]
        });

        // success story slider
        $('.profile-slider').slick({
          centerMode: false,
          centerPadding: '30px',
          slidesToShow:1,
          arrows:true,
          dots: true,
          speed: 300,
          nextArrow: '<span class="next-arrow"><img src="design/images/next-arrow-white.png"></span>',
          prevArrow: '<span class="pre-arrow"><img src="design/images/pre-arrow-white.png"></span>'
        });

        var keyword = $('#exploreInput').val();
        if(keyword == ''){$('#exploreBtn').hide();}
        else{$('#exploreBtn').show();}
        
        $(document).on('keyup','#exploreInput',function(){
            keyword = $(this).val();
            if(keyword == ''){$('#exploreBtn').hide();}
            else{$('#exploreBtn').show();}
        });
        $(document).on('click','#exploreBtn',function(){
            if(keyword == ''){}
            else{
                dataRetriving();
            }
        });

        function dataRetriving() {
            var originalURL = "{{url('find/mentors')}}?";
            if(keyword != ''){
                originalURL += 'keyword='+keyword+'&';
            }
            originalURL = originalURL.substring(0, originalURL.length-1); // removing last character from String
            window.location.href = originalURL;
        }
    </script>
@stop
@endsection