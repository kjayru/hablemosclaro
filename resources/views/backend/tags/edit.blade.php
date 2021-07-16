@extends('layouts.backend.app')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar tag</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin/tags">Tags</a></li>
              <li class="breadcrumb-item active">Editar tag</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">


          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">



              <form role="form" action="{{ route('tag.update',$tag->id) }}" method="POST" enctype="multipart/form-data">
                <div class="card-body">

                    @csrf
                    <input type="hidden" name="_method" value="PUT">


                    @include('backend.tags.form.index')

                  </div>

                  <div class="card-footer">
                    <a href="{{ route('tag.index') }}" class="btn btn-back">Cancelar</a>
                    <button type="submit" class="btn btn-info pull-right">Guardar</button>

                  </div>
              </form>


            </div>
        </div>


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>







@endsection
