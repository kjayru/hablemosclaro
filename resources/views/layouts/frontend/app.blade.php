<!DOCTYPE html>
<html class="no-js" lang="es-PE">
    <head prefix="og: http://ogp.me/ns#">
        <meta http-equiv="Cache-control" content="public">
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="canonical" href="" />
        <link rel='shortlink' href="" />

        <meta property="fb:app_id" content="" />
        <meta property="og:url" content="" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="" />
        <meta property="og:description" content="" />
        <meta property="og:image" content="" />

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@">
        <meta name="twitter:creator" content="@">
        <meta name="twitter:title" content="">
        <meta name="twitter:description" content="">
        <meta name="twitter:image" content="">

        <link rel="shortcut icon" href="" />

        <link id="site-css" rel="stylesheet" href="/assets/public/css/site.css?v={{uniqid()}}">


    </head>
    <body>

@include('layouts.frontend.partials.header')


@yield('content')


@include('layouts.frontend.partials.footer')

		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script src="/assets/public/js/site.js?v={{uniqid()}}"></script>
        <script src="/js/scripts.js?v={{uniqid()}}"></script>
	</body>
</html>
