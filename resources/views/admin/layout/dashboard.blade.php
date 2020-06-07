<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>{{config('app.name')}}</title>
    <!--Core CSS -->
    <link href="{{asset('backend/bs3/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/js/jquery-ui/jquery-ui-1.10.1.custom.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/bootstrap-reset.css')}}" rel="stylesheet">
    <link href="{{asset('backend/font-awesome/css/font-awesome.css')}}" rel="stylesheet">


    @stack('styles')


    <!-- Custom styles for this template -->
    <link href="{{asset('backend/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/style-responsive.css')}}" rel="stylesheet" />
    <link href="{{asset('backend/css/custom.css')}}" rel="stylesheet" />
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>

<body class="{{ isset($body_class) ? $body_class : '' }}">

    <section id="container">
        <!--header start-->
        @include('admin.inc.header')
        <!--header end-->
        <!--sidebar start-->
        @include('admin.inc.sidebar')
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                @yield('content')
            </section>
        </section>
        <!--main content end-->
    </section>


    @include('admin.inc.scripts')

    @stack('scripts')


</body>

</html>
