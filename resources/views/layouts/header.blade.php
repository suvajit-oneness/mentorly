<header>
    @php
        $guard = get_guard();$notification = [];
        if($guard != ''){
            $user = Auth::guard($guard)->user();
            $notification = \App\Models\Notification::select('*');
            if($guard == 'mentor'){
                $notification = $notification->where('mentorId',$user->id);
            }elseif($guard == 'web'){
                $notification = $notification->where('userId',$user->id)->where('userType',$guard);
            }
            $notification = $notification->orderBy('id','DESC')->get();
        }
    @endphp
    <div class="container">
        <div class="inner-header">
            <a href="{{url('/')}}" class="logo">
                <img src="{{asset('design/images/logo.png')}}">
            </a>
            <div class="nevigation">
                <div class="menu-wrap">
                    <ul class="menu">
                        <li><a href="{{route('mentors.find')}}">Find Mentors</a></li>
                        @if($guard == '' || $guard != 'mentor')
                        <li><a href="{{route('singup.mentor')}}">Become a Mentor </a></li>
                        @endif
                        <!-- <li><a href="#">Careers</a></li> -->
                        <li><a href="{{route('aboutus')}}">About Us </a></li>
                        <li><a href="{{route('contactus')}}">Contact </a></li>
                    </ul>
                </div>

                @if($guard != '' && $guard != 'admin')


                <div class="navigation-right">
                    <ul class="headedr-two-list">
                        <li>
                            <a href="{{route('user.message.log')}}">
                                <img src="{{asset('design/images/message.png')}}">
                                <!-- <span>15</span> -->
                            </a>
                        </li>
                        



                    <li>
                        <a href="javascript:void(0);" id="toggle" onclick="openNav()" class="mr-1 ml-3">
                            <img src="{{url('/')}}/design/images/notification.png">
                            <span class="countter_bell">{{count($notification)}}</span>
                        </a>
                    </li>



                    <script>
                        function openNav() {
                          document.getElementById("mySidenav").style.width = "300px";
                          document.getElementById("toggle").style.position = "static";
                      }

                      function closeNav() {
                          document.getElementById("mySidenav").style.width = "0";
                          document.getElementById("toggle").style.marginRight = "0";
                          document.getElementById("toggle").style.position = "relative";
                      }

                  </script>
                  <!--Notification side bar-->

                  <div id="mySidenav" class="sidenav">
                    <div class="notification_title d-flex">
                        <h6>Notification</h6>
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    </div>
                    <div class="p-3 scroll-noti">
                        @foreach($notification as $noti)
                            @php
                                $msg = '';
                                if($guard == 'web'){
                                    $msg = 'Your Mentor Session has been booked '.$noti->msg;
                                    if($noti->msg == 'R'){
                                        $reshdule = $noti->reshedule;
                                        $existing = $noti->existing_slot;
                                        if($reshdule && $existing){
                                            $msg = 'Your Mentor session has been Resheduled from  '.$existing->date.' on '.$existing->time_shift.' to '.$reshdule->date.' on '.$reshdule->time_shift;    
                                        }
                                    }
                                }elseif($guard == 'mentor'){
                                    $msg = 'Your Mentee Session has been booked '.$noti->msg;
                                    if($noti->msg == 'R'){
                                        $reshdule = $noti->reshedule;
                                        $existing = $noti->existing_slot;
                                        if($reshdule && $existing){
                                            $msg = 'Your Mentee session has been Resheduled from  '.$existing->date.' on '.$existing->time_shift.' to '.$reshdule->date.' on '.$reshdule->time_shift;
                                        }
                                    }
                                }
                            @endphp
                            @if($msg != '')
                                <div class="card shadow-sm card_notifi">
                                    <small>{{date('m-d-y',strtotime($noti->created_at))}}</small>
                                    <h6>{{$msg}}</h6>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>



                <style type="text/css">


                    .sidenav {
                        height: 100vh;
                        width: 0;
                        position: fixed;
                        z-index: 1;
                        top: 0;
                        right:0;
                        background-color: #fff;
                        overflow-x: hidden;
                        transition: 0.5s;
                        box-shadow: 0 7px 8px rgba(0, 0, 0, 0.15);
                    }
                    .notification_title{
                        border-bottom:1px solid #efefef;
                        padding:20px;
                    }
                    .notification_title h6{
                        font-size:18px;
                        font-weight:600;
                        color:#000;
                        margin-bottom:0px;
                    }
                    .scroll-noti{
                        height: 573px;
                        overflow-y: auto;
                    }
                    .card_notifi {
                        margin-bottom:0;
                        border: none;
                        width: 100%;
                        padding: 10px;
                        border-radius: 0;
                        box-shadow: none !important;
                        border-bottom: 1px solid #e6e6e6;
                    }
                    .card_notifi small {
                        font-size: 10px;
                        color: #a5a5a5;
                        margin-bottom: 10px;
                        font-weight: 400;
                        text-align: right;
                    }
                    .card_notifi h6 {
                        font-size: 14px;
                        color: #000;
                        margin-bottom: 4px;
                        font-weight: 400;
                        font-family: 'Lato', sans-serif;
                        color: #2e2b2b;
                    }
                    .card_notifi p {
                        font-size: 13px;
                        color: #afafaf;
                        margin-bottom: 0;
                        font-weight: 600 !important;
                    }
                    .sidenav .closebtn {
                        position: absolute;
                        top: 0;
                        right: -50px;
                        font-size: 26px;
                        margin-right: 50px;
                        padding: 0px 10px;
                        /* background: #1cb3d3; */
                        color: #000;
                        }.headedr-two-list li a span {
                            color: #ffffff;
                            position: absolute;
                            background: #1cb3d3;
                            border-radius: 50%;
                            padding: 0 2px;
                            font-size: 11px;
                            width: 20px;
                            height: 20px;
                            line-height: 15px;
                            text-align: center;
                            top: -5%;
                            right: -7px;
                            border: 2px solid #fff;
                        }
                    </style>



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