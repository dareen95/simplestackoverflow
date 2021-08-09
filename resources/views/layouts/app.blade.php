<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<!-- Mirrored from 2code.info/demo/html/ask-me-html/blue/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Jul 2021 11:07:49 GMT -->
<head>

    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <title>@yield('meta_title', 'Stackoverflow')</title>
    <meta name="description" content="Ask me Responsive Questions and Answers Template">
    <meta name="author" content="2code.info">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Main Style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <!-- Skins -->
    <link rel="stylesheet" href="{{ asset('css/skins/blue.css') }}">

    <!-- Responsive Style -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    @yield('css')
</head>
<body>

{{--<div class="loader"><div class="loader_html"></div></div>--}}

<div id="wrap" class="grid_1200">

    @include('partials.navbar')
    @yield('content')

    @include('partials.footer')
    @yield('js')
</body>

<!-- Mirrored from 2code.info/demo/html/ask-me-html/blue/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 23 Jul 2021 11:07:49 GMT -->
</html>
