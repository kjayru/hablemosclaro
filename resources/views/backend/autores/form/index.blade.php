
    <div class="row">
        <div class="form-group col-md-2">
            <a href="#" class="btn btn-default btn-abrirautor">Seleccione imagen</a>

        </div>
        <div class="form-group col-md-6">

            <input type="text" id="imageAutor" class="form-control"  name="imageautor">
            <picture class="figure category__figure">
                <img src="/storage/{{ @$autor->imagen}}" alt="" id="urlautor" class="img-thumbnail rounded">
            </picture>
        </div>
    </div>
    <div class="form-group @if($errors->first('nombre')) has-error @endif">
          <label for="nombre" class="control-label">Nombre</label>
              <input type="text"  name="nombre" class="form-control" value="{{ @$autor->nombre}}" id="nombre" placeholder="Nombre" required>
              <span class="help-block">{{ $errors->first('nombre') }}</span>
    </div>

    <div class="form-group @if($errors->first('titulo')) has-error @endif">
        <label for="titulo" class="control-label">Titulo</label>
            <input type="text"  name="titulo" class="form-control" value="{{ @$autor->titulo}}" id="titulo" placeholder="Titulo" required>
            <span class="help-block">{{ $errors->first('titulo') }}</span>
  </div>

  <div class="form-group @if($errors->first('cargo')) has-error @endif">
    <label for="cargo" class="control-label">Cargo</label>
        <input type="text"  name="cargo" class="form-control" value="{{ @$autor->cargo}}" id="cargo" placeholder="Cargo" required>
        <span class="help-block">{{ $errors->first('cargo') }}</span>
</div>






