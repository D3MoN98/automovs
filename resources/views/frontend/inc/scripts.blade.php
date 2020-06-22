<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="{{asset('frontend/js/wow.min.js')}}"></script>
<script>!!window['addEventListener'] && new WOW().init();</script>

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

@if (session('error'))
<script>
    Swal.fire(
        'Error!',
        '{{session("error")}}',
        'error'
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
