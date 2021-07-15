<header class="header">
	<div class="limit header__inset">
		<h1 class="header__logo">
			<a href="/"><img src="/assets/public/images/hablando-claro.png" alt="Hablando Claro" loading="lazy"></a>
		</h1>

        <nav class="header__nav fnNavTarget">
			<strong class="header__nav__title">Categorías</strong>

			<ul class="header__nav__list">
				<li class="header__nav__item">
					<a class="header__nav__link" href="#">Inicio</a>
				</li>
                @foreach ( $menu as $key=>$cat )
                <li class="header__nav__item">
					<a class="header__nav__link" href="/{{$cat->slug}}">{{$cat->nombre}}</a>

                    @if(isset($cat->pariente))

                        <span class="header__nav__arrow fnShowSubnav"></span>
                        <ul class="header__subnav">
                            @foreach($cat->pariente as $sub)

                            <li class="header__subnav__item"><a href="/{{@$cat->slug}}/{{@$sub->slug}}" class="header__subnav__link">{{ @$sub->nombre }}</a></li>
                            @endforeach
                        </ul>

                    @endif

				</li>
                @endforeach


				<li class="header__nav__item m--lupa">
					<img class="header__nav__item__search fnShowSearchform" src="/assets/public/images/lupa_2.png" alt="" loading="lazy">
					<span class="header__button-mobile -active- fnShowSearchform"><span></span></span>
				</li>

            </ul>
			<aside class="header__nav__socials">
				<a href="#"><img src="/assets/public/images/ico_twitter.png" alt="Twitter" loading="lazy"></a>
				<a href="#"><img src="/assets/public/images/ico_linkedin.png" alt="Linkedin" loading="lazy"></a>
			</aside>
		</nav>
		<span class="header__button-lupa"><img class="header__nav__item__search fnShowSearchform" src="/assets/public/images/lupa_2.png" alt="" loading="lazy"></span>
		<span class="header__button-mobile fnShowNav"><span></span></span>
	</div>
	<span class="header__advance fnScrollAdvance"></span>
</header>
<span class="header__height"></span>
<div id="search" class="search">
	<div class="search__content">
		<span class="search__content__back fnShowSearchform"><img src="/assets/public/images/ico_back.png" alt="Volver" /></span>
		<form action="http://localhost/hablandoclaro/search_results.json" class="search__form fnSearchForm" method="post" data-tipo="search_form">
			<input type="text" name="q" placeholder="Buscar en Hablando Claro" class="search__form__input">
			<button type="submit" class="search__form__button">Buscar</button>
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
