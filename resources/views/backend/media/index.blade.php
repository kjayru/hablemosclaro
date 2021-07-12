@extends('layouts.backend.app')

@section('content')

<div class="content-wrapper">


    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Archivos multimedia</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item active">Archivos</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->

            <div class="row">
                <div class="col-md-12">
                        <div class="box">

                                <div class="box-body">
                                    <div class="post">
                                            <div class="row margin-bottom">
                                                <!-- /.col -->
                                                <div class="col-sm-12">

                                                    <div class="file-editor" id="file-editor"></div>

                                                <!-- /.row -->
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                    </div>
                                </div>
                        <!-- /.box-body -->
                        </div>
                <!-- /.box -->
                </div>
            </div>

        </div>
    </section>

</div>


@endsection
