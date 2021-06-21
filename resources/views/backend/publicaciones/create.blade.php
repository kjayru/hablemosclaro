@extends('layouts.backend.app')
@section('content')


<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Nueva Campaña</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item"><a href="/admin/campaigns">Campañas</a></li>
                    <li class="breadcrumb-item active">Nueva campaña</li>
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

                          <form class="form-horizontal" action="{{ route('campaign.store') }}" method="POST" enctype="multipart/form-data">

                            <div class="card-header with-border">

                            </div>

                            <div class="card-body">
                                @csrf


                                @include('backend.campaign.form.index')


                            </div>

                            <div class="card-footer">
                                <a href="{{ route('campaign.index') }}" class="btn btn-back">Cancelar</a>
                                <button type="submit" class="btn btn-info pull-right">Guardar</button>
                            </div>
                          </form>


                        </div>
                  </div>


              </div>
          </div>
      </section>

</div>

@endsection
