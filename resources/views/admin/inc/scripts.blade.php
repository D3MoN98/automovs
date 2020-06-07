<!-- Placed js at the end of the document so the pages load faster -->
<!--Core js-->
<script src="{{asset('backend/js/jquery.js')}}"></script>
<script src="{{asset('backend/js/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}"></script>
<script src="{{asset('backend/bs3/js/bootstrap.min.js')}}"></script>

<script src="{{asset('backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('backend/js/jquery.scrollTo.min.js')}}"></script>
<script src="{{asset('backend/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js')}}"></script>
<script src="{{asset('backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('backend/js/skycons/skycons.js')}}"></script>
<script src="{{asset('backend/js/jquery.scrollTo/jquery.scrollTo.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="{{asset('backend/js/calendar/clndr.js')}}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
<script src="{{asset('backend/js/calendar/moment-2.2.1.js')}}"></script>
<script src="{{asset('backend/js/evnt.calendar.init.js')}}"></script>
<script src="{{asset('backend/js/jvector-map/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('backend/js/jvector-map/jquery-jvectormap-us-lcc-en.js')}}"></script>
<!--clock init-->
<script src="{{asset('backend/js/css3clock/js/css3clock.js')}}"></script>
<!--Easy Pie Chart-->
<script src="{{asset('backend/js/easypiechart/jquery.easypiechart.js')}}"></script>
<!--Sparkline Chart-->
<script src="{{asset('backend/js/sparkline/jquery.sparkline.js')}}"></script>
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
<script src="{{asset('backend/js/scripts.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@if (session('success'))
<script>
    Swal.fire(
        'Good job!',
        '{{session("success")}}',
        'success'
    );
</script>
@endif

<script>
    function onlyNumberKey(evt) {

        // Only ASCII charactar in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>
