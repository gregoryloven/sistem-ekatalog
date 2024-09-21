<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="../enduser/assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../enduser/assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../enduser/assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="../enduser/assets/img/favicons/favicon.ico">
    <!-- <link rel="manifest" href="../enduser/assets/img/favicons/manifest.html"> -->
    <meta name="msapplication-TileImage" content="../enduser/assets/img/favicons/mstile-150x150.html">
    <meta name="theme-color" content="#ffffff">

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="../enduser/vendors/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../enduser/vendors/hamburgers/hamburgers.min.css" rel="stylesheet">
    <link href="../enduser/vendors/loaders.css/loaders.min.css" rel="stylesheet">
    <link href="../enduser/assets/css/theme.min.css" rel="stylesheet" />
    <link href="../enduser/assets/css/user.min.css" rel="stylesheet" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600&amp;family=Jost:wght@300;400;500;600&amp;display=swap" rel="stylesheet">
</head>
<body>
    <main class="main" id="top">
      <div class="preloader" id="preloader">
        <div class="loader-box">
          <div class="loader"></div>
        </div>
      </div>

        @include('layouts_enduser.navbar')
        @include('sweetalert::alert')
        @yield('content')


    </main>

    @include('layouts_enduser.footer')

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="../enduser/vendors/popper/popper.min.js"></script>
    <script src="../enduser/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="../enduser/vendors/is/is.min.js"></script>
    <!-- <script src="../enduser/vendors/bigpicture/BigPicture.js"> </script> -->
    <script src="../enduser/vendors/swiper/swiper-bundle.min.js"></script>
    <script src="../enduser/vendors/fontawesome/all.min.js"></script>
    <script src="../enduser/vendors/rellax/rellax.min.js"></script>
    <script src="../enduser/vendors/lodash/lodash.min.js"></script>
    <script src="../enduser/vendors/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="../enduser/vendors/gsap/gsap.js"></script>
    <script src="../enduser/vendors/gsap/customEase.js"></script>
    <script src="../enduser/assets/js/theme.js"></script>

    @yield('javascript')
</body>
</html>
