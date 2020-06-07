@extends('admin.layout.dashboard')

@section('content')
<!--mini statistics start-->
<div class="row">
    <div class="col-md-3">
        <div class="mini-stat clearfix">
            <span class="mini-stat-icon orange"><i class="fa fa-gavel"></i></span>
            <div class="mini-stat-info">
                <span>320</span>
                New Order Received
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mini-stat clearfix">
            <span class="mini-stat-icon tar"><i class="fa fa-tag"></i></span>
            <div class="mini-stat-info">
                <span>22,450</span>
                Copy Sold Today
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mini-stat clearfix">
            <span class="mini-stat-icon pink"><i class="fa fa-money"></i></span>
            <div class="mini-stat-info">
                <span>34,320</span>
                Dollar Profit Today
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mini-stat clearfix">
            <span class="mini-stat-icon green"><i class="fa fa-eye"></i></span>
            <div class="mini-stat-info">
                <span>32720</span>
                Unique Visitors
            </div>
        </div>
    </div>
</div>
<!--mini statistics end-->

<div class="row">
    <div class="col-md-6">
        <!--notification start-->
        <section class="panel">
            <header class="panel-heading">
                Notification <span class="tools pull-right">
                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                    <a href="javascript:;" class="fa fa-cog"></a>
                    <a href="javascript:;" class="fa fa-times"></a>
                </span>
            </header>
            <div class="panel-body">
                <div class="alert alert-info clearfix">
                    <span class="alert-icon"><i class="fa fa-envelope-o"></i></span>
                    <div class="notification-info">
                        <ul class="clearfix notification-meta">
                            <li class="pull-left notification-sender"><span><a href="#">Jonathan
                                        Smith</a></span> send you a mail </li>
                            <li class="pull-right notification-time">1 min ago</li>
                        </ul>
                        <p>
                            Urgent meeting for next proposal
                        </p>
                    </div>
                </div>
                <div class="alert alert-danger">
                    <span class="alert-icon"><i class="fa fa-facebook"></i></span>
                    <div class="notification-info">
                        <ul class="clearfix notification-meta">
                            <li class="pull-left notification-sender"><span><a href="#">Jonathan
                                        Smith</a></span> mentioned you in a post </li>
                            <li class="pull-right notification-time">7 Hours Ago</li>
                        </ul>
                        <p>
                            Very cool photo jack
                        </p>
                    </div>
                </div>
                <div class="alert alert-success ">
                    <span class="alert-icon"><i class="fa fa-comments-o"></i></span>
                    <div class="notification-info">
                        <ul class="clearfix notification-meta">
                            <li class="pull-left notification-sender">You have 5 message unread</li>
                            <li class="pull-right notification-time">1 min ago</li>
                        </ul>
                        <p>
                            <a href="#">Anjelina Mewlo, Jack Flip</a> and <a href="#">3 others</a>
                        </p>
                    </div>
                </div>
                <div class="alert alert-warning ">
                    <span class="alert-icon"><i class="fa fa-bell-o"></i></span>
                    <div class="notification-info">
                        <ul class="clearfix notification-meta">
                            <li class="pull-left notification-sender">Domain Renew Deadline 7 days ahead
                            </li>
                            <li class="pull-right notification-time">5 Days Ago</li>
                        </ul>
                        <p>
                            Next 5 July Thursday is the last day
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!--notification end-->
    </div>
</div>
@endsection

@push('scripts')

<script src="{{asset('backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('backend/js/jquery.scrollTo.min.js')}}"></script>
<script src="{{asset('backend/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js')}}"></script>
<script src="{{asset('backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('backend/js/skycons/skycons.js')}}"></script>
<script src="{{asset('backend/js/jquery.scrollTo/jquery.scrollTo.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
{{-- <script src="{{asset('backend/js/calendar/clndr.js')}}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
<script src="{{asset('backend/js/calendar/moment-2.2.1.js')}}"></script>
<script src="{{asset('backend/js/evnt.calendar.init.js')}}"></script>
<script src="{{asset('backend/js/jvector-map/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('backend/js/jvector-map/jquery-jvectormap-us-lcc-en.js')}}"></script> --}}
<!--clock init-->
{{-- <script src="{{asset('backend/js/css3clock/js/css3clock.js')}}"></script> --}}
<!--Easy Pie Chart-->
{{-- <script src="{{asset('backend/js/easypiechart/jquery.easypiechart.js')}}"></script> --}}
<!--Sparkline Chart-->
{{-- <script src="{{asset('backend/js/sparkline/jquery.sparkline.js')}}"></script> --}}
<!--Morris Chart-->
{{-- <script src="{{asset('backend/js/morris-chart/morris.js')}}"></script>
<script src="{{asset('backend/js/morris-chart/raphael-min.js')}}"></script> --}}
<!--jQuery Flot Chart-->
{{-- <script src="{{asset('backend/js/flot-chart/jquery.flot.js')}}"></script>
<script src="{{asset('backend/js/flot-chart/jquery.flot.tooltip.min.js')}}"></script>
<script src="{{asset('backend/js/flot-chart/jquery.flot.resize.js')}}"></script>
<script src="{{asset('backend/js/flot-chart/jquery.flot.pie.resize.js')}}"></script>
<script src="{{asset('backend/js/flot-chart/jquery.flot.animator.min.js')}}"></script>
<script src="{{asset('backend/js/flot-chart/jquery.flot.growraf.js')}}"></script> --}}
<script src="{{asset('backend/js/dashboard.js')}}"></script>
<script src="{{asset('backend/js/jquery.customSelect.min.js')}}"></script>

@endpush
