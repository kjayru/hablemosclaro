@extends('layouts.backend.app')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Pregunta</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin/quizzes">Pregunta</a></li>
              <li class="breadcrumb-item active">Editar Pregunta</li>
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
            <div class="card card-primary pt-4">



              <form role="form" action="{{ route('question.update',['ques'=>$question->id]) }}" method="POST" enctype="multipart/form-data">
                <div class="card-body">

                    @csrf
                    <input type="hidden" name="_method" value="PUT">

                    <input type="hidden" name="quiz_id" value="{{$quiz_id}}">
                    @include('backend.questions.form.index')

                  </div>

                  <div class="card-footer">
                    <a href="{{ route('question.show',['ques'=>$quiz_id]) }}" class="btn btn-back">Cancelar</a>
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
