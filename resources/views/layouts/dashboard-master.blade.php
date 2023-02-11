<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title', 'AbdPastry') &mdash; {{ env('APP_NAME') }}</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="api-base-url" content="{{ url('') }}"/>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset("assets/node_modules/jqvmap/dist/jqvmap.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/node_modules/summernote/dist/summernote-bs4.css")}}">
    <link rel="stylesheet" href="{{asset("assets/node_modules/owl.carousel/dist/assets/owl.carousel.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/node_modules/owl.carousel/dist/assets/owl.theme.default.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/node_modules/prismjs/themes/prism.css")}}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/custom.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/components.css")}}">
    <style>
        .visibleDiv {
            display: block;
        }

        .invisibleDiv {
            display: none;
        }

    </style>
</head>

<body>
<div id="app">
    <div class="main-wrapper">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            @include('layouts.dashboard-partials.topnav')
        </nav>
        <div class="main-sidebar">
            @include('layouts.dashboard-partials.sidebar')
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
        <footer class="main-footer">
            @include('layouts.dashboard-partials.footer')
        </footer>
    </div>
</div>

@yield('vue')

<!-- General JS Scripts -->

<!-- General JS Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{asset("assets/js/stisla.js")}}"></script>

<!-- JS Libraies -->
<script src="{{asset("assets/node_modules/jquery-sparkline/jquery.sparkline.min.js")}}"></script>
<script src="{{asset("assets/node_modules/chart.js/dist/Chart.min.js")}}"></script>
<script src="{{asset("assets/node_modules/owl.carousel/dist/owl.carousel.min.js")}}"></script>
<script src="{{asset("assets/node_modules/summernote/dist/summernote-bs4.js")}}"></script>
<script src="{{asset("assets/node_modules/chocolat/dist/js/jquery.chocolat.min.js")}}"></script>


<!-- Template JS File -->
<script src="{{asset('assets/js/scripts.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>

@yield('scripts')
</body>
</html>
