@extends('layouts.frontend.app')
@section('content')

    <aside class="limit breadcrumb">
        <a class="breadcrumb__link" href="/"><img src="/assets/public/images/ico_home.png" alt="Inicio"
                loading="lazy" /></a>
        <span class="breadcrumb__space"></span>
        <a class="breadcrumb__link" href="/{{ @$category->parent->slug }}">{{ @$category->parent->slug }}</a>
        <span class="breadcrumb__space"></span>
        <a class="breadcrumb__link" href="/{{ @$category->parent->slug }}/{{ $category->slug }}">{{ $category->slug }}</a>
    </aside>

    <section class="section limit listado_de_articulos">
        <header class="listado_de_articulos__header">
            <h2 class="g-bigtitle">{{ @$category->parent->nombre }}</h2>
            <h3 class="g-title">Artículos</h3>
            <img src="/assets/public/images/ico_show_filter.png" loading="lazy" alt="Mostrar filtros"
                class="listado_de_articulos__showfilter fnShowFilter" />
        </header>

        <nav class="listado_de_articulos__nav">

            <ul class="listado_de_articulos__nav__inset">
                <li class="listado_de_articulos__nav__item"><a href="/{{$categoria}}" class="listado_de_articulos__nav__link">Todo</a>
                </li>
                @if(isset($categorias))

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


            @foreach($columns as $col)
            <article class="columnas__item">
                <picture class="columnas__item__image">
                    <img src="/storage/{{ @$col->imagenbox }}" alt="" loading="lazy">
                </picture>
                <header class="columnas__item__header">
                    <strong class="columnas__item__subtitle">{{@$col->category->nombre}}</strong>
                    <time class="columnas__item__date">{{ @$col->date_publish}}</time>
                    <h3 class="columnas__item__title">{{@$col->titulo}}</h3>
                   <!-- <aside class="columnas__item__timer">5 min de lectura</aside>-->
                    <div class="columnas__item__author">
                        <img src="/storage/{{ @$col->authors[0]->imagen}}" alt="">
                        <p>
                            <strong>{{ @$col->authors[0]->nombre}}</strong>
                            {{ @$col->authors[0]->cargo}}
                        </p>
                    </div>
                </header>
                <a href="{{@$col->category->slug}}/{{@$col->slug}}" class="columnas__item__link">Más información</a>
            </article>
        @endforeach




        </div>
        <div class="limit g-button-group">
            <a href="#" class="g-button m--330">Ver todo</a>
        </div>
    </section>


    @include('layouts.frontend.partials.video')
@endsection
