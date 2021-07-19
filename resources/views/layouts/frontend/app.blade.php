<!DOCTYPE html>
<html class="no-js" lang="es-PE">
    <head prefix="og: http://ogp.me/ns#">
        <meta http-equiv="Cache-control" content="public">
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Hablando Claro | Tendencias en telecomunicaciones en el Perú</title>
        <meta name="description" content="Conoce las últimas tendencias en transformación digital, innovación, tecnología, telecomunicaciones y RSC que están cambiando nuestro país y el mundo">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="canonical" href="https://hablandoclaro.pe/" />


        <meta property="fb:app_id" content="421018219318355" />
        <meta property="og:url" content="https://hablandoclaro.pe/" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Tendencias en telecomunicaciones en el Perú" />
        <meta property="og:description" content="Conoce las últimas tendencias en transformación digital, innovación, tecnología, telecomunicaciones y RSC que están cambiando nuestro país y el mundo" />
        <meta property="og:image" content="https://hablandoclaro.pe/images/Hablandoclaro-logo.jpeg" />

        <meta name="twitter:card" content="summary">

        <meta name="twitter:title" content="Tendencias en telecomunicaciones en el Perú">
        <meta name="twitter:description" content="Conoce las últimas tendencias en transformación digital, innovación, tecnología, telecomunicaciones y RSC que están cambiando nuestro país y el mundo">
        <meta name="twitter:image" content="https://hablandoclaro.pe/images/Hablandoclaro-logo.jpeg">


        <link rel="shortcut icon" href="/favicon.ico" />
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
