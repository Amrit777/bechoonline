<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <!-- INCLUDE FONTS -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawsome/all.min.css') }}">
    <link href="//fonts.googleapis.com/css?family=Nunito:400,600,700,800" rel="stylesheet">
    <!-- CSS Libraries -->
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

    @stack('style')
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            @include('layouts/partials/header')
            @include('layouts/partials/sidebar')
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    @yield('head')
                    <div class="section-body">
                    </div>
                </section>
                @yield('content')
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; {{ date('Y') }} <div class="bullet"></div> Powered By <a
                        href="{{ url('/') }}">{{ env('APP_NAME') }} v2.5</a>
                </div>

            </footer>
        </div>
    </div>
    <!--=====================================
WHATSAPP and tawk amit singh
=======================================-->
    @auth
        @if (Auth::user()->role_id != 1)
            {{-- {{ load_main_whatsapp() }} --}}
            <!--Start of Tawk.to Script-->
            <script type="text/javascript">
                var Tawk_API = Tawk_API || {},
                    Tawk_LoadStart = new Date();
                (function() {
                    var s1 = document.createElement("script"),
                        s0 = document.getElementsByTagName("script")[0];
                    s1.async = true;
                    s1.src = 'https://embed.tawk.to/60b23716de99a4282a1a4301/1f6s84n1m';
                    s1.charset = 'UTF-8';
                    s1.setAttribute('crossorigin', '*');
                    s0.parentNode.insertBefore(s1, s0);
                })();

            </script>
            <!--End of Tawk.to Script-->
        @endif
    @endauth



    <!-- General JS Scripts -->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    @stack('js')
    <script src="{{ asset('assets/js/stisla.js') }}"></script>
    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>

</body>

</html>
