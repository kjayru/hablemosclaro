@extends('layouts.frontend.app')
@section('content')



<aside class="limit breadcrumb">
    <a class="breadcrumb__link" href="/"><img src="/assets/public/images/ico_home.png" alt="Inicio"
            loading="lazy" /></a>

</aside>

<section class="section limit listado_de_articulos">
    <header class="listado_de_articulos__header">
        <h2 class="g-bigtitle">{{ @$word }}</h2>
        <h3 class="g-title">Resultados de busqueda</h3>
        <img src="/assets/public/images/ico_show_filter.png" loading="lazy" alt="Mostrar filtros"
            class="listado_de_articulos__showfilter fnShowFilter" />
    </header>



    <div class="listado_de_articulos__list">

        @foreach($posts as $post)

            <article class="columnas__item">
                <picture class="columnas__item__image">
                    <img src="/storage/{{@$post['imagen']}}" alt="" loading="lazy">
                </picture>
                <header class="columnas__item__header">
                    <strong class="columnas__item__subtitle">{{ @$post['category']->nombre}}</strong>
                    <time class="columnas__item__date">{{@$post['date_publish']}}</time>
                    <h3 class="columnas__item__title">{{ @$post['titulo']}}</h3>
                    <!--<aside class="columnas__item__timer">5 min de lectura</aside>-->
                </header>
                @if(isset($post['subcategory']))
                <a href="/{{$post['category']->slug}}/{{$post['subcategory']->slug}}/{{$post['slug']}}" class="columnas__item__link">Más información</a>
                @else
                <a href="/{{$post['category']->slug}}/{{$post['slug']}}" class="columnas__item__link">Más información</a>
                @endif
            </article>

        @endforeach


    </div>
</section>
@endsection

