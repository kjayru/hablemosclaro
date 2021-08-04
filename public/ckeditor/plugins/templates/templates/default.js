/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */

// Register a templates definition set named "default".
CKEDITOR.addTemplates( 'default', {
	// The name of sub folder which hold the shortcut preview images of the
	// templates.
	imagesPath: CKEDITOR.getUrl( CKEDITOR.plugins.getPath( 'templates' ) + 'templates/images/' ),

	// The templates definitions.
	templates: [ {
		title: 'Slider con texto',
		image: 'template1.gif',
		description: 'Generar item ',
		html: `<ul class="detalle_de_articulos__article__simple-slide fnSetSwiper" data-swiper="scroll_bottom" data-swiper-activate="active">

        <li class="detalle_de_articulos__article__simple-slide__item">
           image aqui
            <dl>
                <dt>Titulo aqui</dt>
                <dd>Texto aqui</dd>
            </dl>
        </li>


    </ul>`

	},
	{
		title: 'Slider simple',
		image: 'template2.gif',
		description: 'Slider de imagenes',
		html: `<div class="detalle_de_articulos__article__simple-slide fnSetSwiper" data-swiper="scroll_bottom" data-swiper-activate="active">
       <!--repita este bloque-->

        <figure class="detalle_de_articulos__article__simple-slide__image">
          imagen aqui
        </figure>

        <!-- fin de bloque-->

    </div>`
	},
	{
		title: 'Slider One',
		image: 'template3.gif',
		description: 'Slider con presentación unica',
		html: `<div class="detalle_de_articulos__article__simple-slide m--one fnSetSwiper" data-swiper="one_image" data-swiper-activate="active" data-swiper-arrows="/assets/public/images/ico_arrow_verde.png">
        <!--repita este bloque-->

        <figure class="detalle_de_articulos__article__simple-slide__image m--centered">
            Imagen aquí
        </figure>

        <!-- fin de bloque-->
    </div>`
    	},{
    title:'Bloque autor',
    image:'template.gif',
    description:'Bloque presentación de autores',
    html:`<dl class="detalle_de_articulos__article__author">
            <dt class="detalle_de_articulos__article__author__header">
                <figure class="detalle_de_articulos__article__author__image">

                <!--with:70 height:70-->
                foto aqui
                </figure>
                <strong>
                    nombre aqui
                </strong>
                <p>
                Cargo
                </p>

            </dt>

        </dl>`
        }
]
} );
