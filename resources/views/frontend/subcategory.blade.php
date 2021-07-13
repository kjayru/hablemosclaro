@extends('layouts.frontend.app')
@section('content')



    <span class="header__height"></span>

    <div id="search" class="search">
        <div class="search__content">
            <span class="search__content__back fnShowSearchform"><img src="/assets/public/images/ico_back.png"
                    alt="" /></span>
            <form action="/hablandoclaro/search_results.json" class="search__form fnSearchForm" method="post"
                data-tipo="search_form">
                <input type="text" name="q" placeholder="Buscar en Hablando Claro"
                    class="search__form__input fnSearchFormInput">
                <button type="submit" class="search__form__button">Buscar</button>
                <img src="/assets/public/images/ico_clean_search.png" alt="Limpiar busqueda" loading="lazy"
                    class="search__form__clean fnSearchFormClean">
            </form>
            <div class="search__results fnSearchResults">
                <strong class="search__results__title">Resultados</strong>
                <div class="search__results__data fnSearchResultsData"></div>
            </div>
            <strong class="search__results__title m--2">Más buscados</strong>
            <aside class="search__results__wanted">
                <a href="#">Teletrabajo</a>
                <a href="#">Gaming</a>
                <a href="#">Entretenimiento digital</a>
                <a href="#">Innovación</a>
            </aside>
        </div>
    </div>

    <aside class="limit breadcrumb">
        <a class="breadcrumb__link" href="#"><img src="/assets/public/images/ico_home.png" alt="Inicio"
                loading="lazy" /></a>
        <span class="breadcrumb__space"></span>
        <a class="breadcrumb__link" href="#">Negocios</a>
    </aside>

    <section class="section limit listado_de_articulos">
        <header class="listado_de_articulos__header">
            <h2 class="g-bigtitle">Negocios</h2>
            <h3 class="g-title">Artículos</h3>
            <img src="/assets/public/images/ico_show_filter.png" loading="lazy" alt="Mostrar filtros"
                class="listado_de_articulos__showfilter fnShowFilter" />
        </header>

        <nav class="listado_de_articulos__nav">
            <ul class="listado_de_articulos__nav__inset">
                <li class="listado_de_articulos__nav__item"><a href="/{{$categoria}}" class="listado_de_articulos__nav__link">Todo</a>
                </li>
                @if($categorias == null)

                    @foreach($categorias as $cat)
                    <li class="listado_de_articulos__nav__item">
                        @php
                            $seturl = env('APP_URL')."/".$categoria."/".$cat->slug;
                        @endphp
                            <a href="/{{$categoria}}/{{$cat->slug}}" class="listado_de_articulos__nav__link @if($current_url == $seturl) -active- @endif">{{ $cat->nombre}}</a>
                    </li>
                    @endforeach
                @endif
            </ul>
            <form id="filtro_de_articulos" action="" method="get" class="listado_de_articulos__filter">
                <strong class="listado_de_articulos__filter__title">Organizar por:<span
                        class="header__button-mobile -active- fnCloseFilter"><span></span></span></strong>
                <div class="listado_de_articulos__filter__select">
                    <span class="listado_de_articulos__filter__select__title">Más recientes</span>
                    <span class="listado_de_articulos__filter__options">
                        <a href="#" class="-active-">Todo</a>
                        <a href="#">Más recientes</a>
                        <a href="#">Más antiguos</a>
                    </span>
                </div>
            </form>
        </nav>

        <div class="listado_de_articulos__list">

        @foreach($articulos as $post)
            <article class="columnas__item">
                <picture class="columnas__item__image">
                    <img src="/storage/{{$post->imagenbox}}" alt="" loading="lazy">
                </picture>
                <header class="columnas__item__header">
                    <strong class="columnas__item__subtitle">{{ $post->category->nombre}}</strong>
                    <time class="columnas__item__date">14 set 2021</time>
                    <h3 class="columnas__item__title">{{ $post->titulo}}</h3>
                    <aside class="columnas__item__timer">5 min de lectura</aside>
                </header>
                <a href="/{{$categoria}}/{{$subcategoria}}/{{$post->slug}}" class="columnas__item__link">Más información</a>
            </article>
        @endforeach

            <div class="g-button-group">
                <a href="#" class="g-button m--211">Ver más</a>
            </div>
        </div>
    </section>
    <section class="section columnas">
        <header class="limit columnas__header">
            <h2 class="g-title m--swiper">Columnas de opinión</h2>
            <a href="listado_de_articulos.php" class="columnas__link">Ver todo</a>
        </header>



        <div class="limit columnas__list m--default fnSetSwiper" data-swiper="4_columnas" data-swiper-activate="active">


            <article class="columnas__item">
                <picture class="columnas__item__image">
                    <img src="/assets/public/images/columnas.png" alt="" loading="lazy">
                </picture>
                <header class="columnas__item__header">
                    <strong class="columnas__item__subtitle">Compromiso</strong>
                    <time class="columnas__item__date">14 set 2021</time>
                    <h3 class="columnas__item__title">Conectados para el teletrabajo, la teleducación, la telesalud y
                        teletrabajo</h3>
                    <aside class="columnas__item__timer">5 min de lectura</aside>
                    <div class="columnas__item__author">
                        <img src="/assets/public/images/author.png" alt="">
                        <p>
                            <strong>Por Juan Rivadeneyra</strong>
                            Director de Asuntos regulatorios.
                        </p>
                    </div>
                </header>
                <a href="#" class="columnas__item__link">Más información</a>
            </article>




        </div>
        <div class="limit g-button-group">
            <a href="#" class="g-button m--330">Ver todo</a>
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
                        <strong class="ultimos_videos__item__subtitle">Telecomunicaciones</strong>
                        <h4 class="ultimos_videos__item__title">Para de sufrir con Claro Hogar</h4>
                    </header>
                </article>
                <div class="ultimos_videos__sublist">
                    <article class="ultimos_videos__item -active- fnShowVideoButton" data-video="eZqPTacPn-g">
                        <picture class="ultimos_videos__item__image">
                            <img src="/assets/public/images/ultimos_videos.png" alt="" loading="lazy">
                            <span class="ultimos_videos__item__image__timer">2 min</span>
                        </picture>
                        <header class="ultimos_videos__item__header">
                            <strong class="ultimos_videos__item__subtitle">Telecomunicaciones</strong>
                            <h4 class="ultimos_videos__item__title">Para de sufrir con Claro Hogar</h4>
                        </header>
                    </article>
                    <article class="ultimos_videos__item fnShowVideoButton" data-video="BqsiXNf6MY8">
                        <picture class="ultimos_videos__item__image">
                            <img src="/assets/public/images/ultimos_videos.png" alt="" loading="lazy">
                            <span class="ultimos_videos__item__image__timer">2 min</span>
                        </picture>
                        <header class="ultimos_videos__item__header">
                            <strong class="ultimos_videos__item__subtitle">Telecomunicaciones</strong>
                            <h4 class="ultimos_videos__item__title">Mi postpago Claro es un buen plan</h4>
                        </header>
                    </article>
                    <article class="ultimos_videos__item fnShowVideoButton" data-video="_UazSahzbYw">
                        <picture class="ultimos_videos__item__image">
                            <img src="/assets/public/images/ultimos_videos.png" alt="" loading="lazy">
                            <span class="ultimos_videos__item__image__timer">2 min</span>
                        </picture>
                        <header class="ultimos_videos__item__header">
                            <strong class="ultimos_videos__item__subtitle">Telecomunicaciones</strong>
                            <h4 class="ultimos_videos__item__title">¡Conoce nuestros 3 sorteos por el día del padre!</h4>
                        </header>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
