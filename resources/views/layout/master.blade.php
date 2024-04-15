<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Coderthemes" name="author"/>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="light-style"/>
    <link href="{{ asset('css/app-creative-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style"/>

</head>

<body class="loading" data-layout-config='{"darkMode":"false"}'>
<div class="wrapper">
    @include('layout.left-side-menu')
</div>
<div class="content-page">
    <div class="content">
        @include('layout.top-bar')
        <div class="container-fluid">
            <div class="page-title-box">
                <h3 class="page-title">{{$title ?? ''}}</h3>
            </div>
            @yield('content')
        </div>
        @include('layout.footer')
    </div>
</div>

<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/app.min.js') }}"></script>
@stack('js')
</body>

</html>
