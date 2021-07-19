@extends('layouts.frontend.app')
@section('content')

    <aside class="limit breadcrumb">
        <a class="breadcrumb__link" href="/"><img src="/assets/public/images/ico_home.png" alt="Inicio"
                loading="lazy" /></a>
        <span class="breadcrumb__space"></span>
        <a class="breadcrumb__link" href="/{{ $categoria }}">{{ $categoria }}</a>
    </aside>

    <section class="section limit listado_de_articulos">
        <header class="listado_de_articulos__header">
            <h2 class="g-bigtitle">{{ @$category->nombre }}</h2>
            <h3 class="g-title">Artículos</h3>
            <img src="/assets/public/images/ico_show_filter.png" loading="lazy" alt="Mostrar filtros"
                class="listado_de_articulos__showfilter fnShowFilter" />
        </header>

        <nav class="listado_de_articulos__nav">
            <ul class="listado_de_articulos__nav__inset">
                <li class="listado_de_articulos__nav__item"><a href="/{{$categoria}}" class="listado_de_articulos__nav__link -active-">Todo</a>
                </li>
                @if(!is_null($categorias))
                    @foreach($categorias as $cat)
                    <li class="listado_de_articulos__nav__item">
                        <a href="/{{$categoria}}/{{$cat->slug}}" class="listado_de_articulos__nav__link ">{{ $cat->nombre}}</a>
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

            <article class="columnas__item" data-order="{{$post->id}}">
                <picture class="columnas__item__image">
                    <img src="/storage/{{$post->imagenbox}}" alt="" loading="lazy">
                </picture>
                <header class="columnas__item__header">
                    <strong class="columnas__item__subtitle">{{ $post->category->nombre}}</strong>
                    <time class="columnas__item__date">{{$post->date_publish}}</time>
                    <h3 class="columnas__item__title">{{ $post->titulo}}</h3>
                    <!--<aside class="columnas__item__timer">5 min de lectura</aside>-->
                </header>
                <a href="/{{$categoria}}/{{$post->slug}}" class="columnas__item__link">Más información</a>
            </article>

        @endforeach

            <div class="g-button-group">
                <a href="#" class="g-button m--211">Ver más</a>
            </div>
        </div>
    </section>





@endsection