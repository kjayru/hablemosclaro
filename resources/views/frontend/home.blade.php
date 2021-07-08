@extends('layouts.frontend.app')
@section('content')

    <section class="slider_principal fnSetSwiper" data-swiper="slider_principal" data-swiper-activate="active"
        data-swiper-arrows="assets/public/images/slider_arrow.png">
        <article class="slider_principal__item">
            <picture class="slider_principal__item__image">
                <img src="assets/public/images/slider_principal.png" alt="" loading="lazy">
            </picture>
            <header class="slider_principal__item__header">
                <strong class="slider_principal__item__subtitle">Compromiso</strong>
                <time class="slider_principal__item__date">14 set 2021</time>
                <h3 class="slider_principal__item__title">Conectados para el teletrabajo, la teleducación, la telesalud y
                    teletrabajo</h3>
                <aside class="slider_principal__item__timer">5 min de lectura</aside>
            </header>
            <a href="#" class="slider_principal__item__link">Más información</a>
        </article>
        <article class="slider_principal__item">
            <picture class="slider_principal__item__image">
                <img src="assets/public/images/slider_principal.png" alt="" loading="lazy">
            </picture>
            <header class="slider_principal__item__header">
                <strong class="slider_principal__item__subtitle">Compromiso</strong>
                <time class="slider_principal__item__date">14 set 2021</time>
                <h3 class="slider_principal__item__title">Conectados para el teletrabajo, la teleducación, la telesalud y
                    teletrabajo</h3>
                <aside class="slider_principal__item__timer">5 min de lectura</aside>
            </header>
            <a href="#" class="slider_principal__item__link">Más información</a>
        </article>
    </section>


    <section class="section lo_ultimo">
        <h2 class="limit g-title m--swiper">Lo último</h2>
        <div class="limit lo_ultimo__list m--default fnSetSwiper" data-swiper="4_columnas" data-swiper-activate="active">

            @foreach($articulos as $post)

            <article class="lo_ultimo__item">
                <picture class="lo_ultimo__item__image">
                    <img src="{{ $post->imagenbox }}" alt="" loading="lazy">
                </picture>
                <header class="lo_ultimo__item__header">
                    <strong class="lo_ultimo__item__subtitle">{{ $post->category->nombre}}</strong>
                    <time class="lo_ultimo__item__date">{{ $post->created_at->format('d M Y')}}</time>
                    <h3 class="lo_ultimo__item__title">{{ $post->titulo}}</h3>
                    <!--<aside class="lo_ultimo__item__timer">5 min de lectura</aside>-->
                </header>
                <a href="#" class="lo_ultimo__item__link">Más información</a>
            </article>
            @endforeach

        </div>
    </section>


    <section class="section categorias">
        <div class="limit">
            <h3 class="g-title">Categorías</h3>
            <ul class="categorias__list">

            @foreach($categorias as $cat)
                <li class="categorias__item">
                    <a class="categorias__item__link" href="">
                        <figure class="categorias__item__image">
                            <img src="{{ $cat->icono}}" alt="" loading="lazy">
                        </figure>
                        <strong class="categorias__item__title">{{ $cat->nombre}}</strong>
                    </a>
                </li>
            @endforeach

            </ul>
        </div>
    </section>
    <section class="section columnas">
        <h2 class="limit g-title m--swiper">Columnas de opinión</h2>
        <div class="limit columnas__list m--default fnSetSwiper" data-swiper="4_columnas" data-swiper-activate="active">


        </div>
    </section>
    <section class="section m--bg ultimos_videos">
        <div class="limit">
            <h3 class="g-title m--white">Últimos videos</h3>
            <div class="ultimos_videos__list">

                <article class="ultimos_videos__item m--principal fnShowVideoTarget">
                    <iframe class="ultimos_videos__item__video" src="https://www.youtube-nocookie.com/embed/eZqPTacPn-g"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe></iframe>
                    <header class="ultimos_videos__item__header">
                        <strong class="ultimos_videos__item__subtitle">{{ $videos[0]->category->nombre }}</strong>
                        <h4 class="ultimos_videos__item__title">{{ $videos[0]->titulo }}</h4>
                    </header>
                </article>
                <div class="ultimos_videos__sublist">

                  @foreach($videos as $key=>$vid)
                    @if($key>0)
                    <article class="ultimos_videos__item fnShowVideoButton" data-video="eZqPTacPn-g">
                        <picture class="ultimos_videos__item__image">
                            <img src="assets/public/images/ultimos_videos.png" alt="" loading="lazy">
                            <span class="ultimos_videos__item__image__timer">2 min</span>
                        </picture>
                        <header class="ultimos_videos__item__header">
                            <strong class="ultimos_videos__item__subtitle">{{ $vid->category->nombre}}</strong>
                            <h4 class="ultimos_videos__item__title">{{ $vid->titulo }}</h4>
                        </header>
                    </article>
                    @endif
                @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection
