@extends('layouts.frontend.app')
@section('content')

 @if(session('info'))
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        {{ session('info')}}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <section class="slider_principal fnSetSwiper" data-swiper="slider_principal" data-swiper-activate="active"
        data-swiper-arrows="assets/public/images/slider_arrow.png">

        @foreach($sliders as $slide)
            <article class="slider_principal__item">
                <picture class="slider_principal__item__image">
                    <source media="(max-width:800px)" srcset="/storage/{{@$slide['movil']}}">
                    <source media="(max-width:1024px)" srcset="/storage/{{@$slide['tablet']}}">
                    <img src="/storage/{{@$slide['banner']}}" alt="" loading="lazy">
                </picture>
                <header class="slider_principal__item__header">
                    <strong class="slider_principal__item__subtitle">{{@$slide['categoria']->nombre}}</strong>
                    <time class="slider_principal__item__date">{{@$slide['date_publish']}}</time>
                    <h3 class="slider_principal__item__title">{{@$slide['titulo']}}</h3>

                    <aside class="slider_principal__item__timer">{{@$slide['lectura']}} min de lectura</aside>
                </header>
                @if(isset($slide['subcategoria']))
                    <a href="/{{@$slide['categoria']->slug}}/{{@$slide['subcategoria']->slug}}/{{@$slide['slug']}}" class="slider_principal__item__link">Más información</a>
                @else
                    <a href="/{{@$slide['categoria']->slug}}/{{@$slide['slug']}}" class="slider_principal__item__link">Más información</a>
                @endif
            </article>
        @endforeach

    </section>


    <section class="section lo_ultimo">
        <h2 class="limit g-title m--swiper">Lo más leido</h2>
        <div class="limit lo_ultimo__list m--default fnSetSwiper" data-swiper="4_columnas" data-swiper-activate="active">


            @foreach($ultimos as $post)

                <article class="lo_ultimo__item">
                    <picture class="lo_ultimo__item__image">
                        <img src="/storage/{{ $post['card'] }}" alt="" loading="lazy">
                    </picture>
                    <header class="lo_ultimo__item__header">
                        <strong class="lo_ultimo__item__subtitle">{{ @$post['categoria']->nombre}}</strong>
                        <time class="lo_ultimo__item__date">{{ @$post['date_publish'] }}</time>
                        <h3 class="lo_ultimo__item__title">{{ $post['titulo']}}</h3>
                        <aside class="lo_ultimo__item__timer">{{@$post['lectura']}} min de lectura</aside>
                    </header>

                    @if(isset($post['subcategoria']))
                        <a href="/{{@$post['categoria']->slug}}/{{@$post['subcategoria']->slug}}/{{@$post['slug']}}" class="lo_ultimo__item__link">Más información</a>
                    @else
                        <a href="/{{@$post['categoria']->slug}}/{{@$post['slug']}}" class="lo_ultimo__item__link">Más información</a>
                    @endif
                </article>
            @endforeach

        </div>
    </section>


    <section class="section categorias">
        <div class="limit">
            <h3 class="g-title">Categorías</h3>
            <ul class="categorias__list">

            @foreach($categorias as $cat)
            @if($cat->slug!="otros")
                <li class="categorias__item">
                    <a class="categorias__item__link" href="/{{$cat->slug}}">
                        <figure class="categorias__item__image">
                            <img src="{{ $cat->icono}}" alt="" loading="lazy">
                        </figure>
                        <strong class="categorias__item__title">{{ $cat->nombre}}</strong>
                    </a>
                </li>
                @endif
            @endforeach

            </ul>
        </div>
    </section>

   @include('layouts.frontend.partials.columna')
   @include('layouts.frontend.partials.video')

@endsection
