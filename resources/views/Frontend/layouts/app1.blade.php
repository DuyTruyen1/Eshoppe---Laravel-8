<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery Zoom plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.21/jquery.zoom.min.js"></script>
    <!-- PrettyPhoto library (nếu chưa có) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prettyPhoto/3.1.6/css/prettyPhoto.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prettyPhoto/3.1.6/js/jquery.prettyPhoto.min.js"></script>
    <link href="{{asset('Frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('Frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('Frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('Frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('Frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('Frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('Frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('Frontend/css/rate.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('Frontend/js/html5shiv.js')}}"></script>
    <script src="{{asset('Frontend/js/respond.min.js')}}"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('Frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('Frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('Frontend/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('Frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('Frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('Frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">
</head> 
<body>
    @include('Frontend.layouts.header')
    @include('Frontend.layouts.slide')
    <section>
        <div class="container">
            <div class="row">
                @include('Frontend.layouts.menu-left')
                <div class="col-sm-9 padding-right">
                    @yield('noidung')
                </div>
            </div>
        </div>
    </section>
    @include('Frontend.layouts.footer')
    <script src="{{asset('Frontend/js/jquery.js')}}"></script>
    <script src="{{asset('Frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('Frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('Frontend/js/price-range.js')}}"></script>
    <script src="{{asset('Frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('Frontend/js/main.js')}}"></script>
    <script src="{{asset('Frontend/js/jquery-1.9.1.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.3/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.0.0/rangeslider.min.css"></script>
    @yield('js')
</body>
</html>
