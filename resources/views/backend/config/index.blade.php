@extends('layouts.backend.app')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Configuración de parametros globales</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

                <li class="breadcrumb-item active">Configuración</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @if(session('info'))
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        {{ session('info')}}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">

            <!-- /.card-header -->
            <div class="card-body">



                <div class="row">
                    <div class="card col-sm-12">




                            <form role="form" action="{{ route('configuration.update',$conf->id) }}" method="POST" enctype="multipart/form-data">
                                <div class="card-body">

                                  <div class="row">
                                    @csrf
                                    <input type="hidden" name="_method" value="PUT">






                                <div class="form-group @if($errors->first('titulo')) has-error @endif col-sm-6">
                                    <label for="titulo" class="control-label">Título  </label>
                                        <input type="text"  name="titulo" class="form-control" value="{{ @$conf->titulo}}" id="titulo" placeholder="Título" required>
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('titulo') }}</strong>
                                        </span>
                                </div>

                                <div class="form-group  col-sm-6">
                                    <label for="descripcion" class="control-label">Descripción </label>
                                        <input type="text"  name="descripcion" class="form-control  @if($errors->first('descripcion')) is-invalid  @endif"  value="{{ @$conf->descripcion}}"  id="descripcion" placeholder="Descripción" required >
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('descripcion') }}</strong>
                                        </span>
                                </div>

                                <div class="form-group @if($errors->first('keywords')) has-error @endif col-sm-6">
                                    <label for="keywords" class="control-label">Keywords  </label>
                                        <input type="text"  name="keywords" class="form-control" value="{{ @$conf->keywords}}" id="keywords" placeholder="Keywords" required>
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('keywords') }}</strong>
                                        </span>
                                </div>






                                <div class="form-group @if($errors->first('canonical')) has-error @endif col-sm-6">
                                    <label for="canonical" class="control-label">Canonical  </label>
                                        <input type="text"  name="canonical" class="form-control" value="{{ @$conf->canonical}}" id="canonical" placeholder="Canonical" required>
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('canonical') }}</strong>
                                        </span>
                                </div>

                                <div class="form-group @if($errors->first('facebookid')) has-error @endif col-sm-6">
                                    <label for="facebookid" class="control-label">Facebook ID  </label>
                                        <input type="text"  name="facebookid" class="form-control" value="{{ @$conf->facebookid}}" id="facebookid" placeholder="Facebook ID" required>
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('facebookid') }}</strong>
                                        </span>
                                </div>

                                <div class="form-group @if($errors->first('facebookadminid')) has-error @endif col-sm-6">
                                    <label for="facebookadminid" class="control-label">Facebook admin ID  </label>
                                        <input type="text"  name="facebookadminid" class="form-control" value="{{ @$conf->facebookadminid}}" id="facebookadminid" placeholder="Facebook admin ID" >
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('facebookid') }}</strong>
                                        </span>
                                </div>

                                <div class="form-group @if($errors->first('twitterid')) has-error @endif col-sm-6">
                                    <label for="twitterid" class="control-label">Twitter ID  </label>
                                        <input type="text"  name="twitterid" class="form-control" value="{{ @$user->twitterid}}" id="twitterid" placeholder="Twitter ID" >
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('twitterid') }}</strong>
                                        </span>
                                </div>

                                <div class="form-group col-sm-12">
                                    <label for="resumen">Imagen facebook</label>
                                    <figure style="width:70px;">
                                        @if(@isset($conf->imagen_facebook))
                                            <img src="/storage/{{@$conf->imagen_facebook}}" class="img-fluid" id="urlfacebook" />
                                        @else
                                            <img src="https://via.placeholder.com/150" class="img-fluid" id="urlfacebook"/>
                                        @endif
                                    </figure>
                                    <input type="hidden" value="" name="imagenfacebook" id="imagenfacebook" />
                                    <a href="#" class="btn btn-default btn-abrirpop1">Seleccionar</a>
                                </div>





                                <div class="form-group col-sm-12">
                                    <label for="resumen">Imagen twitter</label>
                                    <figure style="width:70px;">
                                        @if(@isset($conf->imagen_twitter))
                                            <img src="/storage/{{@$conf->imagen_twitter}}" class="img-fluid" id="urltwitter" />
                                        @else
                                            <img src="https://via.placeholder.com/150" class="img-fluid" id="urltwitter"/>
                                        @endif
                                    </figure>
                                    <input type="hidden" value="" name="imagentwitter" id="imagentwitter" />
                                    <a href="#" class="btn btn-default btn-abrirpop2">Seleccionar</a>
                                </div>



                            </div>

                            </div>

                            <div class="card-footer">

                                <button type="submit" class="btn btn-info pull-right">Guardar</button>
                            </div>
                        </form>




                        </div>
                    </div>

                </div>





            </div>
            <!-- /.card-body -->
          </div>

          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>






@endsection
