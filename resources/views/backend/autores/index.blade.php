@extends('layouts.backend.app')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Autores</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

                <li class="breadcrumb-item active">Autores</li>
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
                      <a href="/admin/authors/create" class="btn btn-block btn-outline-primary btn-flat mb-4 mt-2">Crear Autor</a>
                  </div>
              </div>

              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th></th>
                    <th>Nombres</th>
                    <!--<th>Titulo</th>-->
                    <th>Cargo</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($autores as $key=>$autor)
                    <tr>
                        <th>{{ $key+1}}</th>
                        <td>{{ @$autor->nombre}}</td>
                        <!--<td>{{ @$autor->titulo }}</td>-->
                        <td>{{ @$autor->cargo }}</td>

                        <td width="7%" style="text-center">
                            <a href="/admin/authors/{{$autor->id}}/edit" class="btn-xs btn btn-outline-info "><i class="far fa-edit"></i></a>
                            <a href="#" data-id="{{$autor->id}}" data-toggle="modal" data-target="#delobjeto" class="btn btn-xs btn-dangers btn-object-delete"><i class="far fa-trash-alt"></i></a>

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

            <form class="delete-objeto" action="/admin/authors/delete" method="POST">
                @csrf

                <div class="modal-header">
                    <h4 class="modal-title">Confirmar Eliminación</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">

                    <input type="hidden" name="_method" value="delete" >

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



@endsection
