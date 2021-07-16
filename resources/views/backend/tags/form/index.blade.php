
    <div class="form-group @if($errors->first('nombre')) has-error @endif">
          <label for="nombre" class="control-label">Tag</label>
              <input type="text"  name="nombre" class="form-control" value="{{ @$tag->nombre}}" id="nombre" placeholder="Nombre" required>
              <span class="help-block">{{ $errors->first('nombre') }}</span>
    </div>






