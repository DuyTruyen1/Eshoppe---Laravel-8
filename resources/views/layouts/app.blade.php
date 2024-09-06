<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('Admin/assets/images/favicon.png') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('Admin/assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Admin/dist/css/style.min.css') }}" rel="stylesheet">
</head>
<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <!-- Main wrapper -->
    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" 
    data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
    
        <!-- Topbar header -->
        @include('Admin.layouts.header')
        <!-- Left Sidebar -->
        @include('Admin.layouts.left-sidebar')
        <!-- Page wrapper -->
              @yield('content')

   {{-- Base URL --}}
   {{-- {{ asset('Admin/') }} --}}

   <script src="{{ asset('Admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
   <script src="{{ asset('Admin/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
   <script src="{{ asset('Admin/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
   <script src="{{ asset('Admin/assets/extra-libs/sparkline/sparkline.js') }}"></script>
   <script src="{{ asset('Admin/dist/js/waves.js') }}"></script>
   <script src="{{ asset('Admin/dist/js/sidebarmenu.js') }}"></script>
   <script src="{{ asset('Admin/dist/js/custom.min.js') }}"></script>
   <script src="{{ asset('Admin/assets/libs/chartist/dist/chartist.min.js') }}"></script>
   <script src="{{ asset('Admin/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
   <script src="{{ asset('Admin/dist/js/pages/dashboards/dashboard1.js') }}"></script>
  

</body>
</html>
