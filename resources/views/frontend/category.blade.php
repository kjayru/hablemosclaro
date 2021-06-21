@extends('layouts.frontend.app')
@section('content')


<div class="container">
    <div class="row">

        @foreach($articulos as $art)

        <div class="col-md-12">
            <h1>{{ $art->titulo }}</h1>
        </div>
        <div class="col-md-12">
            {{ $art->resumen}}
        </div>

        @endforeach

    </div>
</div>

@endsection
