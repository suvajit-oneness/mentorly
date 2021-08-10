@php $guard = get_guard(); @endphp
@if($guard == '')
    <section class="get-paid" style="background: url('http://demo91.co.in/dev/mentorly/public/design/images/footer-top.jpg') no-repeat center center; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-5">
                    <h2 class="page-heading white-color">Get paid to reach <br> online</h2>
                    <p class="white-color">Earn money sharing your expert knowledge with mentees. Sign up to start mentoring online with MentorMatch</p>
                    <a href="{{route('singup.mentor')}}" class="prinery-btm blue-btm">Get Started</a>
                </div>
            </div>
        </div>
    </section>
@endif

<footer>
    <div class="footer-inner">
        <a href="{{url('/')}}">
            <img src="{{asset('design/images/logo.png')}}">
        </a>
        <div class="footer-gid">
            <h4 class="footer-title">Company</h4>
            <ul class="footer-list">
                <li><a href="{{route('mentors.find')}}">Find Mentors</a></li>
                @if($guard == '' || $guard != 'mentor')
                    <li><a href="{{route('singup.mentor')}}">Become a Mentor </a></li>
                @endif
                <li><a href="{{route('carrier')}}">Carriers</a></li>
                <li><a href="{{route('aboutus')}}">About Us</a></li>
                <li><a href="{{route('contactus')}}">Contact</a></li>
            </ul>
        </div>
        <div class="footer-gid">
            <h4 class="footer-title">Legal</h4>
            <ul class="footer-list">
                <li><a href="{{route('terms.condition')}}">Terms and Condition</a></li>
                <li><a href="{{route('policy')}}">Policy</a></li>
            </ul>
        </div>
        <div class="footer-gid">
            <h4 class="footer-title">Connect Us</h4>
            <ul class="social-list">
                <!-- sharing the Data from AppServiceProvidor -->
                <li><a href="{{$contact->linkedinLink}}" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                <li><a href="{{$contact->facebookLink}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="{{$contact->instagramLink}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="copyright">
        © 2021 mentorly. All rights reserved
    </div>
</footer>



