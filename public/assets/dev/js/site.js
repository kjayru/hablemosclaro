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
											<span class="slider_principal__nav__counter fnSwiperFraction"></span>
											<img class="slider_principal__nav__arrow fnSwiperToLeft" src="${_self.data('swiper-arrows')}" alt="" loading="lazy">
											<span class="slider_principal__nav__play fnSwiperPlay"></span>
										</div>`);
						},
						'4_columnas' : () => { _self.append('<div class="swiper-pagination" />') },
						'scroll_bottom' : () => { _self.append('<div class="swiper-scrollbar" />') },
						'one_image' : () => {
							_self.append(`<div class="slider_principal__nav">
											<img class="slider_principal__nav__arrow m--left fnSwiperToRight" src="${_self.data('swiper-arrows')}" alt="" loading="lazy">
											<span class="slider_principal__nav__counter fnSwiperFraction"></span>
											<img class="slider_principal__nav__arrow fnSwiperToLeft" src="${_self.data('swiper-arrows')}" alt="" loading="lazy">
										</div>`);
						}
					};
					aditionals[type]();	

					const params = {
						'slider_principal': {
							slidesPerView: 1, autoplay : { delay : 3000 }, speed : 1500,
				            navigation: { nextEl: el.querySelector('.fnSwiperToLeft'), prevEl: el.querySelector('.fnSwiperToRight') },
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
							slidesPerView: 'auto', freeMode: true, speed : 1200,
				            pagination: { el: el.querySelector('.swiper-pagination'), clickable: true }
						},
						'scroll_bottom' : {
							slidesPerView: 'auto', freeMode: true,
							scrollbar: { el: ".swiper-scrollbar", draggable : true,  reverseDirection: true }
						},
						'one_image': {
							slidesPerView: 1, autoplay : { delay : 2000 }, speed : 1200, spaceBetween: 30, 
				            navigation: { nextEl: el.querySelector('.fnSwiperToLeft'), prevEl: el.querySelector('.fnSwiperToRight') },
				            pagination: { el: el.querySelector('.fnSwiperFraction'), type: "fraction" }
						}
					};
					const swiper = new Swiper( el, params[type] );
				}
			});
		},

		interactions : function() {

			// Listado de artículos
			let displayedArticles = 6;
			$(document)
				.on('click', '.fnShowMoreArticles', function(e) {
					e.preventDefault();
					displayedArticles = displayedArticles + 6;
					setViewedArticles( $(this) );
				});

			function setViewedArticles( _self = false ){
				const list = $('.listado_de_articulos__list');
				const items = list.find('.columnas__item');
				list.addClass('-js-');
				items.removeClass('-end-');
				items.eq( (displayedArticles-1) ).addClass('-end-');
				if ( _self && items.length < displayedArticles ) { _self.remove(); }
			}

			// Filtrar listado de articulos
			let defaultFilteredItems = false;
			let defaultOrder = 'recent';
			$(document)
				.on('click', '.fnFilterOptions a', function(e){
					e.preventDefault();
					const _self = $(this);
					const order = _self.data('order');
					orderItems(order);
				});

			function orderItems(order='') {
				const list = $('.listado_de_articulos__list');
				const items = list.find('.columnas__item');
				if ( ! defaultFilteredItems ) { defaultFilteredItems = items; }
				if ( order!='' ) {
					const ordering = [];
					$.each(items, function(index, val) { ordering.push($(this).data('order')); });
					console.log('order => '+order);
					switch (order) {
						case 'recent': ordering.sort((a, b) => b - a); break;
						case 'older': ordering.sort((a, b) => a - b);  break;
					}
					const newItems = [];
					$.each(ordering , function(index, val) {
						newItems.push( list.find('.columnas__item[data-order="'+val+'"]') );
					});
					list.html('');
					if ( order!='default' ) {
						$.each(newItems, function(index, val) { list.append(val); });
					} else {
						list.html(defaultFilteredItems);
					}
					if ( list.find('.columnas__item').length == 0 ) {
						list.append('<p class="listado_de_articulos__list__no-results">No se hallaron resultados</p>');
					} else if( list.find('.columnas__item').length > 6 && list.find('.columnas__item.-end-').length ) {
						list.append('<div class="g-button-group"><a href="#" class="g-button m--211 fnShowMoreArticles">Ver más</a></div>');
					}
					
				}
				$('.fnFilterOptions a').removeClass('-active-');
				$('.fnFilterOptions a[data-order="'+order+'"]').addClass('-active-');
				$('.fnFilterOptionsTitle').text( $('.fnFilterOptions a[data-order="'+order+'"]').text() );
				setViewedArticles();
				defaultOrder = order;
			}

			// Filtrar listado de articulos - Columnas
			if ( $('.fnFilterColumns').length ) {
				const columns = $('.listado_de_articulos__list');
				const originalColumnsArticles = columns.find('.columnas__item');
				$('.fnFilterColumns')
					.on('click', function(e){
						const _self = $(this);
						const isActive = _self.hasClass('-active-');
						const filter = _self.data('filter');
						if ( ! isActive ) {
							columns.html('');
							if ( filter != '' ) {
								$.each(originalColumnsArticles, function(index, val) {
									$(val).data('category') == filter && columns.append(val);
								});
							} else {
								columns.append(originalColumnsArticles);
							}
							if ( columns.find('.columnas__item').length == 0 ) {
								columns.append('<p class="listado_de_articulos__list__no-results">No se hallaron resultados</p>');
							} else if( columns.find('.columnas__item').length > 6 && columns.find('.columnas__item.-end-').length ) {
								columns.append('<div class="g-button-group"><a href="#" class="g-button m--211 fnShowMoreArticles">Ver más</a></div>');
							}
							setViewedArticles();
							$('.fnFilterColumns').removeClass('-active-');
							_self.addClass('-active-');
							orderItems(defaultOrder);
						}
					});
			}

			if ( navigator.share ) {
				$('#detalle-de-articulos-footer-socials').addClass('-hide-');
			}

			$('.fnToShare')
				.on('click', function(e){
					e.preventDefault();
					if ( navigator.share ) {
						navigator.share({
							title: $('title').text(),
							url: location.href
						})
						.then(() => {
							console.log('Gracias por compartir');
						})
    					.catch(console.error);
					} else {
						const top = $('#detalle-de-articulos-footer-socials').offset().top;
						const header = $('.header').outerHeight() + 20;
						$('body, html').animate({ scrollTop: (top - header) }, 750);
					}
				});

			$('.fnToTop')
				.on('click', function(e){
					$('body, html').animate({scrollTop:0}, 750);
				});

			// Tablero de contenido - detalle de articulos
			$('.fnArticleNav a')
				.on('click', function(e){
					e.preventDefault();
					const href = $(this).attr('href');
					const top = $(href).offset().top;
					const header = $('.header').outerHeight() + 20;
					$('body, html').animate({ scrollTop: (top - header) }, 750);
				});

			// mostrar iconos de compartir
			$('.fnShowSocials, .fnShowArticleNav')
				.on('click', function(e) { $(this).parent().toggleClass(dom.active); });


			$('.fnShowFooterSocials')
				.on('click', function(e) { $(this).parent().toggleClass('m--hide'); });

			$('.fnShowArticleAuthor')
				.on('click', function(e) { $(this).closest('.detalle_de_articulos__article__author').toggleClass(dom.active); });

			// mostrar el avance del scroll del documento
			setScrollAdvance();
			$(window).on('scroll', setScrollAdvance );

			// Mostrar formulario de busqueda
			$('.fnShowSearchform')
				.on('click', function(e) {
					$(this).parent().toggleClass(dom.active);
					$('#search').toggleClass(dom.active);
				});

			// Mostrar menú en mobile
			$('.fnShowNav')
				.on('click', function(e) {
					$(this).toggleClass(dom.active);
					$('.fnNavTarget, body').toggleClass(dom.active);
				});

			// Mostrar videos
			$('.fnShowVideoButton')
				.on('click', function(e) {
					e.preventDefault();
					const video = $(this).data('video');
					const header = $(this).find('.ultimos_videos__item__header').clone();
					$('.fnShowVideoTarget').find('.ultimos_videos__item__video').attr('src', 'https://www.youtube-nocookie.com/embed/' + video);
					$('.fnShowVideoTarget').find('.ultimos_videos__item__header').replaceWith(header);
					$('body, html').animate({
						scrollTop : $('.ultimos_videos').offset().top - $('.header').outerHeight()
					}, 700);
					$('.fnShowVideoButton').removeClass('-active-');
					$(this).addClass('-active-');
				});

			// Mostrar submenu en mobile
			$('.fnShowSubnav')
				.on('click', function(e) {
					$(this).toggleClass('-active-');
				});

			// Mostrar filtro en mobile
			$('.fnShowFilter')
				.on('click', function(e) {
					$('#filtro_de_articulos').fadeIn(350);
				});

			// Ocultar filtro en mobile
			$('.fnCloseFilter')
				.on('click', function(e) {
					$('#filtro_de_articulos').fadeOut(250);
				});


			// Search
			$('.fnSearchFormInput').on('keyup', function(e){
				const clean = $('.fnSearchFormClean');
				$.trim($(this).val()).length > 0 ? clean.addClass('-active-') : clean.removeClass('-active-') ;
			});
			$('.fnSearchFormClean').on('click', function(e){
				$(this).removeClass('-active-');
				$('.fnSearchFormInput').val('');
				$('.fnSearchResults').removeClass('-active-');
				$('.fnSearchResultsData').html('');
			});

		},

		search : function ( data, word ) {

			if ( data.length > 0 ) {
				let html = '';
				$.each(data, function(index, val) {
					if ( index <= 2 ) {
						let pattern = new RegExp(word, 'gi');
						let str = val.titulo.replace(pattern, '<strong>'+word+'</strong>');
						if(val.subcategory){
                            html += `<span><a href="/${val.category}/${val.subcategory}/${val.slug}">${str}</a></span>`;
                        }else{
                            html += `<span><a href="/${val.category}/${val.slug}">${str}</a></span>`;
                        }
					}
				});
				if ( data.length > 3 ) {
					html += '<span><a href="/buscar/'+word+'" class="m--all">Ver todos los resultados <img src="/assets/public/images/arrow_celeste.png" loading="lazy" /></a></span>';
				}
				$('.fnSearchResults').addClass(dom.active);
				$('.fnSearchResultsData').html(html);
			}
			
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

				console.log(f.serializeArray());

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
										case 'search_form':
												const word = f.find('input[name="word"]').val();
												events.search(response.data, word); 
											break;
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