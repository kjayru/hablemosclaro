
    <div class="row">
        <div class="form-group col-md-2">
            <a href="#" class="btn btn-default btn-abrirpopup">Seleccione imagen</a>

        </div>
        <div class="form-group col-md-6">

            <input type="text" id="imageBanner" class="form-control"  name="imagen">
            <picture class="figure category__figure">
                <img src="/storage/{{ @$category->imagen}}" alt="" id="urlbanner" class="img-thumbnail rounded">
            </picture>
        </div>
    </div>
    <div class="form-group @if($errors->first('nombre')) has-error @endif">
          <label for="nombre" class="control-label">Nombre</label>
              <input type="text"  name="nombre" class="form-control" value="{{ @$category->nombre}}" id="nombre" placeholder="Nombre" required>
              <span class="help-block">{{ $errors->first('nombre') }}</span>
    </div>


    <div class="form-group @if($errors->first('parent_id')) has-error @endif">
        <label for="parent_id" class="control-label">Relacionado</label>
      <select class="form-control" name="parent_id" id="parent_id">
            <option value="">Seleccione</option>
            @foreach($categories->sortBy('nombre') as $cat)
                    <option value="{{$cat->id}}"  {{@$category->parent_id==$cat->id ? 'selected' : '' }}> {{$cat->nombre}} </option>
            @endforeach
      </select>
      <span class="help-block">{{ $errors->first('parent_id') }}</span>
    </div>


     <div class="card">
                <div class="card-body">
                    <div class="row">
                        <legend>Metas</legend>

                        <div class="form-group col-sm-12">
                            <label for="seotitle">Titulo Meta</label>
                            <input type="text" class="form-control" name="seotitle" id="seotitle" value="{{@$category->meta_titulo }}" placeholder="Titulo Meta" required>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="seodescripcion">Descripción Meta</label>
                            <input type="text" class="form-control" name="seodescripcion" id="seodescripcion" value="{{@$category->meta_description }}" placeholder="Descripción Meta" required>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="keywords">Keywords</label>
                            <input type="text" class="form-control" name="keywords" id="keywords" value="{{@$category->meta_keywords }}" placeholder="Keywords">
                        </div>



                        <div class="form-group col-sm-12">
                            <label for="resumen">Imagen meta</label>
                            <figure style="width:70px;">
                                @if(@isset($category->meta_image))
                                    <img src="/storage/{{@$category->meta_image}}" class="img-fluid" id="urlmeta" />
                                @else
                                    <img src="https://via.placeholder.com/150" class="img-fluid" id="urlmeta" />
                                @endif
                            </figure>
                            <input type="hidden" value="" name="imageMeta" id="imageMeta" />
                            <a href="#" class="btn btn-default btn-abrirpopup5">Seleccionar</a>
                        </div>



                    </div>
                </div>
            </div>


