<!DOCTYPE html>
<html class="no-js" lang="es-PE">
    <head prefix="og: http://ogp.me/ns#">
        <meta http-equiv="Cache-control" content="public">
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ @$global->titulo }}</title>
        <meta name="description" content="{{ @$global->descripcion }}">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="canonical" href="{{ $global->canonical }}" />
        <meta property="fb:app_id" content="{{ @$global->facebook_app_id}}" />

    @if(isset($articulo))


        <meta property="og:url" content="{{ url()->full() }}" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="{{ @$articulo->meta_titulo }}" />
        <meta property="og:description" content="{{ @$articulo->meta_descripcion }}" />
        <meta property="og:image" content="{{ env('APP_URL')}}/storage/{{ $articulo->meta_image}}" />
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="{{ @$articulo->titulo }}">
        <meta name="twitter:description" content="{{ @$articulo->descripcion }}">
        <meta name="twitter:image" content="{{ env('APP_URL')}}/storage/{{ $global->meta_image}}">

    @else


        <meta property="og:url" content="{{ env('APP_URL')}}/" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="{{ @$global->titulo }}" />
        <meta property="og:description" content="{{ @$global->descripcion }}" />
        <meta property="og:image" content="{{ env('APP_URL')}}/storage/{{ $global->imagen_facebook}}" />
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="{{ @$global->titulo }}">
        <meta name="twitter:description" content="{{ @$global->descripcion }}">
        <meta name="twitter:image" content="{{ env('APP_URL')}}/storage/{{ $global->imagen_twitter}}">
      @endif

        <link rel="dns-prefetch" href="//www.facebook.com/"  />
        <link rel="dns-prefetch" href="//www.google-analytics.com/" />
        <link rel="dns-prefetch" href="//www.google.com/" />
        <link rel="dns-prefetch" href="//gstatic.com/" />
        <link rel="preconnect" href="//www.google-analytics.com/">


        <link rel="shortcut icon" href="/favicon.ico" />
        <link id="site-css" rel="stylesheet" href="/assets/public/css/site.css?v={{uniqid()}}">

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-W4FSDQW');</script>
        <!-- End Google Tag Manager -->

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-C6X7J05FFR"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-C6X7J05FFR');
        </script>

    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W4FSDQW"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->


@include('layouts.frontend.partials.header')


@yield('content')


@include('layouts.frontend.partials.footer')

		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script src="/assets/public/js/site.js?v={{uniqid()}}"></script>
        <script src="/js/scripts.js?v={{uniqid()}}"></script>
	</body>
</html>
