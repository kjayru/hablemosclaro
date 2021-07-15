<footer class="footer">
	<div class="limit footer__inset">
		<header class="footer__header">
			<h6 class="footer__title">Escribenos a</h6>
			<a class="footer__email" href="mailto:hablandoclaro@claro.com.pe">hablandoclaro@claro.com.pe</a>
			<aside class="footer__socials">
				<a class="footer__socials__link" href="#" target="_blank"><img src="/assets/public/images/ico_twitter_footer.png" alt="Twitter" loading="lazy"></a>
				<a class="footer__socials__link" href="#" target="_blank"><img src="/assets/public/images/ico_linkedin_footer.png" alt="Linkedin" loading="lazy"></a>
			</aside>
		</header>
		<aside class="footer__nav">
			<strong class="footer__nav__title">Categorías</strong>
			<ul class="footer__nav__list">
				@foreach ( $menu as $key=>$cat )
				<li class="footer__nav__item"><a href="/{{$cat->slug}}" class="footer__nav__link" href="#">{{$cat->nombre}}</a></li>
				@endforeach
			</ul>
		</aside>
		<aside class="footer__nav">
			<strong class="footer__nav__title">Te puede interesar</strong>
			<ul class="footer__nav__list">
				<li class="footer__nav__item"><a class="footer__nav__link" href="#">Claro Portal</a></li>
				<li class="footer__nav__item"><a class="footer__nav__link" href="#">Claro Institucional</a></li>
				<li class="footer__nav__item"><a class="footer__nav__link" href="#">Aviso de privacidad</a></li>
			</ul>
		</aside>
	</div>
	<strong class="footer__copy">© Copyright Hablando Claro. <br>Todos los derechos reservados</strong>
</footer>
