<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>@yield('title')</title>
        <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}"
            rel="stylesheet">
        <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}"
            rel="stylesheet">
        <link href="{{ asset('assets/css/admin.css') }}"
            rel="stylesheet">
        @stack('styles')
    </head>

    <body>
        <div class="admin-wrapper">
            @include('dashboard.layouts.sidebar')
            <div class="admin-main">
                @include('dashboard.layouts.topbar')
                <div class="admin-content">
                    @yield('content')
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/admin.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @stack('scripts')
    
    </body>
</html>