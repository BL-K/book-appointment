<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medical Register</title>

    <!-- start: Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_hospital/css/bootstrap.min.css') }}">
    <script src="//cdn.ckeditor.com/4.19.1/full/ckeditor.js"></script>
    <!-- plugins -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_hospital/css/plugins/fontawesome.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_hospital/css/plugins/simple-line-icons.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_hospital/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_hospital/css/plugins/fullcalendar.min.css') }}" />
    <link href="{{ asset('admin_hospital/css/style.css') }}" rel="stylesheet">
    <!-- end: Css -->

    {{-- <link rel="shortcut icon" href="asset/img/logomi.png"> --}}
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

{{-- <body id="mimin" class="dashboard"> --}}

<body>
    <!-- start: Header -->
    @include('includes.hospital_menu')
    <!-- end: Header -->

    <div class="container-fluid mimin-wrapper">

        <!-- start:Left Menu -->
        @include('includes.hospital_nav')
        <!-- end: Left Menu -->

        <!-- start: content -->
        <div id="content">
            <div class="panel">
                <div class="panel-body">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- end: content -->

    </div>

    <!-- start: Javascript -->
    <script src="{{ asset('admin_hospital/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_hospital/js/jquery.ui.min.js') }}"></script>
    <script src="{{ asset('admin_hospital/js/bootstrap.min.js') }}"></script>


    <!-- plugins -->
    <script src="{{ asset('admin_hospital/js/plugins/moment.min.js') }}"></script>
    <script src="{{ asset('admin_hospital/js/plugins/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('admin_hospital/js/plugins/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('admin_hospital/js/plugins/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('admin_hospital/js/plugins/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('admin_hospital/js/plugins/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ asset('admin_hospital/js/plugins/chart.min.js') }}"></script>

    <!-- custom -->
    <script src="{{ asset('admin_hospital/js/main.js') }}"></script>
</body>

</html>
