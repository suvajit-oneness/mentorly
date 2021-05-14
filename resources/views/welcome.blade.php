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
            @for($logo = 1;$logo <= 5; $logo++ )
                <div class="logo-holder"><img src="{{asset('design/images/logo'.$logo.'.png')}}"></div>
            @endfor
            <div class="logo-holder"><img src="{{asset('design/images/logo3.png')}}"></div>
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
            <li>
                <div class="box">
                    <figure><img src="{{asset('design/images/expert.png')}}"></figure>
                    <figcaption>
                        <h3>Expert Mentors</h3>
                        <p>We've brought together the best mentors from finance, healthcare, consulting, and more, both big and small</p>
                    </figcaption>
                </div>
            </li>
            <li>
                <div class="box">
                    <figure><img src="{{asset('design/images/profile.png')}}"></figure>
                    <figcaption>
                        <h3>Verified Profiles</h3>
                        <p>We carefully check and confirm each mentor’s profile</p>
                    </figcaption>
                </div>
            </li>
            <li>
                <div class="box">
                    <figure><img src="{{asset('design/images/any-time.png')}}"></figure>
                    <figcaption>
                        <h3>Learn Anytime</h3>
                        <p>Take online lessons at the perfect time for your busy schedule</p>
                    </figcaption>
                </div>
            </li>
            <li>
                <div class="box">
                    <figure><img src="{{asset('design/images/price.png')}}"></figure>
                    <figcaption>
                        <h3>Affordable Prices</h3>
                        <p>Choose an experienced mentor that fits your budget.</p>
                    </figcaption>
                </div>
            </li>
        </ul>
    </div>
</section>

<section class="skill-section">
    <div class="container">
        <h2 class="page-heading">Focus on the skills you need</h2>
        <div class="shorten-place">
            <ul class="common-list">
                <li>Know how to answer those tricky behavioral questions</li>
                <li>Understand the company from the mentor who works or has worked there previously. </li>
                <li>Learn the right questions to ask. </li>
                <li>Understand what to study and how to approach the technical portion of the interview. </li>
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
            <div class="inner">
                <div class="prifile-content">
                    <h3>Belina</h3>
                    <span class="designation">Mastered 5 languages online on Preply</span>
                    <p>I was a very shy person in the beginning. After more than 160 hours of classes on Preply, learning languages has somehow made me feel more comfortable about myself.</p>
                    <a href="#" class="prinery-btm blue-btm">More Review</a>
                </div>
                <div class="profile-image" style="background: url(./design/images/mentor1.jpg) no-repeat center center; background-size: cover;"></div>
            </div>
            <div class="inner">
                <div class="prifile-content">
                    <h3>Gowoon S.</h3>
                    <span class="designation">Mastered 5 languages online on Preply</span>
                    <p>I was a very shy person in the beginning. After more than 160 hours of classes on Preply, learning languages has somehow made me feel more comfortable about myself.</p>
                    <a href="#" class="prinery-btm blue-btm">More Review</a>
                </div>
                <div class="profile-image" style="background: url(./design/images/mentor2.jpg) no-repeat center center; background-size: cover;"></div>
            </div>
            <div class="inner">
                <div class="prifile-content">
                    <h3>Yujing Z.</h3>
                    <span class="designation">Mastered 5 languages online on Preply</span>
                    <p>I was a very shy person in the beginning. After more than 160 hours of classes on Preply, learning languages has somehow made me feel more comfortable about myself.</p>
                    <a href="#" class="prinery-btm blue-btm">More Review</a>
                </div>
                <div class="profile-image" style="background: url(./design/images/mentor3.jpg) no-repeat center center; background-size: cover;"></div>
            </div>
        </div>
    </div>
</section>

<section class="skill-section">
    <div class="container">
        <h2 class="page-heading">How Mentorly works</h2>
        <ul class="work-list">
            <li>
                <div class="step-first">
                    <span>1</span>
                    <h3>
                        Find the mentor you like through our search engine.
                    </h3>
                </div>
                <div class="step-second">
                    <img src="{{asset('design/images/step1.png')}}">
                </div>
            </li>
            <li>
                <div class="step-first">
                    <span>2</span>
                    <h3>
                        Create an account and send info 
                    </h3>
                </div>
                <div class="step-second">
                    <img src="{{asset('design/images/step2.png')}}">
                </div>
            </li>
            <li>
                <div class="step-first">
                    <span>3</span>
                    <h3>
                        Set up interview time with mentor
                    </h3>
                </div>
                <div class="step-second">
                    <img src="{{asset('design/images/step3.png')}}">
                </div>
            </li>
            <li>
                <div class="step-first">
                    <span>4</span>
                    <h3>
                        Start interviewing  
                    </h3>
                </div>
                <div class="step-second">
                    <img src="{{asset('design/images/step4.png')}}">
                </div>
            </li>
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
            <li>
                <div class="box">
                    <figure><img src="{{asset('design/images/new-mentor.png')}}"></figure>
                    <figcaption>
                        <h3>Find new Mentees</h3>
                    </figcaption>
                </div>
            </li>
            <li>
                <div class="box">
                    <figure><img src="{{asset('design/images/grow-business.png')}}"></figure>
                    <figcaption>
                        <h3>Grow your business</h3>
                    </figcaption>
                </div>
            </li>
            <li>
                <div class="box">
                    <figure><img src="{{asset('design/images/paid-secure.png')}}"></figure>
                    <figcaption>
                        <h3>Get Paid Securely</h3>
                    </figcaption>
                </div>
            </li>
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