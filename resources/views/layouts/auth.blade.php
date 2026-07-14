<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') | BandungEats</title>

    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/auth.css') }}" rel="stylesheet">

    @stack('styles')

</head>

<body>

<div class="container-fluid vh-100">

    <div class="row h-100">

        <!-- LEFT -->

        <div class="col-lg-6 auth-left">

            <div class="auth-content">

                @yield('content')

            </div>

        </div>

        <!-- RIGHT -->

        <div class="col-lg-6 auth-right d-none d-lg-flex">

            <img
                src="{{ asset('assets/img/depann.png') }}"
                alt="Bandung Eats">

        </div>

    </div>

</div>

<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

@stack('scripts')

</body>

</html>