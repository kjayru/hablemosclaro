@extends('layouts.frontend.app')
@section('content')


    <span class="header__height"></span>

    <div id="search" class="search">
        <div class="search__content">
            <span class="search__content__back fnShowSearchform"><img src="/assets/public/images/ico_back.png"
                    alt="" /></span>
            <form action="/hablandoclaro/search_results.json" class="search__form fnSearchForm" method="post"
                data-tipo="search_form">
                <input type="text" name="q" placeholder="Buscar en Hablando Claro"
                    class="search__form__input fnSearchFormInput">
                <button type="submit" class="search__form__button">Buscar</button>
                <img src="/assets/public/images/ico_clean_search.png" alt="Limpiar busqueda" loading="lazy"
                    class="search__form__clean fnSearchFormClean">
            </form>
            <div class="search__results fnSearchResults">
                <strong class="search__results__title">Resultados</strong>
                <div class="search__results__data fnSearchResultsData"></div>
            </div>
            <strong class="search__results__title m--2">Más buscados</strong>
            <aside class="search__results__wanted">
                <a href="#">Teletrabajo</a>
                <a href="#">Gaming</a>
                <a href="#">Entretenimiento digital</a>
                <a href="#">Innovación</a>
            </aside>
        </div>
    </div>
    <aside class="limit breadcrumb">
        <a class="breadcrumb__link" href="#"><img src="/assets/public/images/ico_home.png" alt="Inicio"
                loading="lazy" /></a>
        <span class="breadcrumb__space"></span>
        <a class="breadcrumb__link" href="#">Columnas de opinión</a>
    </aside>

    <section class="section limit m--detalle detalle_de_articulos">
        <article class="detalle_de_articulos__article">
            <figure class="detalle_de_articulos__article__image">
                <img src="{{ $post->banner }}" alt="">
            </figure>
            <header class="columnas__item__header">
                <strong class="columnas__item__subtitle">{{ $post->category->nombre }}</strong>
                <h3 class="columnas__item__title">{{ $post->titulo }}</h3>
                <time class="columnas__item__date">14 de mayo, 2021</time>
                <!--<aside class="columnas__item__timer">5 min de lectura</aside>-->
                <div class="columnas__item__author">
                    <img src="/assets/public/images/author.png" alt="" loading="lazy" width="46" height="46" />
                    <p>
                        <strong>Por Juan Rivadeneyra</strong>
                        Director de Asuntos regulatorios.
                    </p>
                </div>
            </header>
            <div class="detalle_de_articulos__article__content">

                {!!$post->contenido!!}
            </div>
            <aside id="test-link" class="detalle_de_articulos__article__donwload">
                <strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do</strong>
                <a href="#" download="titulo" class="g-button m--rojo m--mini">Descargar</a>
            </aside>
            <div class="detalle_de_articulos__article__simple-slide fnSetSwiper" data-swiper="scroll_bottom"
                data-swiper-activate="active">
                <figure class="detalle_de_articulos__article__simple-slide__image">
                    <img src="/assets/public/images/detalle_2.png" alt="" loading="lazy">
                </figure>
                <figure class="detalle_de_articulos__article__simple-slide__image">
                    <img src="/assets/public/images/detalle_2.png" alt="" loading="lazy">
                </figure>
                <figure class="detalle_de_articulos__article__simple-slide__image">
                    <img src="/assets/public/images/detalle_2.png" alt="" loading="lazy">
                </figure>
                <figure class="detalle_de_articulos__article__simple-slide__image">
                    <img src="/assets/public/images/detalle_2.png" alt="" loading="lazy">
                </figure>
                <figure class="detalle_de_articulos__article__simple-slide__image">
                    <img src="/assets/public/images/detalle_2.png" alt="" loading="lazy">
                </figure>
                <figure class="detalle_de_articulos__article__simple-slide__image">
                    <img src="/assets/public/images/detalle_2.png" alt="" loading="lazy">
                </figure>
                <figure class="detalle_de_articulos__article__simple-slide__image">
                    <img src="/assets/public/images/detalle_2.png" alt="" loading="lazy">
                </figure>
                <figure class="detalle_de_articulos__article__simple-slide__image">
                    <img src="/assets/public/images/detalle_2.png" alt="" loading="lazy">
                </figure>
                <figure class="detalle_de_articulos__article__simple-slide__image">
                    <img src="/assets/public/images/detalle_2.png" alt="" loading="lazy">
                </figure>
            </div>
            <div class="detalle_de_articulos__article__simple-slide m--one fnSetSwiper" data-swiper="one_image"
                data-swiper-activate="active" data-swiper-arrows="/assets/public/images/ico_arrow_verde.png">
                <figure class="detalle_de_articulos__article__simple-slide__image m--centered">
                    <img src="/assets/public/images/detalle_4.png" alt="" loading="lazy">
                </figure>
                <figure class="detalle_de_articulos__article__simple-slide__image m--centered">
                    <img src="/assets/public/images/detalle_4.png" alt="" loading="lazy">
                </figure>
                <figure class="detalle_de_articulos__article__simple-slide__image m--centered">
                    <img src="/assets/public/images/detalle_4.png" alt="" loading="lazy">
                </figure>
            </div>
            <ul class="detalle_de_articulos__article__simple-slide fnSetSwiper" data-swiper="scroll_bottom"
                data-swiper-activate="active">
                <li class="detalle_de_articulos__article__simple-slide__item">
                    <img src="/assets/public/images/detalle_3.png" alt="" loading="lazy" width="259" height="163" />
                    <dl>
                        <dt>Lorem ipsum dolor sit amet, consectetur adipiscing elit</dt>
                        <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam</dd>
                    </dl>
                </li>
                <li class="detalle_de_articulos__article__simple-slide__item">
                    <img src="/assets/public/images/detalle_3.png" alt="" loading="lazy" width="259" height="163" />
                    <dl>
                        <dt>Lorem ipsum dolor sit amet, consectetur adipiscing elit</dt>
                        <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam</dd>
                    </dl>
                </li>
                <li class="detalle_de_articulos__article__simple-slide__item">
                    <img src="/assets/public/images/detalle_3.png" alt="" loading="lazy" width="259" height="163" />
                    <dl>
                        <dt>Lorem ipsum dolor sit amet, consectetur adipiscing elit</dt>
                        <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam</dd>
                    </dl>
                </li>
                <li class="detalle_de_articulos__article__simple-slide__item">
                    <img src="/assets/public/images/detalle_3.png" alt="" loading="lazy" width="259" height="163" />
                    <dl>
                        <dt>Lorem ipsum dolor sit amet, consectetur adipiscing elit</dt>
                        <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam</dd>
                    </dl>
                </li>
                <li class="detalle_de_articulos__article__simple-slide__item">
                    <img src="/assets/public/images/detalle_3.png" alt="" loading="lazy" width="259" height="163" />
                    <dl>
                        <dt>Lorem ipsum dolor sit amet, consectetur adipiscing elit</dt>
                        <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam</dd>
                    </dl>
                </li>
            </ul>


            <nav class="detalle_de_articulos__article__nav fnArticleNav">
                <strong class="detalle_de_articulos__article__nav__title fnShowArticleNav">
                    Tablero de contenidos:
                    <img src="/assets/public/images/ico_plus.png" alt="">
                </strong>
                <ol>
                    <li>
                        <a href="#test-link">lorem</a>
                        <ol>
                            <li><a href="#test-link">Lorem ipsum</a></li>
                            <li><a href="#test-link">Lorem ipsum</a></li>
                        </ol>
                    </li>
                    <li>
                        <a href="lorem">lorem</a>
                        <ol>
                            <li><a href="#test-link">Lorem ipsum</a></li>
                            <li><a href="#test-link">Lorem ipsum</a></li>
                            <li><a href="#test-link">Lorem ipsum</a></li>
                            <li><a href="#test-link">Lorem ipsum</a></li>
                        </ol>
                    </li>
                    <li><a href="#test-link">Lorem ipsum</a></li>
                    <li><a href="#test-link">Lorem ipsum</a></li>
                    <li>
                        <a href="lorem">lorem</a>
                        <ol>
                            <li><a href="#test-link">Lorem ipsum</a></li>
                            <li><a href="#test-link">Lorem ipsum</a></li>
                        </ol>
                    </li>
                </ol>
            </nav>

            <nav class="detalle_de_articulos__article__nav m--black fnArticleNav">
                <strong class="detalle_de_articulos__article__nav__title fnShowArticleNav">
                    Tablero de contenidos:
                    <img src="/assets/public/images/ico_plus.png" alt="">
                </strong>
                <ol>
                    <li>
                        <a href="#test-link">lorem</a>
                        <ol>
                            <li><a href="#test-link">Lorem ipsum</a></li>
                            <li><a href="#test-link">Lorem ipsum</a></li>
                        </ol>
                    </li>
                    <li>
                        <a href="lorem">lorem</a>
                        <ol>
                            <li><a href="#test-link">Lorem ipsum</a></li>
                            <li><a href="#test-link">Lorem ipsum</a></li>
                            <li><a href="#test-link">Lorem ipsum</a></li>
                            <li><a href="#test-link">Lorem ipsum</a></li>
                        </ol>
                    </li>
                    <li><a href="#test-link">Lorem ipsum</a></li>
                    <li><a href="#test-link">Lorem ipsum</a></li>
                    <li>
                        <a href="lorem">lorem</a>
                        <ol>
                            <li><a href="#test-link">Lorem ipsum</a></li>
                            <li><a href="#test-link">Lorem ipsum</a></li>
                        </ol>
                    </li>
                </ol>
            </nav>

            <aside class="detalle_de_articulos__article__links">
                <h4>Activa tu Chip Claro</h4>
                <p>Si ya tienes tu chip Claro, ya puedes activarlo tú mismo. <strong>Revisa el tutorial que necesitas
                        para:</strong></p>
                <ul>
                    <li><a href="#">Reponer tu número Prepago o Postpago <img src="/assets/public/images/ico_nav-arrow.png"
                                loading="lazy" /></a></li>
                    <li><a href="#">Activar una línea nueva Postpago <img src="/assets/public/images/ico_nav-arrow.png"
                                loading="lazy" /></a></li>
                    <li><a href="#">Cambiarte a Claro Prepago <img src="/assets/public/images/ico_nav-arrow.png"
                                loading="lazy" /></a></li>
                    <li><a href="#">Activar una línea nueva Postpago <img src="/assets/public/images/ico_nav-arrow.png"
                                loading="lazy" /></a></li>
                    <li><a href="#">Reponer tu número Prepago o Postpago <img src="/assets/public/images/ico_nav-arrow.png"
                                loading="lazy" /></a></li>
                </ul>
            </aside>

            <aside class="detalle_de_articulos__article__myths">
                <strong class="detalle_de_articulos__article__myths__title">¿Es preferible usar cargadores
                    originales?</strong>
                <figure class="detalle_de_articulos__article__myths__image">
                    <img src="/assets/public/images/ico_good.png" alt="" loading="lazy">
                    <figcaption>Verdad</figcaption>
                </figure>
                <div class="detalle_de_articulos__article__content">
                    <p>Los cargadores originales están desarrollados para cargar de forma adecuada y segura los terminales.
                        Es decir que si tu smartphone soporta una carga rápida de 25W, el cargador será compatible con esta
                        velocidad y ofrecerá una carga equilibrada y segura, mientras que usar un cargador genérico será
                        incompatible por tecnologías diferentes como potencia.</p>
                    <p>Respuesta por <a href="#">Gianmarco Cárdenas</a></p>
                </div>
            </aside>

            <aside class="detalle_de_articulos__article__myths m--fail">
                <strong class="detalle_de_articulos__article__myths__title">¿Es preferible usar cargadores
                    originales?</strong>
                <figure class="detalle_de_articulos__article__myths__image">
                    <img src="/assets/public/images/ico_good.png" alt="" loading="lazy">
                    <figcaption>Falso</figcaption>
                </figure>
                <div class="detalle_de_articulos__article__content">
                    <p>Los cargadores originales están desarrollados para cargar de forma adecuada y segura los terminales.
                        Es decir que si tu smartphone soporta una carga rápida de 25W, el cargador será compatible con esta
                        velocidad y ofrecerá una carga equilibrada y segura, mientras que usar un cargador genérico será
                        incompatible por tecnologías diferentes como potencia.</p>
                    <p>Respuesta por <a href="#">Gianmarco Cárdenas</a></p>
                </div>
            </aside>

            <aside class="detalle_de_articulos__article__social-cards">
                <dl class="detalle_de_articulos__article__social-cards__item">
                    <dt class="detalle_de_articulos__article__social-cards__title">
                        <img src="/assets/public/images/social-card.png" alt="" width="70" height="70" loading="lazy">
                        <strong>Jhonatan</strong>
                    </dt>
                    <dd class="detalle_de_articulos__article__social-cards__content">
                        <p>Tech Blogger, Lead Editor de Perusmart.com</p>
                        <strong class="detalle_de_articulos__article__social-cards__bottom m--twitter">
                            <img src="/assets/public/images/social_twitter.png" alt="" loading="lazy">@soynubeparlante
                        </strong>
                        <a href="#" class="detalle_de_articulos__article__social-cards__link">Más información</a>
                    </dd>
                </dl>
                <dl class="detalle_de_articulos__article__social-cards__item">
                    <dt class="detalle_de_articulos__article__social-cards__title">
                        <img src="/assets/public/images/social-card.png" alt="" width="70" height="70" loading="lazy">
                        <strong>Alfonso</strong>
                    </dt>
                    <dd class="detalle_de_articulos__article__social-cards__content">
                        <p>Tech Blogger, Lead Editor de Perusmart.com</p>
                        <strong class="detalle_de_articulos__article__social-cards__bottom m--facebook">
                            <img src="/assets/public/images/social_facebook.png" alt="" loading="lazy">@soynubeparlante
                        </strong>
                        <a href="#" class="detalle_de_articulos__article__social-cards__link">Más información</a>
                    </dd>
                </dl>
                <dl class="detalle_de_articulos__article__social-cards__item">
                    <dt class="detalle_de_articulos__article__social-cards__title">
                        <img src="/assets/public/images/social-card.png" alt="" width="70" height="70" loading="lazy">
                        <strong>Paola</strong>
                    </dt>
                    <dd class="detalle_de_articulos__article__social-cards__content">
                        <p>Tech Blogger, Lead Editor de Perusmart.com</p>
                        <strong class="detalle_de_articulos__article__social-cards__bottom m--twitter">
                            <img src="/assets/public/images/social_twitter.png" alt="" loading="lazy">@soynubeparlante
                        </strong>
                        <a href="#" class="detalle_de_articulos__article__social-cards__link">Más información</a>
                    </dd>
                </dl>
            </aside>

            <dl class="detalle_de_articulos__article__author">
                <dt class="detalle_de_articulos__article__author__header">
                    <figure class="detalle_de_articulos__article__author__image">
                        <img src="/assets/public/images/social-card.png" alt="" width="70" height="70" loading="lazy">
                    </figure>
                    <strong>Gianmarco Cárdenas</strong>
                    <p>Tech Blogger, Lead Editor de Perusmart.com</p>
                    <aside>
                        <a href="#"><img src="/assets/public/images/ico_twitter_white.png" alt=""
                                loading="lazy">@soynubeparlante</a>
                        <a href="#"><img src="/assets/public/images/ico_linkedin_white.png" alt=""
                                loading="lazy">@soynubeparlante</a>
                        <span class="detalle_de_articulos__article__author__button fnShowArticleAuthor"><img
                                src="/assets/public/images/ico_plus_white.png" alt=""></span>
                    </aside>
                </dt>
                <dl class="detalle_de_articulos__article__content">
                    <p>Los cargadores originales están desarrollados para cargar de forma adecuada y segura los terminales.
                        Es decir que si tu smartphone soporta una carga rápida de 25W, el cargador será compatible con esta
                        velocidad y ofrecerá una carga equilibrada y segura, mientras que usar un cargador genérico será
                        incompatible por tecnologías diferentes como potencia.</p>
                    <p>Respuesta por <a href="#">Gianmarco Cárdenas</a></p>
                    <ul>
                        <li>Los cargadores originales están desarrollados.</li>
                        <li>Con esta velocidad y ofrecerá una carga <strong>equilibrada y segura, mientras</strong> que usar
                            un cargador genérico será incompatible por tecnologías diferentes como potencia.</li>
                        <li>Los cargadores originales están desarrollados.</li>
                    </ul>
                    <p>Respuesta por <a href="#">Gianmarco Cárdenas</a></p>
                    <ol>
                        <li>Los cargadores originales están desarrollados.</li>
                        <li>Con esta velocidad y ofrecerá una carga <strong>equilibrada y segura, mientras</strong> que usar
                            un cargador genérico será incompatible por tecnologías diferentes como potencia.</li>
                        <li>Los cargadores originales están desarrollados.</li>
                    </ol>
                </dl>
            </dl>
            <div class="detalle_de_articulos__article__content">
                <p>Aunque la nueva normalidad nos exige mantener el distanciamiento social, gracias a las telecomunicaciones
                    seguimos juntos. Reunidos en una videollamada familiar, celebrando el cumpleaños de un amigo, trabajando
                    en equipo desde una plataforma, estudiando con nuestros compañeros desde casa, compartiendo en redes
                    sociales, chateando con tu persona favorita o jugando en línea con tus patas. Todo esto es posible
                    porque estamos conectados.</p>
                <p>Y aunque muchas veces no reflexionemos al respecto, detrás de cada conexión que disfrutamos hay gente
                    trabajando. En Claro, por ejemplo, un gran equipo de profesionales labora arduamente para garantizar la
                    continuidad de tus servicios, incluso en tiempos de emergencia sanitaria. Por ello, en esta nota
                    repasaremos las iniciativas más importantes desplegadas por la empresa para hacer realidad el
                    Teletrabajo, la Teleducación, la Telesalud, la Autogestión y también el Entretenimiento Digital en la
                    nueva normalidad.</p>
            </div>
            <aside class="detalle_de_articulos__article__tags">
                <strong class="detalle_de_articulos__article__tags__title">Etiquetas:</strong>
                <div class="detalle_de_articulos__article__tags__links">
                    <a href="#">Telecomunicaciones</a>
                    <a href="#">Teletrabajo</a>
                    <a href="#">Teleeducación</a>
                    <a href="#">Telesalud</a>
                    <a href="#">Entretenimiento digital</a>
                </div>
            </aside>
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
