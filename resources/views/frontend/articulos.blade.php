@extends('layouts.frontend.app')
@section('content')

    <aside class="limit breadcrumb">
        <a class="breadcrumb__link" href="/"><img src="/assets/public/images/ico_home.png" alt="Inicio"
                loading="lazy" /></a>
        <span class="breadcrumb__space"></span>
        <a class="breadcrumb__link" href="/articulos/{{ $posttype->tipo }}">{{ $posttype->tipo }}</a>
    </aside>

    <section class="section limit listado_de_articulos">
        <header class="listado_de_articulos__header">
            <h2 class="g-bigtitle">{{ @$posttype->tipo }}</h2>
            <h3 class="g-title">Artículos</h3>
            <img src="/assets/public/images/ico_show_filter.png" loading="lazy" alt="Mostrar filtros"
                class="listado_de_articulos__showfilter fnShowFilter" />
        </header>

        <nav class="listado_de_articulos__nav">
            <ul class="listado_de_articulos__nav__inset">
                <li class="listado_de_articulos__nav__item"><a href="/articulos/{{ $posttype->tipo }}" class="listado_de_articulos__nav__link -active-">Todo</a>
                </li>
                @if(!is_null($categorias))
                    @foreach($categorias as $cat)
                    <li class="listado_de_articulos__nav__item">
                        <a href="/{{$cat->slug}}" class="listado_de_articulos__nav__link ">{{ $cat->nombre}}</a>
                    </li>
                    @endforeach
                @endif
            </ul>
            <form id="filtro_de_articulos" action="" method="get" class="listado_de_articulos__filter">
                <strong class="listado_de_articulos__filter__title">Organizar por:<span
                        class="header__button-mobile -active- fnCloseFilter"><span></span></span></strong>
                <div class="listado_de_articulos__filter__select">
                    <span class="listado_de_articulos__filter__select__title fnFilterOptionsTitle">Más recientes</span>
                    <span class="listado_de_articulos__filter__options fnFilterOptions">
                        <a href="#" class="-active-" data-order="recent">Más recientes</a>
                        <a href="#" data-order="older">Más antiguos</a>
                    </span>
                </div>
            </form>
        </nav>

        <div class="listado_de_articulos__list">

            @foreach($articulos as $post)

                <article class="columnas__item" data-order="{{@$post->id}}" @if(isset($post->categories[0]->parent))  data-category="{{@$post->categories[0]->parent->slug}}" @else data-category="{{@$post->categories[0]->slug}}" @endif>
                    <picture class="columnas__item__image">
                        <img src="/storage/{{ @$post->imagenbox }}" alt="" loading="lazy">
                    </picture>
                    <header class="columnas__item__header">
                        <strong class="columnas__item__subtitle">{{ @$post->categories[0]->nombre }}</strong>
                        <time class="columnas__item__date">{{ @$post->date_publish }}</time>
                        <h3 class="columnas__item__title">{{ @$post->titulo }}</h3>
                        <!--<aside class="columnas__item__timer">5 min de lectura</aside>-->
                    </header>
                    @if(isset($post->categories[0]->parent))
                    <a href="/{{@$post->categories[0]->parent->slug}}/{{@$post->categories[0]->slug}}/{{@$post->slug}}" class="columnas__item__link">Más información</a>
                    @else
                    <a href="/{{@$post->categories[0]->slug}}/{{@$post->slug}}" class="columnas__item__link">Más información</a>
                    @endif
                </article>

            @endforeach

            <div class="g-button-group">
                <a href="#" class="g-button m--211">Ver más</a>
            </div>
        </div>
    </section>





@endsection
