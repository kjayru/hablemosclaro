<div class="row">
    <div class="card col-sm-12">

        <div class="card-body">
            <div class="row">

                <div class="form-group @if($errors->first('nombre')) has-error @endif col-sm-6">
                    <label for="nombre" class="control-label">Categoria </label>
                        <input type="text"  name="nombre" class="form-control" value="{{ @$agencia->nombre }}" id="nombre" placeholder="Nombre" required>
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                </div>

            </div>
        </div>
    </div>

</div>












