@extends('layouts.frontend.app')
@section('content')

      <section class="error">
       <article class="limit">
           <h4 class="error__title">
               Error
               <strong>429</strong>
           </h4>
           <strong class="error__subtitle"> Demasiadas peticiones </strong>
           <p class="error__text">Regresa a la página de inicio</p>
           <div class="g-button-group">
               <a href="/" class="g-button m--mini m--211 m--rojo">Ir a inicio</a>
           </div>
       </article>
   </section>

@endsection
