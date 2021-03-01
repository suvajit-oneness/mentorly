@extends('layouts.master')
@section('title','Welcome')
@section('content')
<section class="banner" style="background: url('./images/banner-image.jpg') no-repeat center center; background-size: cover;">
    <div class="container">
        <div class="banner-caption ">
            <h1>Get the job you always wanted with the best mentors.</h1>
            <div class="search-place">
                <input type="text" name="search" id="" placeholder="Search by mentor, company, industry, seniority">
                <input type="submit" id="" value="Explore">
            </div>
        </div>
    </div>
</section>

<section class="logo-slider-area">
    <div class="container logo-section">
        <h2>Where our mentor’s work at</h2>
        <div class="logo-slider">
            <div class="logo-holder"><img src="{{asset('design/images/logo1.png')}}"></div>
            <div class="logo-holder"><img src="{{asset('design/images/logo2.png')}}"></div>
            <div class="logo-holder"><img src="{{asset('design/images/logo3.png')}}"></div>
            <div class="logo-holder"><img src="{{asset('design/images/logo4.png')}}"></div>
            <div class="logo-holder"><img src="{{asset('design/images/logo5.png')}}"></div>
            <div class="logo-holder"><img src="{{asset('design/images/logo1.png')}}"></div>
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
                <div class="profile-image" style="background: url(./images/mentor1.jpg) no-repeat center center; background-size: cover;"></div>
            </div>
            <div class="inner">
                <div class="prifile-content">
                    <h3>Gowoon S.</h3>
                    <span class="designation">Mastered 5 languages online on Preply</span>
                    <p>I was a very shy person in the beginning. After more than 160 hours of classes on Preply, learning languages has somehow made me feel more comfortable about myself.</p>
                    <a href="#" class="prinery-btm blue-btm">More Review</a>
                </div>
                <div class="profile-image" style="background: url(./images/mentor2.jpg) no-repeat center center; background-size: cover;"></div>
            </div>
            <div class="inner">
                <div class="prifile-content">
                    <h3>Yujing Z.</h3>
                    <span class="designation">Mastered 5 languages online on Preply</span>
                    <p>I was a very shy person in the beginning. After more than 160 hours of classes on Preply, learning languages has somehow made me feel more comfortable about myself.</p>
                    <a href="#" class="prinery-btm blue-btm">More Review</a>
                </div>
                <div class="profile-image" style="background: url(./images/mentor3.jpg) no-repeat center center; background-size: cover;"></div>
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
        <a href="#" class="prinery-btm blue-btm">Becoming a mentor</a>
    </div>
</section>

<section class="white-section">
    <div class="container">
        <h2 class="page-heading">Most common questions</h2>
        <div class="faq-place">
            <div class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle dropdown-active">
                    <span class="caret minus"><img src="{{asset('design/images/minus.png')}}"></span>
                    <span class="caret plus"><img src="{{asset('design/images/plus.png')}}"></span> 
                    When should I start? 
                </a>
                <div class="dropdown-inner open">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
            </div>

            <div class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle">
                    <span class="caret minus"><img src="{{asset('design/images/minus.png')}}"></span>
                    <span class="caret plus"><img src="{{asset('design/images/plus.png')}}"></span> 
                    How much does it cost? 
                </a>
                <div class="dropdown-inner">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into</p>
                </div>
            </div>

            <div class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle">
                    <span class="caret minus"><img src="{{asset('design/images/minus.png')}}"></span>
                    <span class="caret plus"><img src="{{asset('design/images/plus.png')}}"></span> 
                    Time Commitment
                </a>
                <div class="dropdown-inner">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="footer-top" style="background: url('./images/footer-top.jpg') no-repeat center center; background-size: cover;">
    <div class="container">
        <h4>Every year n people prepare to interview confidently on mentorly. Get fast results with professional mentors. Prepare to achieve your goals today. </h4>
        <a href="#" class="prinery-btm blue-btm">Get Started</a>
    </div>
</section>

@section('script')@stop
@endsection