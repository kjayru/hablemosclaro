@extends('layouts.frontend.app')
@section('content')

    <aside class="limit breadcrumb">
        <a class="breadcrumb__link" href="/"><img src="/assets/public/images/ico_home.png" alt="Inicio" loading="lazy" /></a>


    @if(isset($subcategoria))
        <span class="breadcrumb__space"></span>
        <a class="breadcrumb__link" href="/{{$categoria->slug}}">{{$categoria->nombre}}</a>
        <span class="breadcrumb__space"></span>
        <a class="breadcrumb__link" href="/{{$categoria->slug}}/{{$subcategoria->slug}}">{{$subcategoria->nombre}}</a>
    @endif

    @if(isset($categoria)&&!$subcategoria)
        <span class="breadcrumb__space"></span>
        <a class="breadcrumb__link" href="/{{$categoria->slug}}">{{$categoria->nombre}}</a>
    @endif



    </aside>

    <section class="section limit m--detalle detalle_de_articulos">
        <article class="detalle_de_articulos__article">
            <figure class="detalle_de_articulos__article__image">
                <img src="/storage/{{ $articulo->banner }}" alt="">
            </figure>
            <header class="columnas__item__header">
                <strong class="columnas__item__subtitle">{{ @$categoria->nombre }}</strong>
                <h3 class="columnas__item__title">{{ @$articulo->titulo }}</h3>
                <time class="columnas__item__date">14 de mayo, 2021</time>
                <!--<aside class="columnas__item__timer">5 min de lectura</aside>-->

            @if(isset($articulo->author)))
                <div class="columnas__item__author">
                    <img src="/storage/{{ @$articulo->author->imagen}}" alt="">
                    <p>
                        <strong>{{ @$articulo->author->nombre}}</strong>
                        {{ @$articulo->author->cargo}}
                    </p>
                </div>
            @endif

            </header>
            <div class="detalle_de_articulos__article__content">

                {!!$articulo->contenido!!}
            </div>

            <!--tags-->
            <aside class="detalle_de_articulos__article__tags">
                <strong class="detalle_de_articulos__article__tags__title">Etiquetas:</strong>

                <div class="detalle_de_articulos__article__tags__links">
                    @if(isset($articulo->tags))
                        @foreach ( $articulo->tags as $tg)
                        <a href="/tag/{{@$tg->slug}}">{{ @$tg->nombre }}</a>
                        @endforeach
                    @endif


                </div>
            </aside>

        </article>

        <!--redes-->
        <footer class="detalle_de_articulos__footer">
            <aside id="detalle-de-articulos-footer-socials" class="detalle_de_articulos__footer__socials m--hide">
                <strong class="detalle_de_articulos__footer__socials__title">¿Te gustó este artículo? Compártelo</strong>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="m--facebook">
                    <img src="/assets/public/images/social_facebook.png" alt="Compartir en Facebook" loading="lazy">
                    <span>Facebook</span>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}" target="_blank" class="m--twitter">
                    <img src="/assets/public/images/social_twitter.png" alt="Compartir en Twitter" loading="lazy">
                    <span>Twitter</span>
                </a>
                <a href="https://api.whatsapp.com/send?text={{ url()->current() }}" target="_blank" class="m--wsp">
                    <img src="/assets/public/images/social_wsp.png" alt="Compartir en Whatsapp" loading="lazy">
                    <span>Whatsapp</span>
                </a>
                <a href="mailto:info@example.com?&subject=&cc=&bcc=&body={{ url()->current() }}" target="_blank" class="m--gmail">
                    <img src="/assets/public/images/social_gmail.png" alt="Compartir en Gmail" loading="lazy">
                    <span>Gmail</span>
                </a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}" target="_blank" class="m--linkedin">
                    <img src="/assets/public/images/social_linkedin.png" alt="Compartir en Linkedin" loading="lazy">
                    <span>Linkedin</span>
                </a>
                <a href="http://www.facebook.com/dialog/send?app_id=1127021294451565&link={{ url()->current() }}&redirect_uri={{ url()->current() }}" target="_blank" class="m--msn">
                    <img src="/assets/public/images/social_msn.png" alt="Compartir en Messenger" loading="lazy">
                    <span>Mesenger</span>
                </a>
                <a href="https://t.me/share?url={{ url()->current() }}" target="_blank" class="m--telegram">
                    <img src="/assets/public/images/social_telegram.png" alt="Compartir en Telegram" loading="lazy">
                    <span>Telegram</span>
                </a>
                <a href="https://pinterest.com/pin/create/button/?url={{ url()->current() }}" target="_blank" class="m--pinterest">
                    <img src="/assets/public/images/social_pinterest.png" alt="Compartir en Pinterest" loading="lazy">
                    <span>Pinterest</span>
                </a>
                <span class="detalle_de_articulos__footer__socials__button fnShowFooterSocials"><span></span></span>
            </aside>
            <aside class="detalle_de_articulos__footer__bottom">

                @if($previous!=null)

                <span class="detalle_de_articulos__footer__bottom__block">
                    <strong><img src="/assets/public/images/ico_arrow_article.png" alt="">Artículo anterior</strong>

                    @if($previous['subcategory'])
                    <a href="/{{ @$previous['category']->slug}}/{{ @$previous['subcategory']->slug }}/{{ @$previous['slug'] }}">{{ @$previous['titulo'] }}</a>
                    @else
                    <a href="/{{ @$previous['category']->slug}}/{{ @$previous['slug'] }}">{{ @$previous['titulo'] }}</a>
                    @endif
                </span>
                @endif

                @if($next!=null)
                <span class="detalle_de_articulos__footer__bottom__block">
                    <strong>Artículo siguiente<img src="/assets/public/images/ico_arrow_article.png" alt=""></strong>

                    @if($next['subcategory'])
                    <a href="/{{ @$next['category']->slug}}/{{ @$next['subcategory']->slug}}/{{@$next['slug']}}">{{ @$next['titulo']}}</a>
                    @else
                    <a href="/{{ @$next['category']->slug}}/{{@$next['slug']}}">{{ @$next['titulo']}}</a>
                    @endif
                </span>
                @endif

            </aside>
        </footer>

        <!--sub-bloque-->





        <aside class="detalle_de_articulos__sidebar">
            <form action="/suscribirse" method="post" class="detalle_de_articulos__subscribe">
                @csrf
                <strong class="detalle_de_articulos__subscribe__title">Suscríbete</strong>
                <p class="detalle_de_articulos__subscribe__text">Y recibe lo mejor de nuestro contenido todas las semanas
                </p>
                <input type="email" name="email" id="email" placeholder="Correo electrónico"
                    class="detalle_de_articulos__subscribe__input" />
                <strong class="detalle_de_articulos__subscribe__subtitle">Temas de interés</strong>
                <div class="detalle_de_articulos__subscribe__checkboxes">
                    <label class="detalle_de_articulos__subscribe__checkbox">
                        <input type="checkbox" name="interes[]" value="Innovación">
                        <div></div>
                        <p>Innovación</p>
                    </label>
                    <label class="detalle_de_articulos__subscribe__checkbox">
                        <input type="checkbox" name="interes[]" value="Entretenimiento">
                        <div></div>
                        <p>Entretenimiento</p>
                    </label>
                    <label class="detalle_de_articulos__subscribe__checkbox">
                        <input type="checkbox" name="interes[]" value="Negocios">
                        <div></div>
                        <p>Negocios</p>
                    </label>
                    <label class="detalle_de_articulos__subscribe__checkbox">
                        <input type="checkbox" name="interes[]" value="Seguridad">
                        <div></div>
                        <p>Seguridad</p>
                    </label>
                    <label class="detalle_de_articulos__subscribe__checkbox">
                        <input type="checkbox" name="interes[]" value="Aprendiendo Claro">
                        <div></div>
                        <p>Aprendiendo Claro</p>
                    </label>
                    <label class="detalle_de_articulos__subscribe__checkbox">
                        <input type="checkbox" name="interes[]" value="Compromiso">
                        <div></div>
                        <p>Compromiso</p>
                    </label>
                </div>
                <button class="g-button m--rojo m--mini btn__suscripcion">Suscribirme</button>
            </form>



            <section class="detalle_de_articulos__recomendados">
                <h4 class="detalle_de_articulos__recomendados__title">Te puede interesar</h4>
                <!--relacionados-->
                @foreach($relacionados as $rel)
                <article class="columnas__item">
                    <header class="columnas__item__header">
                        <strong class="columnas__item__subtitle">{{ @$categoria['nombre']}}</strong>
                        <h3 class="columnas__item__title">{{ @$rel['titulo']}}</h3>
                        <aside class="columnas__item__timer">{{@$rel['lectura'] }} min de lectura</aside>
                    </header>
                    @if(isset($subcategoria))
                    <a href="/{{@$categoria->slug}}/{{@$subcategoria->slug}}/{{@$rel['slug']}}" class="columnas__item__link">Más información</a>
                    @else
                    <a href="/{{@$categoria->slug}}/{{@$rel['slug']}}" class="columnas__item__link">Más información</a>
                    @endif
                </article>
                @endforeach
            </section>
        </aside>
        <aside class="detalle_de_articulos__socials">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank">
                <img src="/assets/public/images/social_facebook.png" alt="Compartir en Facebook" loading="lazy">
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}" target="_blank">
                <img src="/assets/public/images/social_twitter.png" alt="Compartir en Twitter" loading="lazy">
            </a>
            <a href="https://api.whatsapp.com/send?text={{ url()->current() }}" target="_blank">
                <img src="/assets/public/images/social_wsp.png" alt="Compartir en Whatsapp" loading="lazy">
            </a>
            <a href="mailto:info@example.com?&subject=&cc=&bcc=&body={{ url()->current() }}" target="_blank">
                <img src="/assets/public/images/social_gmail.png" alt="Compartir en Gmail" loading="lazy">
            </a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}" target="_blank">
                <img src="/assets/public/images/social_linkedin.png" alt="Compartir en Linkedin" loading="lazy">
            </a>
            <a href="http://www.facebook.com/dialog/send?app_id=1127021294451565&link={{ url()->current() }}&redirect_uri={{ url()->current() }}" target="_blank">
                <img src="/assets/public/images/social_msn.png" alt="Compartir en Messenger" loading="lazy">
            </a>
            <a href="https://t.me/share?url={{ url()->current() }}" target="_blank">
                <img src="/assets/public/images/social_telegram.png" alt="Compartir en Telegram" loading="lazy">
            </a>
            <a href="https://pinterest.com/pin/create/button/?url={{ url()->current() }}" target="_blank">
                <img src="/assets/public/images/social_pinterest.png" alt="Compartir en Pinterest" loading="lazy">
            </a>
            <span class="detalle_de_articulos__socials__open fnShowSocials"><img src="/assets/public/images/social_more.png"  alt="Mostrar más opciones" /></span>
            <span class="detalle_de_articulos__socials__close fnShowSocials"><img src="/assets/public/images/social_close.png" alt="Ocultar opciones" /></span>
        </aside>
    </section>


    <section class="section m--gris detalle_de_articulos__bottom">
        <div class="limit detalle_de_articulos__bottom__list">
            <div class="detalle_de_articulos__bottom__block1">
                <h6 class="g-title">Lo más leído</h6>

                <article class="columnas__item">
                    <picture class="columnas__item__image">
                        <img src="/storage/{{@$postmax['card']}}" alt="" loading="lazy">
                    </picture>
                    <header class="columnas__item__header">
                        <strong class="columnas__item__subtitle">{{@$postmax['categoria']->nombre}}</strong>
                        <time class="columnas__item__date">{{@$postmax['date_publish'] }}</time>
                        <h3 class="columnas__item__title">{{@$postmax['titulo'] }}</h3>
                        <aside class="columnas__item__timer">{{@$postmax['lectura'] }} min de lectura</aside>
                    </header>
                    @if(isset($subcategoria))
                    <a href="/{{@$categoria->slug}}/{{@$subcategoria->slug}}/{{$postmax['slug']}}" class="columnas__item__link">Más información</a>
                    @else
                    <a href="/{{@$categoria->slug}}/{{@$postmax['slug']}}" class="columnas__item__link">Más información</a>
                    @endif
                </article>



            </div>

            <div class="detalle_de_articulos__bottom__block2">
                <h6 class="g-title">Te puede interesar</h6>

                @foreach($relacionados as $rel)
                <article class="columnas__item">
                    <picture class="columnas__item__image">
                        <img src="/storage/{{@$rel['imagenbox']}}" alt="" loading="lazy">
                    </picture>
                    <header class="columnas__item__header">
                        <strong class="columnas__item__subtitle">{{ @$categoria['nombre']}}</strong>
                        <time class="columnas__item__date">{{ @$rel['date_publish']}}</time>
                        <h3 class="columnas__item__title">{{ @$rel['titulo']}}</h3>
                        <aside class="columnas__item__timer">{{@$rel['lectura'] }} min de lectura</aside>
                    </header>

                    @if(isset($subcategoria))
                    <a href="/{{@$categoria->slug}}/{{@$subcategoria->slug}}/{{@$rel['slug']}}" class="columnas__item__link">Más información</a>
                    @else
                    <a href="/{{@$categoria->slug}}/{{@$rel['slug']}}" class="columnas__item__link">Más información</a>
                    @endif

                </article>
                @endforeach

            </div>

        </div>
    </section>

    <div class="detalle_de_articulos__back">
        <div class="limit">
            <img class="detalle_de_articulos__back__share fnToShare" src="/assets/public/images/ico_share.png" alt="">
            <img class="detalle_de_articulos__back__button fnToTop" src="/assets/public/images/back_to_top.png" alt="">
        </div>
    </div>
@endsection
