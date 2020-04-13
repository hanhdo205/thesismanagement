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
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Font-awesome style -->
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
     <!-- Datepicker styles-->
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
    @yield('content')
    <!-- Jquery scripts -->
    <script src="{{ asset('js/jquery-1.12.4.js') }}"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Datepicker script -->
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/datepicker-ja.js') }}"></script>
    <!-- Custom script -->
    <script src="{{ asset('js/guess.js') }}"></script>
</body>
</html>