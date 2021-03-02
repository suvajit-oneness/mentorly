<header>
    <div class="container">
        <div class="inner-header">
            <a href="#" class="logo">
                <img src="{{asset('design/images/logo.png')}}">
            </a>
            <div class="nevigation">
                <div class="menu-wrap">
                    <ul class="menu">
                        <li><a href="{{route('mentors.find')}}">Find Mentors</a></li>
                        <li><a href="#">Become a Mentor </a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="{{route('aboutus')}}">About Us  </a></li>
                        <li><a href="{{route('contactus')}}">Contact </a></li>
                    </ul>
                </div>

                <!-- <ul class="menu-btm">
                    <li><a href="#" class="prinery-btm blue-btm">Log In</a></li>
                </ul> -->
                @guest
                    <ul class="menu-btm">
                        <li><a href="{{url('mentor/login')}}" class="prinery-btm blue-btm">Mentor LogIn</a></li>
                        <li><a href="{{url('mentee/login')}}" class="prinery-btm blue-btm">Mentee LogIn</a></li>
                    </ul>
                @else
                    <ul class="headedr-two-list">
                        <li>
                            <a href="#">
                                <img src="{{asset('design/images/message.png')}}">
                                <span>15</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="{{asset('design/images/notification.png')}}">
                                <span>8</span>
                            </a>
                        </li>
                    </ul>
                    <div class="header-profile">
                        <span class="header-profile-image" data-toggle="dropdown" ><img src="{{asset('design/images/mentor1.jpg')}}"></span>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="profile-dropdown">
                                <li><a href="#">Messages</a></li>
                                <li><a href="#">My Lessons</a></li>
                                <li><a href="#">Invite a friend </a></li>
                                <li><a href="#">Settings</a></li>
                                <li><a href="{{url('logout')}}">Log out</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="ham">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</header>