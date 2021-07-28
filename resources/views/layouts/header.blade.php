<header>
    <div class="container">
        <div class="inner-header">
            <a href="{{url('/')}}" class="logo">
                <img src="{{asset('design/images/logo.png')}}">
            </a>
            <div class="nevigation">
                <div class="menu-wrap">
                    <ul class="menu">
                        <li><a href="{{route('mentors.find')}}">Find Mentors</a></li>
                        @if(get_guard() == '' || get_guard() != 'mentor')
                            <li><a href="{{route('singup.mentor')}}">Become a Mentor </a></li>
                        @endif
                        <!-- <li><a href="#">Careers</a></li> -->
                        <li><a href="{{route('aboutus')}}">About Us </a></li>
                        <li><a href="{{route('contactus')}}">Contact </a></li>
                    </ul>
                </div>

                @if(get_guard() != '' && get_guard() != 'admin')
                <div class="navigation-right">
                    <ul class="headedr-two-list">
                        <li>
                            <a href="{{route('user.message.log')}}">
                                <img src="{{asset('design/images/message.png')}}">
                                <!-- <span>15</span> -->
                            </a>
                        </li>
                        <!-- <li>
                            <a href="#">
                                <img src="{{asset('design/images/notification.png')}}">
                                <span>8</span>
                            </a>
                        </li> -->
                        <li>
                            <i class="fa fa-bell" aria-hidden="true"></i>
                            <span>8</span>
                        </li>
                    </ul>
                    <div class="header-profile">
                        <span class="header-profile-image" data-toggle="dropdown" ><img src="@if(Auth::guard(get_guard())->user()->image ==''){{asset('design/images/mentor5.jpg')}}@else{{Auth::guard(get_guard())->user()->image}}@endif"></span>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="profile-dropdown">
                                <li><a href="{{route('user.message.log')}}">Messages</a></li>
                                <!-- <li><a href="#">My Lessons</a></li> -->
                                <!-- <li><a href="#">Invite a friend </a></li> -->
                                <li><a href="{{route('mentor.mentee.setting')}}">Accounts</a></li>
                                <li><a href="{{url('logout')}}">Log out</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="ham">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                @else
                    <ul class="menu-btm">
                        <li><a href="{{url('mentor/login')}}" class="prinery-btm blue-btm">Mentor LogIn</a></li>
                        <li><a href="{{url('mentee/login')}}" class="prinery-btm blue-btm">Mentee LogIn</a></li>
                    </ul>
                @endif
            </div>
        </div>
    </div>
</header>