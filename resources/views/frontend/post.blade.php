@extends('layouts.frontend.app')
@section('content')

    <aside class="limit breadcrumb">
        <a class="breadcrumb__link" href="#"><img src="/assets/public/images/ico_home.png" alt="Inicio"
                loading="lazy" /></a>
        <span class="breadcrumb__space"></span>
        <a class="breadcrumb__link" href="#">Columnas de opinión</a>
    </aside>

    <section class="section limit m--detalle detalle_de_articulos">
        <article class="detalle_de_articulos__article">
            <figure class="detalle_de_articulos__article__image">
                <img src="/storage/{{ $articulo->banner }}" alt="">
            </figure>
            <header class="columnas__item__header">
                <strong class="columnas__item__subtitle">{{ $articulo->category->nombre }}</strong>
                <h3 class="columnas__item__title">{{ $articulo->titulo }}</h3>
                <time class="columnas__item__date">14 de mayo, 2021</time>
                <!--<aside class="columnas__item__timer">5 min de lectura</aside>-->

              @if(count($articulo->authors)>0))
                <div class="columnas__item__author">
                    <img src="/assets/public/images/author.png" alt="" loading="lazy" width="46" height="46" />
                    <p>
                        <strong>Por Juan Rivadeneyra</strong>
                        Director de Asuntos regulatorios.
                    </p>
                </div>
                @endif

            </header>
            <div class="detalle_de_articulos__article__content">

                {!!$articulo->contenido!!}
            </div>

        </article>

        <aside class="detalle_de_articulos__sidebar">
            <form action="" method="post" class="detalle_de_articulos__subscribe">
                <strong class="detalle_de_articulos__subscribe__title">Suscríbete</strong>
                <p class="detalle_de_articulos__subscribe__text">Y recibe lo mejor de nuestro contenido todas las semanas
                </p>
                <input type="email" name="email" placeholder="Correo electrónico"
                    class="detalle_de_articulos__subscribe__input" />
                <strong class="detalle_de_articulos__subscribe__subtitle">Temas de interés</strong>
                <div class="detalle_de_articulos__subscribe__checkboxes">
                    <label class="detalle_de_articulos__subscribe__checkbox">
                        <input type="checkbox" name="interes" value="Innovación">
                        <div></div>
                        <p>Innovación</p>
                    </label>
                    <label class="detalle_de_articulos__subscribe__checkbox">
                        <input type="checkbox" name="interes" value="Entretenimiento">
                        <div></div>
                        <p>Entretenimiento</p>
                    </label>
                    <label class="detalle_de_articulos__subscribe__checkbox">
                        <input type="checkbox" name="interes" value="Negocios">
                        <div></div>
                        <p>Negocios</p>
                    </label>
                    <label class="detalle_de_articulos__subscribe__checkbox">
                        <input type="checkbox" name="interes" value="Seguridad">
                        <div></div>
                        <p>Seguridad</p>
                    </label>
                    <label class="detalle_de_articulos__subscribe__checkbox">
                        <input type="checkbox" name="interes" value="Aprendiendo Claro">
                        <div></div>
                        <p>Aprendiendo Claro</p>
                    </label>
                    <label class="detalle_de_articulos__subscribe__checkbox">
                        <input type="checkbox" name="interes" value="Compromiso">
                        <div></div>
                        <p>Compromiso</p>
                    </label>
                </div>
                <button class="g-button m--rojo m--mini">Suscribirme</button>
            </form>
            <section class="detalle_de_articulos__recomendados">
                <h4 class="detalle_de_articulos__recomendados__title">Te puede interesar</h4>
                <article class="columnas__item">
                    <header class="columnas__item__header">
                        <strong class="columnas__item__subtitle">Compromiso</strong>
                        <h3 class="columnas__item__title">Conectados para el teletrabajo, la teleducación, la telesalud y
                            teletrabajososo</h3>
                        <aside class="columnas__item__timer">5 min de lectura</aside>
                    </header>
                    <a href="#" class="columnas__item__link">Más información</a>
                </article>
                <article class="columnas__item">
                    <header class="columnas__item__header">
                        <strong class="columnas__item__subtitle">Compromiso</strong>
                        <h3 class="columnas__item__title">Conectados para el teletrabajo, la teleducación, la telesalud y
                            teletrabajososo</h3>
                        <aside class="columnas__item__timer">5 min de lectura</aside>
                    </header>
                    <a href="#" class="columnas__item__link">Más información</a>
                </article>
                <article class="columnas__item">
                    <header class="columnas__item__header">
                        <strong class="columnas__item__subtitle">Compromiso</strong>
                        <h3 class="columnas__item__title">Conectados para el teletrabajo, la teleducación, la telesalud y
                            teletrabajososo</h3>
                        <aside class="columnas__item__timer">5 min de lectura</aside>
                    </header>
                    <a href="#" class="columnas__item__link">Más información</a>
                </article>
                <article class="columnas__item">
                    <header class="columnas__item__header">
                        <strong class="columnas__item__subtitle">Compromiso</strong>
                        <h3 class="columnas__item__title">Conectados para el teletrabajo, la teleducación, la telesalud y
                            teletrabajososo</h3>
                        <aside class="columnas__item__timer">5 min de lectura</aside>
                    </header>
                    <a href="#" class="columnas__item__link">Más información</a>
                </article>
            </section>
        </aside>
        <aside class="detalle_de_articulos__socials">
            <a href="#"><img src="/assets/public/images/social_facebook.png" alt="Compartir en Facebook"
                    loading="lazy" /></a>
            <a href="#"><img src="/assets/public/images/social_twitter.png" alt="Compartir en Facebook"
                    loading="lazy" /></a>
            <a href="#"><img src="/assets/public/images/social_wsp.png" alt="Compartir en Facebook" loading="lazy" /></a>
            <a href="#"><img src="/assets/public/images/social_gmail.png" alt="Compartir en Facebook" loading="lazy" /></a>
            <a href="#"><img src="/assets/public/images/social_linkedin.png" alt="Compartir en Facebook"
                    loading="lazy" /></a>
            <a href="#"><img src="/assets/public/images/social_msn.png" alt="Compartir en Facebook" loading="lazy" /></a>
            <a href="#"><img src="/assets/public/images/social_telegram.png" alt="Compartir en Facebook"
                    loading="lazy" /></a>
            <a href="#"><img src="/assets/public/images/social_pinterest.png" alt="Compartir en Facebook"
                    loading="lazy" /></a>
            <span class="detalle_de_articulos__socials__open fnShowSocials"><img src="/assets/public/images/social_more.png"
                    alt="Mostrar más opciones" /></span>
            <span class="detalle_de_articulos__socials__close fnShowSocials"><img
                    src="/assets/public/images/social_close.png" alt="Ocultar opciones" /></span>
        </aside>
    </section>
@endsection
