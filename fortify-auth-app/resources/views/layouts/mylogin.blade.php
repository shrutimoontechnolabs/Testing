<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'Authentication')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Phoenixcoded">
    <meta name="keywords" content="Flat ui, Admin, Responsive, Landing, Bootstrap, App, Template">
    <meta name="author" content="Phoenixcoded">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/auth/images/favicon.ico') }}" type="image/x-icon">
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Mada:300,400,500,600,700" rel="stylesheet">
    
    <!-- Required Framework -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/icon/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/icon/icofont/css/icofont.css') }}">
    <!-- Custom Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/css/style.css') }}">
</head>

<body class="fix-menu">
    <section class="login p-fixed d-flex text-center bg-primary ">
        <div class="container-fluid">
            @yield('content')
        </div>
    </section>

    <!-- Required JS -->
    <script type="text/javascript" src="{{ asset('assets/auth/plugins/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/auth/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/auth/plugins/tether/dist/js/tether.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/auth/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/auth/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/auth/plugins/modernizr/modernizr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/auth/js/script.js') }}"></script>
</body>

</html>
