@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row  d-block d-sm-none">
        <div class="col-12 p-0">
            <div class="row__picture">
                <img src="/images/fondomovil2.jpg" class="row__imagen">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 bg-login d-none d-sm-block">

        </div>
        <div class="col-md-6 container__content">
            <div class="container__bloque">
                @if(session('info'))
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success alerthome">
                                {{ session('info')}}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

           <div class="row justify-content-center">
               <div class="col-md-6 col-lg-9">

                    <div class="card container__card"  data-aos="zoom-in">
                        <div class="card-header text-center container__header">
                            <div class="card-header__titulo">
                                <strong>Bienvenido a<br> Hablando Claro</strong>
                            </div>
                        </div>

                        <div class="card-body container__body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf



                                <div class="form-group row">

                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="Ingresa tu usuario" placeholder="Ingresa tu usuario" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"  placeholder="Ingresar tu contraseña">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                               <!-- <div class="form-group row">
                                    <div class="col-md-12  text-right">
                                        <a href="/recuperar-cuenta">Olvidaste tu contraseña</a>
                                    </div>
                                </div>-->

                                <div class="form-group row justify-content-center">
                                    <div class="col-md-6 col-6 form-group__boton">
                                        <button type="submit" class="btn btn-red">
                                            Iniciar sesión
                                        </button>
                                    </div>
                                    <!--<div class="col-md-6  col-6 text-right form-group__registro">
                                        <a href="/registro">¿Nuevo Usuario?</a>
                                    </div>-->
                                </div>

                            </form>
                        </div>
                    </div>

               </div>
           </div>


         </div>
        </div>
    </div>
</div>
@endsection
