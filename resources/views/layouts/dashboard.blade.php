<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Icon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/morris/morris.css') }}" rel="stylesheet">
    @stack('css')

    @livewireStyles

</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <x-logo />
            </div>

            <x-navbar />

        </div>
        <!-- Top Bar End -->

        <!-- Sidebar -->
        <x-sidebar />

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">

            <!-- Start content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="page-title-box">
                        <div class="row align-items-center">
                            {{ $header }}
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end page-title -->

                    {{ $slot }}

                </div>
                <!-- container-fluid -->

            </div>
            <!-- content -->

            <footer class="footer">
                © 2020 NTC <span class="d-none d-sm-inline-block"> - Crafted with <i
                        class="mdi mdi-heart text-danger"></i></span>.
            </footer>

        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- modal -->
    @stack('modals')

    <!-- Scripts -->
    @livewireScripts
    <script data-turbolinks-eval="false" src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"></script>
    <script data-turbolinks-eval="false" src="{{ asset('js/app.js') }}"></script>

    <!-- jQuery  -->
    <script data-turbolinks-eval="false" src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script data-turbolinks-eval="false" src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script data-turbolinks-eval="false" src="{{ asset('assets/js/metismenu.min.js') }}"></script>
    <script data-turbolinks-eval="false" src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
    <script data-turbolinks-eval="false" src="{{ asset('assets/js/waves.min.js') }}"></script>

    <!--Morris Chart-->
    <script data-turbolinks-eval="false" src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>
    <script data-turbolinks-eval="false" src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>

    <!-- Spesific Pages JS -->
    @stack('js')

    <!-- App js -->
    <script data-turbolinks-eval="false" src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
