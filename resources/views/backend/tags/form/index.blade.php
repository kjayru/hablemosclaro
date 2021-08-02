
    <div class="form-group">
          <label for="nombre" class="control-label">Tag</label>
              <input type="text"  name="nombre" class="form-control @if($errors->first('nombre')) is-invalid @endif" value="{{ @$tag->nombre}}" id="nombre" placeholder="Nombre" required>
              <span class="help-block invalid-feedback error">{{ $errors->first('nombre') }}</span>
    </div>






