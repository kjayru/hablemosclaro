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
                <time class="columnas__item__date">{{ $articulo->publicado }} </time>
                <aside class="columnas__item__timer">{{ $articulo->tiempoLectura }} min de lectura</aside>

            @if(isset($articulo->author))
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

                <div class="detalle_de_articulos__article__form-test">
                    <!---->

                @if(isset($articulo->quiz))

                    @foreach($articulo->quiz->questions as $k => $quest)
                    
                    @if(isset($quest->imagen))
                        <div class="detalle_de_articulos__article__form-test__question">
                            <h4 class="detalle_de_articulos__article__form-test__question__title">
                              <span>{{$k+1}}</span>
                                <strong>{{ $quest->pregunta}}</strong>
                            </h4>
                            <figure class="detalle_de_articulos__article__form-test__figure">
                                <img src="/storage/{{$quest->imagen}}" alt="">
                            </figure>
                            <div class="detalle_de_articulos__article__form-test__labels">

                                @foreach($quest->options as $opt)
                                    <label class="detalle_de_articulos__article__form-test__label">
                                        <input type="radio" name="opcion" value="{{$opt->id}}" data-quiz="{{$quest->id}}" data-question="{{$articulo->quiz_id}}">
                                        <span class="detalle_de_articulos__article__form-test__label__text">{{$opt->opcion}}</span>
                                    </label>
                                @endforeach

                            </div>
                        </div>
                    @else
                        <div class="detalle_de_articulos__article__form-test__question">
                            <h4 class="detalle_de_articulos__article__form-test__question__title">
                                <span>{{$k+1}}</span>
                                <strong>{{ $quest->pregunta}}</strong>
                            </h4>
                            <div class="detalle_de_articulos__article__form-test__labels">

                            @foreach($quest->options as $opt)
                                <label class="detalle_de_articulos__article__form-test__label">
                                    <input type="radio" name="opcion" value="{{$opt->id}}" data-quiz="{{$quest->id}}" data-question="{{$articulo->quiz_id}}">
                                    <span class="detalle_de_articulos__article__form-test__label__text">{{$opt->opcion}}</span>
                                </label>
                            @endforeach

                            </div>
                        </div>

                    @endif

                    @endforeach
                @endif

                </div>

                <div class="detalle_de_articulos__article__infografia">
                   <div class="detalle_de_articulos__article__svg">
                      <svg width="100%" height="600" viewBox="0 0 1030 596" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <g id="INFOGRAFIA">
                            <g id="Background">
                               <path id="Vector" d="M343.822 313.924C347.605 313.924 350.672 311.062 350.672 307.531C350.672 304 347.605 301.138 343.822 301.138C340.038 301.138 336.972 304 336.972 307.531C336.972 311.062 340.038 313.924 343.822 313.924Z" fill="#3C3C3B"></path>
                               <path id="Vector_2" d="M459.266 140.026C463.049 140.026 466.116 137.164 466.116 133.633C466.116 130.102 463.049 127.24 459.266 127.24C455.483 127.24 452.416 130.102 452.416 133.633C452.416 137.164 455.483 140.026 459.266 140.026Z" fill="#3C3C3B"></path>
                               <path id="Vector_3" d="M351.585 217.203C353.199 217.203 354.508 216.017 354.508 214.554C354.508 213.091 353.199 211.905 351.585 211.905C349.971 211.905 348.662 213.091 348.662 214.554C348.662 216.017 349.971 217.203 351.585 217.203Z" fill="#3C3C3B"></path>
                               <path id="Vector_4" d="M370.494 440.971C372.578 439.463 372.135 435.292 369.503 431.655C366.872 428.018 363.05 426.291 360.965 427.799C358.881 429.307 359.324 433.478 361.956 437.115C364.587 440.752 368.41 442.478 370.494 440.971Z" fill="#3C3C3B"></path>
                               <path id="Vector_5" d="M434.426 450.562C436.51 449.054 436.714 445.778 434.881 443.244C433.048 440.71 429.872 439.878 427.788 441.386C425.704 442.894 425.5 446.17 427.333 448.704C429.166 451.238 432.341 452.069 434.426 450.562Z" fill="#3C3C3B"></path>
                               <path id="Vector_6" d="M460.365 484.399C462.45 482.892 462.653 479.615 460.82 477.082C458.987 474.548 455.812 473.716 453.728 475.224C451.643 476.732 451.44 480.008 453.272 482.542C455.105 485.075 458.281 485.907 460.365 484.399Z" fill="#3C3C3B"></path>
                               <path id="Vector_7" d="M474.699 463.723C476.783 462.216 476.987 458.939 475.154 456.405C473.321 453.872 470.146 453.04 468.061 454.548C465.977 456.055 465.773 459.332 467.606 461.865C469.439 464.399 472.615 465.231 474.699 463.723Z" fill="#3C3C3B"></path>
                               <path id="Vector_8" d="M540.843 458.589C542.927 457.081 543.131 453.805 541.298 451.271C539.465 448.737 536.29 447.905 534.205 449.413C532.121 450.921 531.917 454.197 533.75 456.731C535.583 459.265 538.759 460.097 540.843 458.589Z" fill="#3C3C3B"></path>
                               <path id="Vector_9" d="M624.671 411.489C628.191 409.041 629.41 404.706 627.395 401.808C625.379 398.909 620.891 398.543 617.371 400.991C613.851 403.438 612.631 407.773 614.647 410.672C616.663 413.571 621.151 413.936 624.671 411.489Z" fill="#3C3C3B"></path>
                               <path id="Vector_10" d="M713.752 338.332C714.048 334.055 711.432 330.39 707.91 330.146C704.387 329.902 701.292 333.172 700.995 337.449C700.699 341.726 703.315 345.391 706.837 345.635C710.36 345.879 713.455 342.61 713.752 338.332Z" fill="#3C3C3B"></path>
                               <path id="Vector_11" d="M512.277 440.907C514.361 439.399 514.565 436.123 512.732 433.589C510.899 431.055 507.723 430.224 505.639 431.731C503.555 433.239 503.351 436.515 505.184 439.049C507.017 441.583 510.193 442.415 512.277 440.907Z" fill="#3C3C3B"></path>
                               <g id="Group">
                                  <path id="Vector_12" d="M696.64 227.615C696.64 227.615 695.636 188.981 653.623 156.284C616.45 121.121 579.278 100.571 533.337 96.1867C489.315 91.8028 435.063 98.6527 401.818 127.514C382.821 139.113 335.876 161.672 306.558 246.703C297.79 284.789 293.315 317.121 308.019 376.761C329.026 414.847 335.419 421.24 335.419 421.24C335.419 421.24 352.498 459.326 400.448 478.962C411.225 487.73 447.393 508.28 472.327 500.974C498.722 504.901 538.817 506.819 538.817 506.819C538.817 506.819 566.217 515.587 616.085 485.356C643.941 469.738 670.519 444.165 675.725 425.259C680.931 406.261 704.038 371.464 704.038 371.464C704.038 371.464 724.588 353.38 713.811 292.278C701.024 269.902 689.882 226.245 689.882 226.245C689.882 226.245 679.561 198.297 648.782 171.993C635.539 156.832 599.919 121.121 599.919 121.121C599.919 121.121 566.674 105.503 540.278 103.493C513.883 101.484 481.095 106.416 481.095 106.416C481.095 106.416 425.838 112.809 414.605 124.043C386.291 143.588 365.741 159.754 365.741 159.754C365.741 159.754 341.173 192.817 333.41 230.081C323.637 252.092 305.553 281.866 311.398 367.445C345.1 411.467 356.974 417.495 356.974 417.495C356.974 417.495 364.28 431.013 370.491 440.146C379.624 451.471 398.621 483.255 446.845 488.735C450.498 490.196 469.496 498.599 472.418 498.234C475.341 497.868 545.119 497.503 545.119 497.503L561.559 490.562C561.559 490.562 596.631 477.044 613.801 459.874C629.511 448.549 656.911 425.167 662.39 416.399C668.236 397.402 698.193 361.965 698.193 361.965C698.193 361.965 716.459 342.237 710.249 295.109C700.02 278.67 683.214 225.697 683.214 225.697C683.214 225.697 671.524 206.334 630.241 184.414C603.207 158.841 585.671 133.268 585.671 133.268C585.671 133.268 564.116 112.079 538.543 105.137C515.527 106.233 491.05 119.02 491.05 119.02L433.693 146.42L391.68 185.876C391.68 185.876 366.107 225.331 357.704 252.366C351.494 269.902 345.648 303.512 345.648 303.512L343.456 307.531C343.456 307.531 340.534 341.507 340.899 356.485C346.379 376.944 374.144 395.21 374.144 395.21L386.565 411.285L410.312 441.242L430.77 444.895C430.77 444.895 443.922 469.007 457.44 480.698C457.44 470.103 464.016 462.431 468.4 460.239C471.322 458.778 471.322 458.778 471.322 458.778C471.322 458.778 497.626 438.319 508.221 436.858C512.97 437.954 528.679 444.165 536.717 454.028C546.946 446.357 577.634 423.341 619.281 408.727C621.839 404.709 624.396 403.978 624.396 403.978L644.489 395.576L669.332 356.485C669.332 356.485 671.524 310.088 671.524 288.168C671.158 273.555 662.025 240.31 662.025 240.31C662.025 240.31 620.377 192.086 618.185 186.606C615.993 181.126 582.018 146.054 582.018 146.054L535.986 101.849L483.013 103.311C483.013 103.311 463.285 122.308 459.266 134.729C457.805 132.537 427.848 132.172 427.848 132.172L375.971 180.03C375.971 180.03 332.131 203.046 318.248 229.35C318.248 229.35 306.558 273.92 306.192 289.63C305.827 299.128 307.654 327.624 310.211 335.296C327.747 373.29 350.032 389 350.032 389L365.376 414.938L363.915 432.474C363.915 432.474 384.739 401.786 419.81 397.402C420.906 402.151 425.29 432.109 430.405 445.991C435.154 445.261 484.474 434.666 504.933 432.109C530.506 428.821 575.807 414.207 575.807 414.207C575.807 414.207 619.647 407.997 619.281 407.266C618.916 406.535 618.916 403.247 618.916 403.247L598.823 389.365L628.049 351.37L624.031 400.325L651.796 370.002L659.102 359.042C659.102 359.042 650.335 323.971 636.817 306.8C625.127 291.091 630.241 280.131 630.241 280.131C630.241 280.131 681.388 295.109 709.153 337.123C711.345 327.989 709.518 323.24 709.518 323.24L688.329 290.726L667.505 235.561L596.265 210.718L534.89 175.281C534.89 175.281 537.447 117.924 536.717 112.079C536.717 110.617 588.228 158.11 588.228 158.11C588.228 158.11 585.306 158.476 572.884 155.188C560.463 151.9 509.682 133.999 459.266 134.729C408.851 135.46 405.471 174.185 405.471 174.185L407.389 238.483L442.096 196.47L420.176 175.281L430.77 167.244L475.341 174.55L533.794 188.433L590.42 161.764L582.748 159.937C582.748 159.937 542.196 148.977 434.424 157.745" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_13" d="M623.665 247.982C623.665 247.982 632.616 204.051 629.602 183.958" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_14" d="M653.805 231.359C653.805 231.359 657.824 215.833 640.653 179.848" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_15" d="M659.194 202.863C659.194 202.863 661.111 168.979 658.92 160.302" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_16" d="M690.247 203.137C690.247 203.137 669.058 174.916 648.873 161.033" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_17" d="M714.816 346.895L709.153 337.123L705.774 339.497C705.774 339.497 660.929 334.565 628.689 340.867" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_18" d="M631.063 267.345L657.367 259.581" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_19" d="M539.091 484.169C539.091 484.169 592.521 440.42 615.993 412.107" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_20" d="M559.458 492.023C559.458 492.023 589.05 479.328 608.687 443.982C608.687 443.982 616.633 427.268 620.286 409.184" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_21" d="M543.658 505.632C544.845 505.906 555.622 505.632 563.842 499.421C575.076 495.311 594.347 485.904 604.942 470.743C615.263 456.769 622.843 447.818 622.204 409.641" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_22" d="M598.275 478.141C598.275 478.141 638.279 462.979 646.499 455.855C646.499 455.855 654.536 439.781 644.398 429.917C635.996 416.217 622.661 407.814 622.661 407.814" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_23" d="M661.66 422.793C661.66 422.793 654.353 446.722 646.499 455.856C646.499 455.856 669.606 434.575 675.634 425.168" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_24" d="M646.499 455.855L615.993 485.265C615.993 485.265 577.177 496.773 563.842 499.513C563.842 499.513 563.294 492.297 560.098 490.197C562.107 484.808 561.011 475.035 556.81 469.738C552.608 464.532 540.644 455.307 536.717 454.029" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_25" d="M534.068 466.633L534.981 457.773C534.981 457.773 537.356 454.303 537.539 450.924C537.721 447.453 537.904 427.816 537.904 427.816" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_26" d="M503.471 457.774C503.471 457.774 508.495 436.584 510.139 434.118" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_27" d="M310.485 355.846C310.485 355.846 318.248 329.907 332.953 317.212C343.365 306.526 371.587 283.419 379.167 279.4" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_28" d="M367.933 372.834C367.933 372.834 373.139 334.2 382.638 319.404" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_29" d="M371.952 377.766L395.881 358.677" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_30" d="M338.798 294.379C338.798 294.379 341.721 303.056 349.484 313.102C357.248 323.788 387.57 363.335 397.069 369.637" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_31" d="M340.716 306.07C340.716 306.07 320.897 307.896 314.138 309.175C307.38 310.454 299.16 313.65 298.612 317.395C297.973 321.048 316.422 327.807 324.002 327.259" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_32" d="M361.631 157.38C361.631 157.38 348.206 173.454 345.557 187.52C342.908 201.585 351.037 213.823 351.037 213.823" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_33" d="M428.396 128.427C428.396 128.427 451.96 103.037 462.828 99.566C460.271 105.868 459.266 115.641 459.906 130.711" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_34" d="M453.878 477.41C453.056 477.227 418.715 461.883 413.417 459.143C403.553 454.211 368.207 435.762 368.207 435.762" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_35" d="M410.312 441.242C410.312 441.242 416.888 459.326 423.372 469.008C429.857 478.689 448.946 489.01 448.946 489.01" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_36" d="M435.611 480.698C435.611 480.698 425.199 479.328 419.262 475.949C413.326 472.57 375.697 444.713 370.765 438.594" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_37" d="M400.357 478.871C400.357 478.871 373.048 457.134 365.65 434.758C362.271 432.018 349.576 424.894 349.576 424.894" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_38" d="M347.566 441.06C347.566 441.06 351.494 431.652 362.453 432.2" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  <path id="Vector_39" d="M483.469 464.989C483.469 464.989 470.5 458.504 466.208 457.317C461.093 454.942 433.054 447.27 433.054 447.27" stroke="#3C3C3B" stroke-width="2.4055" stroke-miterlimit="10"></path>
                               </g>
                            </g>
                            <g id="Circulo">
                               <path id="Vector_40" d="M507.399 437.224C582.557 437.224 643.484 376.296 643.484 301.138C643.484 225.979 582.557 165.052 507.399 165.052C432.24 165.052 371.313 225.979 371.313 301.138C371.313 376.296 432.24 437.224 507.399 437.224Z" fill="black" stroke="#3C3C3B" stroke-width="0.6125" stroke-miterlimit="10"></path>
                               <text id="PROTEGE LA INFORMACIÃ“N DE TU EMPRESA" fill="white" xml:space="preserve" style="white-space: pre" font-size="27.2699" font-weight="bold" letter-spacing="0em">
                                  <tspan x="430.845" y="282.442">PROTEGE LA </tspan>
                                  <tspan x="421.67" y="315.442">INFORMACIÓN</tspan>
                                  <tspan x="408.595" y="348.442">DE TU EMPRESA</tspan>
                               </text>
                            </g>
                            <g id="Group_2">
                               <g class="h_btn" data-hover="h_text_8" id="h_btn_8">
                                  <path id="Vector_41" d="M403.097 192.543C425.14 192.543 443.009 174.674 443.009 152.63C443.009 130.587 425.14 112.718 403.097 112.718C381.054 112.718 363.184 130.587 363.184 152.63C363.184 174.674 381.054 192.543 403.097 192.543Z" fill="black"></path>
                                  <g id="Group 4">
                                     <path id="Vector_42" d="M408.211 137.926V133.359" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <g id="Group 3">
                                        <g id="Group_3">
                                           <path id="Vector_43" d="M406.385 159.663H399.9C398.712 159.663 397.708 158.658 397.708 157.471V152.813C397.708 151.626 398.712 150.621 399.9 150.621H406.385C407.572 150.621 408.577 151.626 408.577 152.813V157.471C408.577 158.75 407.572 159.663 406.385 159.663Z" stroke="white" stroke-width="1.661" stroke-miterlimit="10"></path>
                                           <path id="Vector_44" d="M399.809 150.713V146.237C399.809 144.684 401.087 143.406 402.64 143.406H403.279C404.832 143.406 406.11 144.684 406.11 146.237V150.713" stroke="white" stroke-width="1.661" stroke-miterlimit="10"></path>
                                           <path id="Vector_45" d="M403.279 156.01C403.733 156.01 404.101 155.315 404.101 154.457C404.101 153.6 403.733 152.905 403.279 152.905C402.825 152.905 402.457 153.6 402.457 154.457C402.457 155.315 402.825 156.01 403.279 156.01Z" fill="white"></path>
                                        </g>
                                        <path id="Vector_46" d="M403.188 165.234C410.905 165.234 417.162 158.978 417.162 151.26C417.162 143.543 410.905 137.287 403.188 137.287C395.47 137.287 389.214 143.543 389.214 151.26C389.214 158.978 395.47 165.234 403.188 165.234Z" stroke="white" stroke-width="1.661" stroke-miterlimit="10"></path>
                                        <path id="Vector_47" d="M424.286 144.41C425.244 144.41 426.021 143.633 426.021 142.675C426.021 141.717 425.244 140.94 424.286 140.94C423.327 140.94 422.55 141.717 422.55 142.675C422.55 143.633 423.327 144.41 424.286 144.41Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_48" d="M403.097 126.235C404.055 126.235 404.832 125.458 404.832 124.5C404.832 123.542 404.055 122.765 403.097 122.765C402.138 122.765 401.361 123.542 401.361 124.5C401.361 125.458 402.138 126.235 403.097 126.235Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_49" d="M398.165 130.985C399.123 130.985 399.9 130.208 399.9 129.249C399.9 128.291 399.123 127.514 398.165 127.514C397.206 127.514 396.429 128.291 396.429 129.249C396.429 130.208 397.206 130.985 398.165 130.985Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_50" d="M408.211 133.359C409.17 133.359 409.946 132.582 409.946 131.624C409.946 130.665 409.17 129.889 408.211 129.889C407.253 129.889 406.476 130.665 406.476 131.624C406.476 132.582 407.253 133.359 408.211 133.359Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_51" d="M427.3 152.904C428.258 152.904 429.035 152.128 429.035 151.169C429.035 150.211 428.258 149.434 427.3 149.434C426.341 149.434 425.564 150.211 425.564 151.169C425.564 152.128 426.341 152.904 427.3 152.904Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_52" d="M424.651 161.307C425.61 161.307 426.386 160.53 426.386 159.572C426.386 158.613 425.61 157.836 424.651 157.836C423.693 157.836 422.916 158.613 422.916 159.572C422.916 160.53 423.693 161.307 424.651 161.307Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_53" d="M424.651 157.836V155.188H416.705" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_54" d="M425.473 151.169H417.162" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_55" d="M424.286 144.41V147.15H416.796" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_56" d="M382.181 144.41C383.14 144.41 383.917 143.633 383.917 142.675C383.917 141.717 383.14 140.94 382.181 140.94C381.223 140.94 380.446 141.717 380.446 142.675C380.446 143.633 381.223 144.41 382.181 144.41Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_57" d="M379.167 152.904C380.126 152.904 380.903 152.128 380.903 151.169C380.903 150.211 380.126 149.434 379.167 149.434C378.209 149.434 377.432 150.211 377.432 151.169C377.432 152.128 378.209 152.904 379.167 152.904Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_58" d="M381.816 161.307C382.774 161.307 383.551 160.53 383.551 159.572C383.551 158.613 382.774 157.836 381.816 157.836C380.858 157.836 380.081 158.613 380.081 159.572C380.081 160.53 380.858 161.307 381.816 161.307Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_59" d="M381.816 157.836V155.188H389.762" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_60" d="M380.994 151.169H389.305" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_61" d="M382.181 144.41V147.15H389.671" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_62" d="M398.165 137.926V130.985" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_63" d="M403.096 137.013V126.327" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_64" d="M403.188 179.665C404.146 179.665 404.923 178.888 404.923 177.93C404.923 176.971 404.146 176.194 403.188 176.194C402.23 176.194 401.453 176.971 401.453 177.93C401.453 178.888 402.23 179.665 403.188 179.665Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_65" d="M408.211 175.007C409.17 175.007 409.946 174.23 409.946 173.272C409.946 172.313 409.17 171.536 408.211 171.536C407.253 171.536 406.476 172.313 406.476 173.272C406.476 174.23 407.253 175.007 408.211 175.007Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_66" d="M398.165 172.632C399.123 172.632 399.9 171.855 399.9 170.897C399.9 169.939 399.123 169.162 398.165 169.162C397.206 169.162 396.429 169.939 396.429 170.897C396.429 171.855 397.206 172.632 398.165 172.632Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_67" d="M398.165 164.504V169.07" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_68" d="M408.211 164.504V171.445" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_69" d="M403.188 165.417V176.194" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     </g>
                                  </g>
                               </g>
                               <g class="h_btn" data-hover="h_text_7" id="h_btn_7">
                                  <path id="Vector_70" d="M328.112 302.416C350.155 302.416 368.025 284.547 368.025 262.504C368.025 240.461 350.155 222.591 328.112 222.591C306.069 222.591 288.2 240.461 288.2 262.504C288.2 284.547 306.069 302.416 328.112 302.416Z" fill="#E52528"></path>
                                  <g id="Group 5">
                                     <g id="Group_4">
                                        <path id="Vector_71" d="M340.99 286.616C350.124 285.063 351.402 275.199 351.22 267.801C344.918 267.71 340.99 263.783 340.99 263.783C340.99 263.783 337.063 267.801 330.761 267.801C330.578 275.29 331.857 285.063 340.99 286.616Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_72" d="M343.548 281.318H338.25C337.246 281.318 336.515 280.496 336.515 279.583V275.747C336.515 274.742 337.337 274.012 338.25 274.012H343.548C344.552 274.012 345.283 274.834 345.283 275.747V279.583C345.374 280.588 344.552 281.318 343.548 281.318Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_73" d="M338.159 274.012V270.358C338.159 269.08 339.164 268.075 340.442 268.075H340.99C342.269 268.075 343.274 269.08 343.274 270.358V274.012" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_74" d="M340.99 278.304C341.394 278.304 341.721 277.732 341.721 277.026C341.721 276.32 341.394 275.747 340.99 275.747C340.587 275.747 340.26 276.32 340.26 277.026C340.26 277.732 340.587 278.304 340.99 278.304Z" fill="white"></path>
                                     </g>
                                     <path id="Vector_75" d="M315.874 264.239C317.883 261.042 321.262 259.764 325.372 259.764C329.117 259.764 332.496 261.042 334.597 263.874" stroke="white" stroke-width="3.6082" stroke-miterlimit="10" stroke-linecap="round"></path>
                                     <path id="Vector_76" d="M310.942 257.024C312.86 254.101 318.796 250.905 325.92 251.087C334.232 251.27 338.524 255.106 340.808 257.389" stroke="white" stroke-width="3.6082" stroke-miterlimit="10" stroke-linecap="round"></path>
                                     <path id="Vector_77" d="M305.005 250.174C307.38 247.069 314.138 241.771 325.92 241.954C339.072 242.228 344.187 248.256 346.47 250.539" stroke="white" stroke-width="3.6082" stroke-miterlimit="10" stroke-linecap="round"></path>
                                     <path id="Vector_78" d="M328.934 275.93C328.934 275.93 327.93 271.089 328.386 268.075C325.829 266.249 320.532 267.71 320.532 272.094C320.532 276.478 326.012 278.487 328.934 275.93Z" fill="white"></path>
                                  </g>
                               </g>
                               <g class="h_btn" data-hover="h_text_6" id="h_btn_6">
                                  <path id="Vector_79" d="M340.442 431.196C362.485 431.196 380.355 413.326 380.355 391.283C380.355 369.24 362.485 351.371 340.442 351.371C318.399 351.371 300.53 369.24 300.53 391.283C300.53 413.326 318.399 431.196 340.442 431.196Z" fill="black"></path>
                                  <g id="Group 6">
                                     <path id="Vector_80" d="M342.908 401.33V392.927L345.192 389.639H367.477L369.303 393.201V409.915H353.229" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_81" d="M369.303 393.292H342.908" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_82" d="M369.303 396.58H342.543" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_83" d="M369.303 399.777H350.58" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_84" d="M369.303 403.156H352.955" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_85" d="M369.303 406.444H353.777" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_86" d="M360.444 406.262V403.339" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_87" d="M360.444 399.594V396.672" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_88" d="M351.676 399.594V396.672" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_89" d="M364.828 409.641V406.718" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_90" d="M355.878 409.641V406.718" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_91" d="M364.828 403.248V400.325" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_92" d="M355.878 403.248V400.325" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_93" d="M364.828 396.307V393.384" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_94" d="M355.878 396.307V393.384" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_95" d="M347.384 396.307V393.384" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_96" d="M344.826 387.539H321.354C319.801 387.539 318.614 386.26 318.614 384.799V382.698C318.614 381.145 319.892 379.958 321.354 379.958H344.826C346.379 379.958 347.566 381.236 347.566 382.698V384.799C347.566 386.351 346.288 387.539 344.826 387.539Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_97" d="M327.473 382.15V385.164" stroke="white" stroke-width="1.8041" stroke-miterlimit="10" stroke-linecap="round"></path>
                                     <path id="Vector_98" d="M324.55 382.15V385.164" stroke="white" stroke-width="1.8041" stroke-miterlimit="10" stroke-linecap="round"></path>
                                     <path id="Vector_99" d="M321.628 382.15V385.164" stroke="white" stroke-width="1.8041" stroke-miterlimit="10" stroke-linecap="round"></path>
                                     <path id="Vector_100" d="M340.625 397.22H321.445C319.892 397.22 318.705 395.941 318.705 394.48V392.379C318.705 390.826 319.984 389.639 321.445 389.639H342.086" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_101" d="M327.473 391.74V394.754" stroke="white" stroke-width="1.8041" stroke-miterlimit="10" stroke-linecap="round"></path>
                                     <path id="Vector_102" d="M324.55 391.74V394.754" stroke="white" stroke-width="1.8041" stroke-miterlimit="10" stroke-linecap="round"></path>
                                     <path id="Vector_103" d="M321.628 391.74V394.754" stroke="white" stroke-width="1.8041" stroke-miterlimit="10" stroke-linecap="round"></path>
                                     <path id="Vector_104" d="M339.255 407.449H321.354C319.801 407.449 318.614 406.17 318.614 404.709V402.608C318.614 401.056 319.892 399.868 321.354 399.868H340.716" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_105" d="M327.473 402.06V405.074" stroke="white" stroke-width="1.8041" stroke-miterlimit="10" stroke-linecap="round"></path>
                                     <path id="Vector_106" d="M324.55 402.06V405.074" stroke="white" stroke-width="1.8041" stroke-miterlimit="10" stroke-linecap="round"></path>
                                     <path id="Vector_107" d="M321.628 402.06V405.074" stroke="white" stroke-width="1.8041" stroke-miterlimit="10" stroke-linecap="round"></path>
                                     <path id="Vector_108" d="M346.288 398.498C346.288 398.498 345.831 400.782 343.73 402.334C341.538 403.887 340.716 407.175 341.264 409.184C341.812 411.194 345.192 413.294 347.84 412.198C350.58 411.102 352.224 408.728 351.768 405.714C351.402 402.7 346.288 398.498 346.288 398.498Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10" stroke-linejoin="round"></path>
                                     <path id="Vector_109" d="M348.845 411.833C348.845 411.833 350.124 406.262 346.744 404.892C346.47 405.074 347.11 408.18 346.105 408.271C345.1 408.362 344.918 406.262 345.009 405.348C344.278 405.714 342.726 409.367 343.365 411.833" stroke="white" stroke-width="1.2027" stroke-miterlimit="10" stroke-linejoin="round"></path>
                                     <path id="Vector_110" d="M328.66 379.958C328.66 379.958 329.391 374.113 323.728 374.478C322.084 371.19 318.066 369.911 315.508 373.93C312.768 373.108 310.668 376.396 311.216 379.501C308.841 379.958 309.754 383.611 311.672 383.794H317.244" stroke="white" stroke-width="1.2027" stroke-miterlimit="10" stroke-linejoin="round"></path>
                                  </g>
                               </g>
                               <g class="h_btn" data-hover="h_text_5" id="h_btn_5">
                                  <path id="Vector_111" d="M511.6 535.041C533.643 535.041 551.512 517.172 551.512 495.129C551.512 473.085 533.643 455.216 511.6 455.216C489.557 455.216 471.688 473.085 471.688 495.129C471.688 517.172 489.557 535.041 511.6 535.041Z" fill="#E52528"></path>
                                  <g id="Group 7">
                                     <g id="Group_5">
                                        <path id="Vector_112" d="M525.574 518.418C536.534 516.591 537.995 504.81 537.812 495.951C530.323 495.859 525.574 491.11 525.574 491.11C525.574 491.11 520.916 495.859 513.335 495.951C513.153 504.81 514.614 516.591 525.574 518.418Z" stroke="white" stroke-width="1.8041" stroke-miterlimit="10" stroke-linejoin="round"></path>
                                        <path id="Vector_113" d="M528.588 512.117H522.195C521.007 512.117 520.094 511.204 520.094 510.016V505.449C520.094 504.262 521.007 503.349 522.195 503.349H528.588C529.775 503.349 530.689 504.262 530.689 505.449V510.016C530.689 511.204 529.775 512.117 528.588 512.117Z" stroke="white" stroke-width="1.4367" stroke-miterlimit="10"></path>
                                        <path id="Vector_114" d="M522.195 503.349V498.965C522.195 497.412 523.473 496.224 524.935 496.224H525.574C527.127 496.224 528.314 497.503 528.314 498.965V503.349" stroke="white" stroke-width="1.4367" stroke-miterlimit="10"></path>
                                        <path id="Vector_115" d="M525.574 508.463C526.028 508.463 526.396 507.809 526.396 507.002C526.396 506.195 526.028 505.541 525.574 505.541C525.12 505.541 524.752 506.195 524.752 507.002C524.752 507.809 525.12 508.463 525.574 508.463Z" fill="white" stroke="#E6007E" stroke-width="0.6014" stroke-miterlimit="10"></path>
                                     </g>
                                     <path id="Vector_116" d="M526.122 488.096V482.616C526.122 480.15 524.113 478.232 521.738 478.232H491.872C489.406 478.232 487.488 480.241 487.488 482.616V502.892C487.488 505.358 489.497 507.276 491.872 507.276H511.691" stroke="white" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                     <path id="Vector_117" d="M489.315 479.602L502.101 493.028C504.567 495.311 508.403 495.402 510.869 493.119L524.569 479.693" stroke="white" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                     <path id="Vector_118" d="M489.224 506.18L502.741 493.028" stroke="white" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                  </g>
                               </g>
                               <g class="h_btn" data-hover="h_text_4" id="h_btn_4">
                                  <path id="Vector_119" d="M683.032 431.196C705.075 431.196 722.944 413.326 722.944 391.283C722.944 369.24 705.075 351.371 683.032 351.371C660.989 351.371 643.119 369.24 643.119 391.283C643.119 413.326 660.989 431.196 683.032 431.196Z" fill="black"></path>
                                  <g id="Group 15">
                                     <path id="Vector_120" d="M661.112 403.522V376.304C661.112 374.843 662.299 373.565 663.852 373.565H702.851C704.312 373.565 705.591 374.752 705.591 376.304V403.522" stroke="white" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                     <g id="Group_6">
                                        <path id="Vector_121" d="M703.216 411.468H663.304L663.121 411.376C662.939 411.285 657.915 409.641 657.185 405.257C657.093 404.526 657.276 403.796 657.733 403.248C658.189 402.7 658.92 402.334 659.651 402.334H670.245L671.707 404.526H659.559C659.377 404.526 659.285 404.618 659.285 404.618C659.285 404.709 659.194 404.709 659.194 404.892C659.559 407.54 662.756 408.91 663.395 409.184H702.942C705.043 409.184 706.322 406.627 706.961 405.166C707.052 404.983 706.961 404.892 706.87 404.8C706.778 404.709 706.687 404.618 706.504 404.618H694.54L696.092 402.426H706.504C707.418 402.426 708.148 402.882 708.696 403.613C709.153 404.344 709.336 405.257 708.97 405.988C707.874 409.458 705.682 411.468 703.216 411.468Z" fill="white"></path>
                                     </g>
                                     <g id="Group_7">
                                        <path id="Vector_122" d="M673.624 383.429H661.112V381.237H676.091L673.624 383.429Z" fill="white"></path>
                                     </g>
                                     <g id="Group_8">
                                        <path id="Vector_123" d="M705.5 383.429H693.535L690.521 381.237H705.5V383.429Z" fill="white"></path>
                                     </g>
                                     <path id="Vector_124" d="M683.58 406.901C690.49 406.901 696.092 401.299 696.092 394.389C696.092 387.478 690.49 381.876 683.58 381.876C676.669 381.876 671.067 387.478 671.067 394.389C671.067 401.299 676.669 406.901 683.58 406.901Z" stroke="white" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                     <path id="Vector_125" d="M693.261 402.334L675.634 384.707" stroke="white" stroke-width="2.4055" stroke-miterlimit="10"></path>
                                     <path id="Vector_126" d="M682.484 396.489L687.872 391.375C687.872 391.375 689.79 391.923 690.795 390.644C691.343 389.913 688.603 387.447 687.872 387.265C687.142 387.082 686.32 387.63 686.776 390.279C683.854 393.019 681.57 395.484 681.57 395.484L679.47 393.475L676.73 396.398C676.364 396.763 676.182 397.311 676.182 397.859L676.364 400.142C676.456 400.964 677.004 401.604 677.826 401.695L679.561 401.969C680.2 402.06 680.84 401.878 681.388 401.421L684.493 398.498L682.484 396.489Z" fill="white"></path>
                                  </g>
                                  <path id="Vector_127" d="M683.306 380.049C684.314 380.049 685.132 379.231 685.132 378.223C685.132 377.214 684.314 376.396 683.306 376.396C682.297 376.396 681.479 377.214 681.479 378.223C681.479 379.231 682.297 380.049 683.306 380.049Z" fill="white"></path>
                               </g>
                               <g class="h_btn" data-hover="h_text_3" id="h_btn_3">
                                  <path id="Vector_128" d="M695.088 302.416C717.131 302.416 735 284.547 735 262.504C735 240.461 717.131 222.591 695.088 222.591C673.045 222.591 655.175 240.461 655.175 262.504C655.175 284.547 673.045 302.416 695.088 302.416Z" fill="#E52528"></path>
                                  <g id="ico-seguridad">
                                     <g id="Group 1">
                                        <path id="Vector_129" d="M707.874 274.834H696.275C694.722 274.834 693.535 273.555 693.535 272.094V251.909C693.535 250.357 694.814 249.169 696.275 249.169H707.874C709.427 249.169 710.614 250.448 710.614 251.909V254.741" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_130" d="M711.893 274.834H707.874C706.322 274.834 705.134 273.555 705.134 272.094V257.481C705.134 255.928 706.413 254.741 707.874 254.741H714.085C715.637 254.741 716.825 256.019 716.825 257.481V265.335" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_131" d="M693.627 270.085H668.054C666.501 270.085 665.314 268.806 665.314 267.345V247.16C665.314 245.607 666.592 244.42 668.054 244.42H698.741C700.294 244.42 701.481 245.699 701.481 247.16V248.987" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_132" d="M693.535 265.609H665.222" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_133" d="M705.043 258.394H716.825" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_134" d="M693.443 252.731H710.614" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_135" d="M709.336 270.541H705.043" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_136" d="M703.673 270.541H693.627" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_137" d="M676.912 270.541V273.098" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_138" d="M690.247 270.541V272.642" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_139" d="M695.27 274.834H666.409C665.77 274.834 665.313 274.377 665.313 273.738C665.313 273.098 665.77 272.642 666.409 272.642H680.292C680.474 272.642 680.748 272.733 680.931 272.824C681.388 273.098 682.392 273.738 683.397 273.738H686.228C686.502 273.738 686.867 273.646 687.05 273.372L687.415 273.007C687.598 272.733 687.963 272.642 688.237 272.642H693.443" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_140" d="M683.397 268.806C683.851 268.806 684.219 268.438 684.219 267.984C684.219 267.53 683.851 267.162 683.397 267.162C682.943 267.162 682.575 267.53 682.575 267.984C682.575 268.438 682.943 268.806 683.397 268.806Z" fill="white"></path>
                                        <path id="Vector_141" d="M702.029 273.738C702.483 273.738 702.851 273.37 702.851 272.916C702.851 272.462 702.483 272.094 702.029 272.094C701.575 272.094 701.207 272.462 701.207 272.916C701.207 273.37 701.575 273.738 702.029 273.738Z" fill="white"></path>
                                     </g>
                                     <g id="Group_9">
                                        <path id="Vector_142" d="M718.195 280.496C724.679 279.4 725.593 272.459 725.41 267.162C720.935 267.07 718.195 264.239 718.195 264.239C718.195 264.239 715.455 267.07 710.979 267.162C710.797 272.459 711.71 279.4 718.195 280.496Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_143" d="M720.021 276.752H716.277C715.546 276.752 714.998 276.204 714.998 275.473V272.733C714.998 272.003 715.546 271.455 716.277 271.455H720.021C720.752 271.455 721.3 272.003 721.3 272.733V275.473C721.3 276.204 720.752 276.752 720.021 276.752Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_144" d="M716.186 271.546V268.897C716.186 267.984 716.916 267.253 717.83 267.253H718.195C719.108 267.253 719.839 267.984 719.839 268.897V271.546" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                        <path id="Vector_145" d="M718.195 274.651C718.447 274.651 718.651 274.242 718.651 273.738C718.651 273.233 718.447 272.824 718.195 272.824C717.943 272.824 717.738 273.233 717.738 273.738C717.738 274.242 717.943 274.651 718.195 274.651Z" fill="white"></path>
                                     </g>
                                  </g>
                               </g>
                               <g class="h_btn" data-hover="h_text_2" id="h_btn_2">
                                  <path id="Vector_146" d="M620.286 192.543C642.329 192.543 660.198 174.674 660.198 152.63C660.198 130.587 642.329 112.718 620.286 112.718C598.243 112.718 580.374 130.587 580.374 152.63C580.374 174.674 598.243 192.543 620.286 192.543Z" fill="black"></path>
                                  <g id="ico-casa-candado">
                                     <path id="Vector_147" d="M635.922 173.82C643.867 172.45 644.872 163.956 644.781 157.562C639.301 157.471 635.922 154.092 635.922 154.092C635.922 154.092 632.543 157.562 627.063 157.562C626.88 163.956 627.976 172.45 635.922 173.82Z" stroke="white" stroke-width="1.4645" stroke-miterlimit="10"></path>
                                     <path id="Vector_148" d="M638.461 169.527H633.895C633.073 169.527 632.342 168.888 632.342 167.974V164.686C632.342 163.864 632.981 163.134 633.895 163.134H638.461C639.283 163.134 640.014 163.773 640.014 164.686V167.974C640.014 168.796 639.283 169.527 638.461 169.527Z" stroke="white" stroke-width="1.4645" stroke-miterlimit="10"></path>
                                     <path id="Vector_149" d="M633.803 163.134V159.937C633.803 158.841 634.717 157.928 635.813 157.928H636.269C637.365 157.928 638.278 158.841 638.278 159.937V163.134" stroke="white" stroke-width="1.4645" stroke-miterlimit="10"></path>
                                     <path id="Vector_150" d="M636.269 166.878C636.622 166.878 636.909 166.388 636.909 165.782C636.909 165.177 636.622 164.686 636.269 164.686C635.916 164.686 635.63 165.177 635.63 165.782C635.63 166.388 635.916 166.878 636.269 166.878Z" fill="white"></path>
                                     <path id="Vector_151" d="M638.278 152.174V138.748H627.41" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_152" d="M627.41 155.37V130.893H610.239V168.066" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_153" d="M626.314 168.066H595.443" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_154" d="M599.645 168.066V138.748H610.239" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_155" d="M615.537 168.34V159.115H622.478V168.34" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_156" d="M602.293 168.066V165.782C602.293 165.782 604.668 165.782 604.851 162.312C605.125 158.384 603.298 154.64 602.293 154.64C601.289 154.64 599.553 157.38 599.553 160.028C599.553 162.677 599.827 166.056 602.293 165.782" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_157" d="M605.49 147.424H604.303C603.663 147.424 603.207 146.968 603.207 146.328V143.497C603.207 142.858 603.663 142.401 604.303 142.401H605.49C606.129 142.401 606.586 142.858 606.586 143.497V146.328C606.586 146.968 606.129 147.424 605.49 147.424Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_158" d="M605.49 155.644H604.303C603.663 155.644 603.207 155.188 603.207 154.548V151.717C603.207 151.078 603.663 150.621 604.303 150.621H605.49C606.129 150.621 606.586 151.078 606.586 151.717V154.548C606.586 155.188 606.129 155.644 605.49 155.644Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_159" d="M616.176 147.424H614.989C614.35 147.424 613.893 146.968 613.893 146.328V143.497C613.893 142.858 614.35 142.401 614.989 142.401H616.176C616.815 142.401 617.272 142.858 617.272 143.497V146.328C617.272 146.968 616.815 147.424 616.176 147.424Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_160" d="M616.176 155.644H614.989C614.35 155.644 613.893 155.188 613.893 154.548V151.717C613.893 151.078 614.35 150.621 614.989 150.621H616.176C616.815 150.621 617.272 151.078 617.272 151.717V154.548C617.272 155.188 616.815 155.644 616.176 155.644Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_161" d="M623.026 147.424H621.839C621.2 147.424 620.743 146.968 620.743 146.328V143.497C620.743 142.858 621.2 142.401 621.839 142.401H623.026C623.665 142.401 624.122 142.858 624.122 143.497V146.328C624.213 146.968 623.665 147.424 623.026 147.424Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_162" d="M616.176 139.204H614.989C614.35 139.204 613.893 138.748 613.893 138.108V135.277C613.893 134.638 614.35 134.181 614.989 134.181H616.176C616.815 134.181 617.272 134.638 617.272 135.277V138.108C617.272 138.748 616.815 139.204 616.176 139.204Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_163" d="M623.026 139.204H621.839C621.2 139.204 620.743 138.748 620.743 138.108V135.277C620.743 134.638 621.2 134.181 621.839 134.181H623.026C623.665 134.181 624.122 134.638 624.122 135.277V138.108C624.213 138.748 623.665 139.204 623.026 139.204Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_164" d="M633.712 147.424H632.525C631.885 147.424 631.429 146.968 631.429 146.328V143.497C631.429 142.858 631.885 142.401 632.525 142.401H633.712C634.351 142.401 634.808 142.858 634.808 143.497V146.328C634.808 146.968 634.351 147.424 633.712 147.424Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_165" d="M631.429 154.549V151.717C631.429 151.078 631.885 150.621 632.525 150.621H633.712C634.351 150.621 634.808 151.078 634.808 151.717V152.63" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                     <path id="Vector_166" d="M623.026 155.644H621.839C621.2 155.644 620.743 155.188 620.743 154.548V151.717C620.743 151.078 621.2 150.621 621.839 150.621H623.026C623.665 150.621 624.122 151.078 624.122 151.717V154.548C624.213 155.188 623.665 155.644 623.026 155.644Z" stroke="white" stroke-width="1.2027" stroke-miterlimit="10"></path>
                                  </g>
                               </g>
                               <g class="h_btn" data-hover="h_text_1" id="h_btn_1">
                                  <path id="Vector_167" d="M511.6 128.884C533.643 128.884 551.512 111.014 551.512 88.9714C551.512 66.9284 533.643 49.059 511.6 49.059C489.557 49.059 471.688 66.9284 471.688 88.9714C471.688 111.014 489.557 128.884 511.6 128.884Z" fill="#E52528"></path>
                                  <g id="Group 2">
                                     <g id="Group_10">
                                        <path id="Vector_168" d="M506.211 96.6434H500.457C499.361 96.6434 498.539 95.8214 498.539 94.7254V90.6155C498.539 89.5195 499.361 88.6975 500.457 88.6975H506.211C507.307 88.6975 508.129 89.5195 508.129 90.6155V94.7254C508.129 95.8214 507.307 96.6434 506.211 96.6434Z" stroke="white" stroke-width="1.661" stroke-miterlimit="10"></path>
                                        <path id="Vector_169" d="M500.366 88.6974V84.6788C500.366 83.3088 501.462 82.1215 502.923 82.1215H503.471C504.841 82.1215 506.029 83.2175 506.029 84.6788V88.6974" stroke="white" stroke-width="1.661" stroke-miterlimit="10"></path>
                                        <path id="Vector_170" d="M503.471 93.3554C503.875 93.3554 504.202 92.7421 504.202 91.9854C504.202 91.2288 503.875 90.6155 503.471 90.6155C503.068 90.6155 502.741 91.2288 502.741 91.9854C502.741 92.7421 503.068 93.3554 503.471 93.3554Z" fill="white"></path>
                                     </g>
                                     <g id="Group_11">
                                        <path id="Vector_171" d="M508.677 84.4961H532.515C533.52 84.4961 534.342 85.3181 534.342 86.3228V105.046" stroke="white" stroke-width="1.661" stroke-miterlimit="10"></path>
                                        <path id="Vector_172" d="M503.745 105.046V98.8354" stroke="white" stroke-width="1.661" stroke-miterlimit="10"></path>
                                        <g id="Group_12">
                                           <path id="Vector_173" d="M532.789 110.526H505.207H505.115C504.933 110.435 501.462 109.339 501.005 106.325C500.914 105.868 501.097 105.32 501.371 104.955C501.736 104.589 502.193 104.315 502.741 104.315H528.953L529.319 105.868H502.832C502.741 105.868 502.649 105.959 502.649 105.959C502.649 105.959 502.558 106.051 502.558 106.142C502.832 107.969 505.024 108.882 505.481 109.065H532.789C534.251 109.065 535.164 107.329 535.529 106.233C535.621 106.142 535.529 106.051 535.529 105.959C535.529 105.868 535.438 105.868 535.255 105.868H526.944L528.04 104.315H535.255C535.895 104.315 536.443 104.589 536.717 105.137C537.082 105.594 537.173 106.233 536.899 106.781C536.077 109.247 534.525 110.526 532.789 110.526Z" fill="white"></path>
                                        </g>
                                        <g id="Group_13">
                                           <path id="Vector_174" d="M534.433 89.7021H510.139V91.2548H534.433V89.7021Z" fill="white"></path>
                                        </g>
                                        <path id="Vector_175" d="M519.089 88.8801C519.795 88.8801 520.368 88.3077 520.368 87.6015C520.368 86.8953 519.795 86.3228 519.089 86.3228C518.383 86.3228 517.811 86.8953 517.811 87.6015C517.811 88.3077 518.383 88.8801 519.089 88.8801Z" fill="white"></path>
                                     </g>
                                     <path id="Vector_176" d="M501.462 99.7487C493.699 98.5614 487.854 92.0767 487.854 84.3135C487.854 75.7282 495.069 68.6955 504.019 68.6955C512.057 68.6955 518.724 74.3582 520.003 81.7561" stroke="white" stroke-width="1.661" stroke-miterlimit="10"></path>
                                     <path id="Vector_177" d="M515.527 73.3535C512.513 75.9109 508.312 77.4635 503.837 77.4635C499.453 77.4635 495.525 76.0022 492.511 73.6275" stroke="white" stroke-width="1.661" stroke-miterlimit="10"></path>
                                     <path id="Vector_178" d="M487.854 84.4048H498.448" stroke="white" stroke-width="1.661" stroke-miterlimit="10"></path>
                                     <path id="Vector_179" d="M504.019 68.7869V79.8382" stroke="white" stroke-width="1.661" stroke-miterlimit="10"></path>
                                     <path id="Vector_180" d="M503.563 69.6089C503.563 69.6089 493.151 75.5455 496.439 90.2501" stroke="white" stroke-width="1.661" stroke-miterlimit="10"></path>
                                     <path id="Vector_181" d="M503.837 69.6089C503.837 69.6089 510.23 73.2622 511.417 81.9388" stroke="white" stroke-width="1.661" stroke-miterlimit="10"></path>
                                     <path id="Vector_182" d="M492.42 95.182L496.53 92.6247" stroke="white" stroke-width="1.661" stroke-miterlimit="10"></path>
                                  </g>
                               </g>
                            </g>
                            <g id="all_text">
                               <g id="text_proteccion">
                                  <text class="h_text h_text_8" style="display: none;" id="contenido_8" fill="black" xml:space="preserve" font-family="Roboto" font-size="13" letter-spacing="0em">
                                     <tspan x="86.1445" y="93.4434">Detecta el malware </tspan>
                                     <tspan x="68.917" y="107.443">desconocido y lo aísla </tspan>
                                     <tspan x="45.6846" y="121.443">antes que ingrese a la red.</tspan>
                                  </text>
                                  <text class="h_btn" data-hover="h_text_8" id="titulo_8" fill="black" xml:space="preserve" style="white-space: pre" font-size="17" font-weight="bold" letter-spacing="0em">
                                     <tspan x="221.416" y="93.25">Protección contra</tspan>
                                     <tspan x="246.534" y="113.25">Malware Día 0 </tspan>
                                     <tspan x="253.723" y="133.25">(SandBoxing)</tspan>
                                  </text>
                               </g>
                               <g id="text_wifi_seguro">
                                  <text class="h_text h_text_7" style="display: none;" id="contenido_7" fill="black" xml:space="preserve" font-family="Roboto" font-size="13" letter-spacing="0em">
                                     <tspan x="33.6543" y="246.443">Analiza el tráfico y </tspan>
                                     <tspan x="34.6699" y="260.443">aplica políticas de </tspan>
                                     <tspan x="7.70508" y="274.443">seguridad a los puntos </tspan>
                                     <tspan x="20.375" y="288.443">vulnerables de la red </tspan>
                                     <tspan x="67.792" y="302.443">inalámbrica.</tspan>
                                  </text>
                                  <text class="h_btn" data-hover="h_text_7" id="titulo_7" fill="black" xml:space="preserve" style="white-space: pre" font-size="17" font-weight="bold" letter-spacing="0em">
                                     <tspan x="171.532" y="269.25">Wi-Fi Seguro</tspan>
                                  </text>
                               </g>
                               <g id="text_webapp">
                                  <text class="h_text h_text_6" style="display: none;" id="contenido_6" fill="black" xml:space="preserve" font-family="Roboto" font-size="13" letter-spacing="0em">
                                     <tspan x="24.1113" y="400.443">Monitorea y bloquea </tspan>
                                     <tspan x="26.7646" y="414.443">ataques a páginas y </tspan>
                                     <tspan x="38.6602" y="428.443">aplicaciones web.</tspan>
                                  </text>
                                  <text class="h_btn" data-hover="h_text_6" id="titulo_6" fill="black" xml:space="preserve" style="white-space: pre" font-size="17" font-weight="bold" letter-spacing="0em">
                                     <tspan x="171.205" y="402.25">Web Aplication</tspan>
                                     <tspan x="171.952" y="422.25">Firewall (WAF)</tspan>
                                  </text>
                               </g>
                               <g id="text_correo">
                                  <text class="h_text h_text_5" style="display: none;" id="contenido_5" fill="black" xml:space="preserve" font-family="Roboto" font-size="13" letter-spacing="0em">
                                     <tspan x="310.169" y="561.443">Detecta y elimina los </tspan>
                                     <tspan x="305.269" y="575.443">correos no deseados.</tspan>
                                  </text>
                                  <text class="h_btn" data-hover="h_text_5" id="titulo_5" fill="black" xml:space="preserve" style="white-space: pre" font-size="17" font-weight="bold" letter-spacing="0em">
                                     <tspan x="460.721" y="561.25">Correo Seguro </tspan>
                                     <tspan x="471.072" y="581.25">(Anti Spam)</tspan>
                                  </text>
                               </g>
                               <g id="text_proteccion_denegacion">
                                  <text class="h_btn" data-hover="h_text_4" id="titulo_4" fill="black" xml:space="preserve" style="white-space: pre" font-size="17" font-weight="bold" letter-spacing="0em">
                                     <tspan x="744" y="373.75">Protección </tspan>
                                     <tspan x="744" y="390.75">de Denegación</tspan>
                                     <tspan x="744" y="407.75">de Servicio </tspan>
                                     <tspan x="744" y="424.75">(DDoS)</tspan>
                                  </text>
                                  <text class="h_text h_text_4" style="display: none;" id="contenido_4" fill="black" xml:space="preserve" font-family="Roboto" font-size="13" letter-spacing="0em">
                                     <tspan x="887" y="370.443">Mitiga los ataques </tspan>
                                     <tspan x="887" y="384.443">distribuidos de </tspan>
                                     <tspan x="887" y="398.443">denegación de servicio </tspan>
                                     <tspan x="887" y="412.443">contra los servicios </tspan>
                                     <tspan x="887" y="426.443">expuestos en Internet.</tspan>
                                  </text>
                               </g>
                               <g id="text_proteccion_endpoint">
                                  <text class="h_btn" data-hover="h_text_3" id="titulo_3" fill="black" xml:space="preserve" style="white-space: pre" font-size="17" font-weight="bold" letter-spacing="0em">
                                     <tspan x="753" y="257.25">Protección</tspan>
                                     <tspan x="753" y="273.25">de Endpoints</tspan>
                                  </text>
                                  <text class="h_text h_text_3" style="display: none;" id="contenido_3" fill="black" xml:space="preserve" font-family="Roboto" font-size="13" letter-spacing="0em">
                                     <tspan x="872" y="238.443">Protege los </tspan>
                                     <tspan x="872" y="252.443">dispositivos de los </tspan>
                                     <tspan x="872" y="266.443">usuarios finales, </tspan>
                                     <tspan x="872" y="280.443">como PC. Laptop, </tspan>
                                     <tspan x="872" y="294.443">Smartphone y Tablet.</tspan>
                                  </text>
                               </g>
                               <g id="text_seguridad_perimental">
                                  <text class="h_btn" data-hover="h_text_2" id="titulo_2" fill="black" xml:space="preserve" style="white-space: pre" font-size="17" font-weight="bold" letter-spacing="0em">
                                     <tspan x="680" y="133.25">Seguridad </tspan>
                                     <tspan x="680" y="153.25">Perimetral</tspan>
                                  </text>
                                  <text class="h_text h_text_2" style="display: none;" id="contenido_2" fill="black" xml:space="preserve" font-family="Roboto" font-size="13" letter-spacing="0em">
                                     <tspan x="789" y="113.443">Previene y permite reaccionar </tspan>
                                     <tspan x="789" y="127.443">ante el riesgo de un incidente </tspan>
                                     <tspan x="789" y="141.443">de seguridad que puede </tspan>
                                     <tspan x="789" y="155.443">propiciar la pérdida de </tspan>
                                     <tspan x="789" y="169.443">información.</tspan>
                                  </text>
                               </g>
                               <g id="text_internet">
                                  <text class="h_btn" data-hover="h_text_1" id="titulo_1" fill="black" xml:space="preserve" style="white-space: pre" font-size="17" font-weight="bold" letter-spacing="0em">
                                     <tspan x="459.73" y="14.25">Internet Seguro </tspan>
                                     <tspan x="474.954" y="34.25">(Filtro Web)</tspan>
                                  </text>
                                  <text class="h_text h_text_1" style="display: none;" id="contenido_1" fill="black" xml:space="preserve" font-family="Roboto" font-size="13" letter-spacing="0em">
                                     <tspan x="605" y="11.4434">Evita que el tráfico malicioso </tspan>
                                     <tspan x="605" y="25.4434">ingrese a la red a través de sitios </tspan>
                                     <tspan x="605" y="39.4434">web de dudosa procedencia.</tspan>
                                  </text>
                               </g>
                            </g>
                            <a href="https://www.claro.com.pe/empresas/ciberseguridad" target="_blank">
                                <g class="h_btn" data-redirect="https://www.claro.com.pe/empresas/ciberseguridad/" id="btn_solicitar">
                                   <g id="Rectangle 18" filter="url(#filter0_d)">
                                      <rect x="696" y="526" width="178" height="55" rx="10" fill="url(#paint0_linear)"></rect>
                                   </g>
                                   <text id="SOLICITA ESTOS SERVICIOS AQUÃ" fill="white" xml:space="preserve" style="white-space: pre" font-family="Roboto" font-size="14" font-weight="bold" letter-spacing="0em">
                                      <tspan x="731.502" y="551.786">SOLICITA ESTOS </tspan>
                                      <tspan x="732.103" y="567.786">SERVICIOS AQUÍ</tspan>
                                   </text>
                                </g>
                            </a>
                         </g>
                         <defs>
                            <filter id="filter0_d" x="692" y="526" width="186" height="63" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                               <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                               <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"></feColorMatrix>
                               <feOffset dy="4"></feOffset>
                               <feGaussianBlur stdDeviation="2"></feGaussianBlur>
                               <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"></feColorMatrix>
                               <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"></feBlend>
                               <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"></feBlend>
                            </filter>
                            <linearGradient id="paint0_linear" x1="785" y1="526" x2="785" y2="581" gradientUnits="userSpaceOnUse">
                               <stop stop-color="#E52528"></stop>
                               <stop offset="1" stop-color="#C62715"></stop>
                            </linearGradient>
                         </defs>
                      </svg>
                      <!-- <div class="btn_call_action">
                         <a href="#">SOLICITA ESTOS <br> SERVICIOS AQUÍ</a>
                         </div> -->
                   </div>

                   <div class="detalle_de_articulos__article__acordeon">
                       <strong class="detalle_de_articulos__article__acordeon__title">Protege la <span>Información de tu empresa</span></strong>
                       <div class="detalle_de_articulos__article__acordeon__list">
                           <div class="detalle_de_articulos__article__acordeon__item">
                               <strong class="detalle_de_articulos__article__acordeon__item__title fnAcordeonItem">
                                   <img src="/assets/public/images/ico_ac_1.svg" alt="">
                                   Internet seguro (Filtro web)
                                   <img src="/assets/public/images/ico_ac_arrow.svg" alt="">
                               </strong>
                               <p class="detalle_de_articulos__article__acordeon__item__resume">
                                   Evita que el tráfico malicioso ingrese a la red a través de sitios web de dudosa procedencia.
                               </p>
                           </div>
                           <div class="detalle_de_articulos__article__acordeon__item">
                               <strong class="detalle_de_articulos__article__acordeon__item__title fnAcordeonItem">
                                   <img src="/assets/public/images/ico_ac_2.svg" alt="">
                                   Seguridad Perimental
                                   <img src="/assets/public/images/ico_ac_arrow.svg" alt="">
                               </strong>
                               <p class="detalle_de_articulos__article__acordeon__item__resume">
                                   Previene y permite reaccionar ante el riesgo de un incidente de seguridad que puede propiciar la pérdida de información.
                               </p>
                           </div>
                           <div class="detalle_de_articulos__article__acordeon__item">
                               <strong class="detalle_de_articulos__article__acordeon__item__title fnAcordeonItem">
                                   <img src="/assets/public/images/ico_ac_3.svg" alt="">
                                   Protección de Endpoints
                                   <img src="/assets/public/images/ico_ac_arrow.svg" alt="">
                               </strong>
                               <p class="detalle_de_articulos__article__acordeon__item__resume">
                                   Protege los dispositivos de los usuarios finales, como PC. Laptop, Smartphone y Tablet.
                               </p>
                           </div>
                           <div class="detalle_de_articulos__article__acordeon__item">
                               <strong class="detalle_de_articulos__article__acordeon__item__title fnAcordeonItem">
                                   <img src="/assets/public/images/ico_ac_4.svg" alt="">
                                   Protección de Denegación de servicios (DDoS)
                                   <img src="/assets/public/images/ico_ac_arrow.svg" alt="">
                               </strong>
                               <p class="detalle_de_articulos__article__acordeon__item__resume">
                                   Mitiga los ataques distribuidos de denegación de servicio contra los servicios expuestos en Internet.
                               </p>
                           </div>
                           <div class="detalle_de_articulos__article__acordeon__item">
                               <strong class="detalle_de_articulos__article__acordeon__item__title fnAcordeonItem">
                                   <img src="/assets/public/images/ico_ac_5.svg" alt="">
                                   Correo Seguro (Anti Spam)
                                   <img src="/assets/public/images/ico_ac_arrow.svg" alt="">
                               </strong>
                               <p class="detalle_de_articulos__article__acordeon__item__resume">
                                   Detecta y elimina los correos no deseados.
                               </p>
                           </div>
                           <div class="detalle_de_articulos__article__acordeon__item">
                               <strong class="detalle_de_articulos__article__acordeon__item__title fnAcordeonItem">
                                   <img src="/assets/public/images/ico_ac_6.svg" alt="">
                                   Web Aplication Firewall (WAF)
                                   <img src="/assets/public/images/ico_ac_arrow.svg" alt="">
                               </strong>
                               <p class="detalle_de_articulos__article__acordeon__item__resume">
                                   Monitorea y bloquea ataques a páginas y aplicaciones web.
                               </p>
                           </div>
                           <div class="detalle_de_articulos__article__acordeon__item">
                               <strong class="detalle_de_articulos__article__acordeon__item__title fnAcordeonItem">
                                   <img src="/assets/public/images/ico_ac_7.svg" alt="">
                                   Wi-Fi Seguro
                                   <img src="/assets/public/images/ico_ac_arrow.svg" alt="">
                               </strong>
                               <p class="detalle_de_articulos__article__acordeon__item__resume">
                                   Analiza el tráfico y aplica políticas de seguridad a los puntos vulnerables de la red inalámbrica.
                               </p>
                           </div>
                           <div class="detalle_de_articulos__article__acordeon__item">
                               <strong class="detalle_de_articulos__article__acordeon__item__title fnAcordeonItem">
                                   <img src="/assets/public/images/ico_ac_8.svg" alt="">
                                   Protección contra Malware Día 0 (SandBoxing)
                                   <img src="/assets/public/images/ico_ac_arrow.svg" alt="">
                               </strong>
                               <p class="detalle_de_articulos__article__acordeon__item__resume">
                                   Detecta el malware desconocido y lo aísla antes que ingrese a la red.
                               </p>
                           </div>
                       </div>
                       <a href="https://www.claro.com.pe/empresas/ciberseguridad" target="_blank" class="detalle_de_articulos__article__acordeon__button">Solicita estos servicios aquí</a>
                   </div>
               </div>

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
                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}" target="_blank" class="m--linkedin">
                    <img src="/assets/public/images/social_linkedin.png" alt="Compartir en Linkedin" loading="lazy">
                    <span>Linkedin</span>
                </a>
                <a href="https://api.whatsapp.com/send?text={{ url()->current() }}" target="_blank" class="m--wsp">
                    <img src="/assets/public/images/social_wsp.png" alt="Compartir en Whatsapp" loading="lazy">
                    <span>Whatsapp</span>
                </a>
                <a href="http://www.facebook.com/dialog/send?app_id=1127021294451565&link={{ url()->current() }}&redirect_uri={{ url()->current() }}" target="_blank" class="m--msn">
                    <img src="/assets/public/images/social_msn.png" alt="Compartir en Messenger" loading="lazy">
                    <span>Mesenger</span>
                </a>
                <a href="mailto:info@example.com?&subject=&cc=&bcc=&body={{ url()->current() }}" target="_blank" class="m--gmail">
                    <img src="/assets/public/images/social_gmail.png" alt="Compartir en Gmail" loading="lazy">
                    <span>Gmail</span>
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
            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}" target="_blank">
                <img src="/assets/public/images/social_linkedin.png" alt="Compartir en Linkedin" loading="lazy">
            </a>
            <a href="https://api.whatsapp.com/send?text={{ url()->current() }}" target="_blank">
                <img src="/assets/public/images/social_wsp.png" alt="Compartir en Whatsapp" loading="lazy">
            </a>
            <a href="http://www.facebook.com/dialog/send?app_id=1127021294451565&link={{ url()->current() }}&redirect_uri={{ url()->current() }}" target="_blank">
                <img src="/assets/public/images/social_msn.png" alt="Compartir en Messenger" loading="lazy">
            </a>
            <a href="mailto:info@example.com?&subject=&cc=&bcc=&body={{ url()->current() }}" target="_blank">
                <img src="/assets/public/images/social_gmail.png" alt="Compartir en Gmail" loading="lazy">
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
