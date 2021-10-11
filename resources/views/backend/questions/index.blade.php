@extends('layouts.backend.app')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Preguntas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

                <li class="breadcrumb-item active">Preguntas</li>
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
                  <div class="col-md-3">
                      <a href="{{route('question.create',['quiz_id'=>$quiz_id])}}" class="btn btn-block btn-outline-primary btn-flat mb-4 mt-3">Crear Pregunta</a>
                  </div>
              </div>

              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th></th>
                    <th>Pregunta</th>
                    <th>Fecha </th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $key => $question )
                    <tr>
                        <th>{{$key + 1}}</th>
                        <td>{{ @$question->pregunta}}</td>
                        <td>{{ Carbon\Carbon::parse(@$question->date_publish)->format('d/m/Y') }}</td>

                        <td>
                            <a href="#" class="btn btn-xs btn-primary text-center btn___opciones" data-id="{{$question->id}}" data-toggle="modal" data-target="#opcionModal">Opciones</a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-xs btn-primary text-center btn___resultados" data-id="{{$question->id}}" data-toggle="modal" data-target="#respuestaModal">Registrar respuesta</a>
                        </td>

                        <td width="7%" style="text-center">
                            <a href="{{ route('question.edit',['ques'=>$question->id,'quiz_id'=>$quiz_id])}}" class="btn-xs btn btn-outline-info "><i class="far fa-edit"></i></a>
                            <a href="#" data-id="{{$question->id}}" data-toggle="modal" data-target="#delobjeto" class="btn btn-xs btn-dangers btn-object-delete"><i class="far fa-trash-alt"></i></a>

                        </td>
                    </tr>
                    @endforeach



                </tbody>

              </table>



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


  <div class="modal fade" id="delobjeto">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">

            <form class="delete-objeto" action="/admin/questions/delete" method="POST">
                @csrf

                <div class="modal-header">
                    <h4 class="modal-title">Confirmar Eliminación</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">

                    <input type="hidden" name="_method" value="delete" >
                    <input type="hidden" name="quiz_id" value="{{$quiz_id}}">
                    <input type="hidden" name="id" id="id">
                    <p>¿Esta seguro de eliminar este item?</p>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-light">Eliminar</button>
                </div>
            </form>

        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

</div>



<!-- Modal opciones-->
<div class="modal fade" id="opcionModal" tabindex="-1" role="dialog" aria-labelledby="opcionModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title" id="opcionModalLabel">Opciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
          <div class="card">
              <div class="card-body">

                  <div class="row">
                       <div class="col-md-12 text-center">
                            <p class="mensaje__text"></p>
                        </div>
                  <div class="col-md-12">
                      <h4>Opciones registradas</h4>
                      <table id="tbopciones" class="table">
                          <thead>
                          <th>#</th>
                          <th>Opción</th>
                          <th></th>
                          </thead>
                          <tbody class="tbopciones">

                          </tbody>
                      </table>
                  </div>
              </div>
              </div>
          </div>
          <div class="card">
             <div class="card-body">
                  <legend>Registrar opción</legend>
                    <form id="fr-option">
                        <input type="hidden" name="question_id" id="questionoption" value="">
                        <div class="row justify-content-between">
                            <div class="form-group col-md-10">
                                <label for="opcion">Opción</label>
                                <input type="text" class="form-control" name="opcion" id="inputoption">
                            </div>
                            <div class="form-group col-md-2 text-right">
                                <a href="#" class="btn btn-xs btn-danger btn__saveoption">Guardar</a>
                            </div>
                        </div>
                    </form>
             </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

      </div>
    </div>
  </div>
</div>


<!-- Modal respuesta-->
<div class="modal fade" id="respuestaModal" tabindex="-1" role="dialog" aria-labelledby="respuestaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="respuestaModalLabel">Registro de respuesta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <input type="hidden" name="quiz_id" id="quizid" value="{{$quiz_id}}">
            <input type="hidden" name="question_id" id="resquestion" value="">
            <input type="hidden" name="option_id" id="resoption" value="">

            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12 text-center">
                                <p class="mensaje__text"></p>
                            </div>
                    <div class="col-md-12">
                            <div class="list-group list__opcion">

                            </div>
                        </div>
                    </div>

                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary " data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger btn__registrar_opcion">Registrar respuesta</button>
      </div>
    </div>
  </div>
</div>

<!-- modal edit option -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar opción</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <legend>Registrar opción</legend>
            <form id="fr-option">
                <input type="hidden" name="question_id" id="questionoptionedit" value="">
                <input type="hidden" name="option_id" id="option_edit_id">
                <div class="row justify-content-between">
                    <div class="form-group col-md-10">
                        <label for="opcion">Opción</label>
                        <input type="text" class="form-control" name="opcion" id="inputoptionedit">
                    </div>

                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger btn__actualizar_option">Actualizar</button>
      </div>
    </div>
  </div>
</div>

@endsection
