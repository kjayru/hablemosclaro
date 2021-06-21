// @prepros-prepend plugins.js
'use strict';
const site = (function(){

	const dom = {
		active : '-active-',
		swipers : $('.fnSetSwiper')
	};

	const siteFunctions = function(){
		events.interactions();
		events.forms();
		events.runPlugins();
	};

	const events = {

		runPlugins : function () {
			dom.swipers.length && getPlugins( ['https://unpkg.com/swiper/swiper-bundle.min.css', 'https://unpkg.com/swiper/swiper-bundle.min.js'], events.swiperExecution );
		},

		swiperExecution : function () {

			dom.swipers.each(function(index, el) {
				const _self = $(el);
				const activate = _self.data('swiper-activate');

				if ( activate == 'active' || activate >= $(window).width() ) {
					const children = _self.children();
					const type = _self.data('swiper');

					_self.removeClass('m--default');
					children.wrap('<div class="swiper-slide" />');
					_self.wrapInner( '<div class="swiper-wrapper" />').addClass('swiper-container');

					const aditionals = {
						'slider_principal' : () => {
							_self.append(`<div class="slider_principal__nav">
											<img class="slider_principal__nav__arrow m--left fnSwiperToRight" src="${_self.data('swiper-arrows')}" alt="" loading="lazy">
											<span class="slider_principal__nav__counter fnSwiperFraction">1/6</span>
											<img class="slider_principal__nav__arrow fnSwiperToLeft" src="${_self.data('swiper-arrows')}" alt="" loading="lazy">
											<span class="slider_principal__nav__play fnSwiperPlay"></span>
										</div>`);
						},
						'4_columnas' : () => { _self.append('<div class="swiper-pagination" />') }
					};
					aditionals[type]();	

					const params = {
						'slider_principal': {
							slidesPerView: 1, loop: true, autoplay : { delay : 2000 }, speed : 1200,
				            navigation: { nextEl: el.querySelector('.fnSwiperToRight'), prevEl: el.querySelector('.fnSwiperToLeft') },
				            pagination: { el: el.querySelector('.fnSwiperFraction'), type: "fraction" },
				            on: {
				            	init : function (e) {
				            		const swiper = e;
				            		$(el).find('.fnSwiperPlay').on('click', function() {
				            			$(this).hasClass('-stoped-') ? swiper.autoplay.start() : swiper.autoplay.stop();
				            			$(this).toggleClass('-stoped-');
				            		});
				            	}
				            }
						},
						'4_columnas': {
							slidesPerView: 'auto', loop: true, freeMode: true, autoplay : { delay : 2000 }, speed : 1200,
				            pagination: { el: el.querySelector('.swiper-pagination'), clickable: true }
						}
					};
					const swiper = new Swiper( el, params[type] );
				}
			});
		},

		interactions : function() {

			// mostrar el avance del scroll del documento
			setScrollAdvance();
			$(window).on('scroll', setScrollAdvance );

			// Mostrar formulario de busqueda
			$('.fnShowSearchform')
				.on('click', function(e) {
					// $(this).parent().toggleClass(dom.active);
					$('#search').toggleClass(dom.active);
				});

			// Mostrar menú en mobile
			$('.fnShowNav')
				.on('click', function(e) {
					$(this).toggleClass(dom.active);
					$('.fnNavTarget').toggleClass(dom.active);
				});

			// Mostrar videos
			$('.fnShowVideoButton')
				.on('click', function(e) {
					const video = $(this).data('video');
					const header = $(this).find('.ultimos_videos__item__header').clone();
					$('.fnShowVideoTarget').find('.ultimos_videos__item__video').attr('src', 'https://www.youtube-nocookie.com/embed/' + video);
					$('.fnShowVideoTarget').find('.ultimos_videos__item__header').replaceWith(header);
					$('body, html').animate({
						scrollTop : $('.ultimos_videos').offset().top - $('.header').outerHeight()
					}, 700);
				});

			// Mostrar submenu en mobile
			$('.fnShowSubnav')
				.on('click', function(e) {
					$(this).toggleClass('-active-');
				});

		},

		search : function ( data ) {

			$('.fnSearchResults').addClass(dom.active);
			$('.fnSearchResultsData').html(data.data);

		},

		forms : function(){
			// Set Recaptach
				// setNewRecaptcha();

			let formBlock = true;
			$('form').on('submit', function(e){

				let f = $(this);
				let fields = f.find('input, textarea, select');
				let tipoForm = f.data('tipo');
				let method = f.attr('method').toLowerCase();
				let lightbox = f.data('gracias');
				let error = 0;
				let btn = f.find('button');
				let dataForm = '';
				let validCorreo = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				let num = /[^0-9]/g;

				$.each(fields, function(index, val) {
					let t = $(this);
					if(t.attr('no')===undefined) {
						let value = t.val();
						let targetError = t.parent();
						$.trim(value)==='' && targetError.addClass('-error-') && error++;
						switch (t.attr('valid')) {
							case 'numero': num.test(value) && targetError.addClass('-error-') && error++; break;
							case 'email': !validCorreo.test(value) && targetError.addClass('-error-') && error++; break;
							case 'subscription': !validCorreo.test(value) && t.addClass('-error-') && error++; break;
							case 'select': $.trim(value)==='' && targetError.parent().addClass('-error-') && error++; break;
							case 'file': $.trim(value)==='' && targetError.addClass('-error-') && error++; break;
							case 'terminos': !t.is(':checked') && targetError.addClass('-error-') && error++; break;
						}
					}
				});


				if(error===0&&formBlock) {
					if(method=='get' || tipoForm=='postpermit'){
						return true;
					} else {
						e.preventDefault();
						btn.attr('disabled','disabled');
						formBlock=false;
						$.ajax({url: f.attr('action'), type: 'POST', dataType: 'json', data: f.serializeArray()})
							.done(function(response) {
								if(response.rpta)
								{
									switch (tipoForm) {
										case 'search_form': events.search(response); break;
									}
									// setNewRecaptcha();
									formBlock = true;
									btn.removeAttr('disabled');
								}
							});
					}
				} else {
					return false;
				}
			});

			$('input, select, textarea')
				.on('focus', function(){
					// Set you own function
				});
		}

	};

	function setScrollAdvance () {
		$('.fnScrollAdvance').css('width', ($(document).scrollTop() / ( document.documentElement.scrollHeight - document.documentElement.clientHeight ) * 100) + '%' );
	}

	function getPlugins( args = [], callback ) {

		if ( args.length ) {
			$.each(args, function(index, val) {
				const source = val.split('.').pop();
				switch (source) {
					case 'css':
							const css = $('<link/>', { rel: 'stylesheet', type: 'text/css', href: val });
							$('#site-css').before(css);
						break;
					case 'js':
							$.getScript(val, function(data, textStatus) { callback(); });
						break;
				}
			});
		}
	}

	// set Google Recaptha
	function setNewRecaptcha(){
		grecaptcha.ready(function() {
			grecaptcha.execute('Define your own key code', {action: 'futurismogroup'}).then(function(token) {
				if(!$('input[name="tokengoogle"]').length) {
					$('form').append('<input type="hidden" name="tokengoogle" value="'+token+'" />');
				} else {
					$('form input[name="tokengoogle"]').val(token);
				}
			});
		});
	}

	let initialize = siteFunctions;

	return { init: initialize }

})();

site.init();