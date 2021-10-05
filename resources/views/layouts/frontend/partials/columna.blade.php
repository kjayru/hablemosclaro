<section class="section columnas">
    <header class="limit columnas__header">
        <h4 class="g-title m--swiper">Columnas de opinión</h4>
        <a href="/articulos/columna" class="columnas__link">Ver todo</a>
    </header>
    <div class="limit columnas__list m--default fnSetSwiper" data-swiper="4_columnas" data-swiper-activate="active">
    @if($columns != null)
    @foreach($columns as $col)
        <article class="columnas__item">
            <picture class="columnas__item__image">
                <img src="/storage/{{ @$col['card'] }}" alt="" loading="lazy">
            </picture>
            <header class="columnas__item__header">
                <strong class="columnas__item__subtitle">{{@$col['categoria']->nombre}}</strong>
                <time class="columnas__item__date">{{ @$col['date_publish']}}</time>
                <h3 class="columnas__item__title">{{@$col['titulo']}}</h3>
               <aside class="columnas__item__timer">{{@$col['lectura']}} min de lectura</aside>
                <div class="columnas__item__author">
                    <img src="/storage/{{ @$col['foto']}}" alt="">
                    <p>
                        <strong>{{ @$col['nombre']}}</strong>
                        {{ @$col['cargo']}}
                    </p>
                </div>
            </header>
            @if(isset($col['subcategoria']))
                <a href="/{{@$col['categoria']->slug}}/{{@$col['subcategoria']->slug}}/{{@$col['slug']}}" class="columnas__item__link">_Más información</a>
            @else
                <a href="/{{@$col['categoria']->slug}}/{{@$col['slug']}}" class="columnas__item__link">Más información</a>
            @endif
        </article>
    @endforeach
    @endif
    </div>
    <div class="limit g-button-group">
        <a href="/articulos/columna" class="g-button m--330">Ver todo</a>
    </div>
</section>
