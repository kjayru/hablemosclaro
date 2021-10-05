@extends('layouts.frontend.app')
@section('content')

    <aside class="limit breadcrumb">
        <a class="breadcrumb__link" href="/"><img src="/assets/public/images/ico_home.png" alt="Inicio" loading="lazy" /></a>
        <span class="breadcrumb__space"></span>
        <a class="breadcrumb__link" href="/{{ $categoria }}">{{ $categoria }}</a>
    </aside>

    <section class="section limit listado_de_articulos">
        <header class="listado_de_articulos__header">
            <h1 class="g-bigtitle">{{ @$category->nombre }}</h1>
            <h2 class="g-title">Artículos</h2>
            <img src="/assets/public/images/ico_show_filter.png" loading="lazy" alt="Mostrar filtros"
                class="listado_de_articulos__showfilter fnShowFilter" />
        </header>

        <nav class="listado_de_articulos__nav {{ !is_null($categorias) && !is_null($categorias[0]->parent_id) ? '':'m--empty' }}">
            @if( !is_null($categorias) && !is_null($categorias[0]->parent_id) )
            <ul class="listado_de_articulos__nav__inset">
                <li class="listado_de_articulos__nav__item"><a href="/{{$categoria}}" class="listado_de_articulos__nav__link -active-">Todo</a>
                </li>
                @foreach($categorias as $cat)
                <li class="listado_de_articulos__nav__item">
                    <a href="/{{$categoria}}/{{$cat->slug}}" class="listado_de_articulos__nav__link ">{{ $cat->nombre}}</a>
                </li>
                @endforeach
            </ul>
            @endif
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
            @if(isset($articulos))
                @foreach($articulos as $post)

                    <article class="columnas__item" data-order="{{@$post['id']}}">
                        <picture class="columnas__item__image">
                            <img src="/storage/{{@$post['card']}}" alt="" loading="lazy">
                        </picture>
                        <header class="columnas__item__header">
                            <strong class="columnas__item__subtitle">{{ @$post['categoria']->nombre}}</strong>
                            <time class="columnas__item__date">{{@$post['date_publish']}}</time>
                            <h3 class="columnas__item__title">{{ @$post['titulo']}}</h3>
                            <aside class="columnas__item__timer"> {{@$post['lectura']}} min de lectura</aside>
                        </header>
                        @if($post['subcategoria']!='')
                        <a href="/{{@$post['categoria']->slug}}/{{@$post['subcategoria']->slug}}/{{$post["slug"]}}" class="columnas__item__link">--Más información</a>
                        @else
                        <a href="/{{@$post['categoria']->slug}}/{{@$post["slug"]}}" class="columnas__item__link">Más información</a>
                        @endif
                    </article>
                @endforeach
            @endif

            <div class="g-button-group">
                <a href="#" class="g-button m--211 fnShowMoreArticles">Ver más</a>
            </div>
        </div>
    </section>

@include('layouts.frontend.partials.columna')
@include('layouts.frontend.partials.video')
@endsection
