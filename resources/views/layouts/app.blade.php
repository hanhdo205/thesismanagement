<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="@yield('description')">
    <meta name="keyword" content="@yield('keyword')">
	<title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@guest
<!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    @yield('content')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
@else
    <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
         <!-- Font-awesome style -->
        <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet" />
        <!-- Styles for this template-->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <!-- Scrollbar styles for sidebar-->
        <link href="{{ asset('css/perfect-scrollbar.css') }}" rel="stylesheet">
        <!-- Datepicker styles-->
        <link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </head>
    <body>
            <div id="wrapper">
                    @include('includes.topbar')
                    @include('includes.sidebar')
                    <div id="page-wrapper">
                        @yield('content')
                    </div>
                    <!-- /. PAGE WRAPPER  -->
            </div>
            <!-- /# WRAPPER  -->
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <!-- Scripts -->
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <!-- Datepicker script -->
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="{{ asset('js/datepicker-ja.js') }}"></script>
        <!-- Scrollbar script -->
        <script src="{{ asset('js/perfect-scrollbar.jquery.js') }}"></script>
        <!-- Custom script -->
        <script src="{{ asset('js/custom.js') }}"></script>
@endguest
</body>
</html>