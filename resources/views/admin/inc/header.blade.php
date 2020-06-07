<header class="header fixed-top clearfix">
    <!--logo start-->
    <div class="brand">

        <a href="{{route('admin.')}}" class="logo">
            <img src="{{ asset('backend/images/logo.png') }}" alt="">
        </a>
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars"></div>
        </div>
    </div>
    <!--logo end-->

    <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <ul class="nav top-menu">

            <!-- inbox dropdown start-->
            {{-- <li id="header_inbox_bar" class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-important">4</span>
                </a>
                <ul class="dropdown-menu extended inbox">
                    <li>
                        <p class="red">You have 4 Mails</p>
                    </li>
                    <li>
                        <a href="#">
                            <span class="photo"><img alt="avatar" src="images/avatar-mini.jpg"></span>
                            <span class="subject">
                                <span class="from">Jonathan Smith</span>
                                <span class="time">Just now</span>
                            </span>
                            <span class="message">
                                Hello, this is an example msg.
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="#">See all messages</a>
                    </li>
                </ul>
            </li> --}}
            <!-- inbox dropdown end -->
            <!-- notification dropdown start-->
            {{-- <li id="header_notification_bar" class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                    <i class="fa fa-bell-o"></i>
                    <span class="badge bg-warning">3</span>
                </a>
                <ul class="dropdown-menu extended notification">
                    <li>
                        <p>Notifications</p>
                    </li>
                    <li>
                        <div class="alert alert-info clearfix">
                            <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                            <div class="noti-info">
                                <a href="#"> Server #1 overloaded.</a>
                            </div>
                        </div>
                    </li>

                </ul>
            </li> --}}
            <!-- notification dropdown end -->
        </ul>
        <!--  notification end -->
    </div>
    <div class="top-nav clearfix">
        <!--search & user info start-->
        <ul class="nav pull-right top-menu">
            <li>
                <input type="text" class="form-control search" placeholder=" Search">
            </li>
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <img alt="" src="{{ asset('backend/images/avatar1_small.jpg') }}">
                    <span class="username">{{$user = Auth::user()->name }}</span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <li><a href="{{route('admin.profile')}}"><i class=" fa fa-suitcase"></i>Profile</a></li>
                    <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                    <li><a href="{{route('admin.logout')}}"><i class="fa fa-key"></i> Log Out</a></li>
                </ul>
            </li>
            <!-- user login dropdown end -->
        </ul>
        <!--search & user info end-->
    </div>
</header>
