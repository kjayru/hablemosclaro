@extends('layouts.frontend.app')
@section('content')

    <section class="slider_principal fnSetSwiper" data-swiper="slider_principal" data-swiper-activate="active"
        data-swiper-arrows="assets/public/images/slider_arrow.png">

        @foreach($sliders as $slide)
            <article class="slider_principal__item">
                <picture class="slider_principal__item__image">
                    <img src="/storage/{{@$slide->banner}}" alt="" loading="lazy">
                </picture>
                <header class="slider_principal__item__header">
                    <strong class="slider_principal__item__subtitle">{{@$slide->category->nombre}}</strong>
                    <time class="slider_principal__item__date">{{@$slide->publish_date}}</time>
                    <h3 class="slider_principal__item__title">{{@$slide->titulo}}</h3>
                    <!--<aside class="slider_principal__item__timer">5 min de lectura</aside>-->
                </header>
                @if(isset($slide->category->parent))
                    <a href="/{{@$slide->category->parent->slug}}/{{@$slide->category->slug}}/{{@$slide->slug}}" class="slider_principal__item__link">Más información</a>
                @else
                    <a href="/{{@$slide->category->slug}}/{{@$slide->slug}}" class="slider_principal__item__link">Más información</a>
                @endif
            </article>
        @endforeach

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
                        <time class="lo_ultimo__item__date">{{ @$post->created_at }}</time>
                        <h3 class="lo_ultimo__item__title">{{ $post->titulo}}</h3>
                        <!--<aside class="lo_ultimo__item__timer">5 min de lectura</aside>-->
                    </header>
                    <a href="/{{@$post->category->slug}}/{{@$post->slug}}" class="lo_ultimo__item__link">Más información</a>
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
                    <a class="categorias__item__link" href="/{{$cat->slug}}">
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
        <header class="limit columnas__header">
            <h2 class="g-title m--swiper">Columnas de opinión</h2>
            <a href="/articulos/columna" class="columnas__link">Ver todo</a>
        </header>
        <div class="limit columnas__list m--default fnSetSwiper" data-swiper="4_columnas" data-swiper-activate="active">
        @if($columns != null)
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
        @endif
        </div>
        <div class="limit g-button-group">
            <a href="/articulos/columna" class="g-button m--330">Ver todo</a>
        </div>
    </section>

   @include('layouts.frontend.partials.video')


@endsection
