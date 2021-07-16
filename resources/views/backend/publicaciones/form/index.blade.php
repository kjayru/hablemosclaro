<div class="row  p-2">
    <div class=" col-sm-12">

        <div class="mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="form-group  col-sm-12">
                            <label for="titulo" class="control-label">Título </label>
                                <input type="text"  name="titulo" class="form-control  @if($errors->first('titulo')) is-invalid @endif" value="{{ @$articulo->titulo }}" id="nombrecampaign" placeholder="Título" required>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('titulo') }}</strong>
                                </span>
                        </div>

                        <div class="form-group  col-sm-12">
                            <label for="contenido" class="control-label">Contenido </label>
                                <textarea name="contenido" id="contenido" class="form-control" cols="30" rows="10">{!!@$articulo->contenido!!}</textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('contenido') }}</strong>
                                </span>
                        </div>





                        <div class="form-group col-sm-12">
                            <label for="resumen">Imagen banner</label>
                            <figure style="width:70px;">

                                @if(@$articulo->banner)
                                    <img src="/storage/{{@$articulo->banner}}" class="img-fluid" id="urlbanner" />
                               @else
                                    <img src="https://via.placeholder.com/150"  class="img-fluid" id="urlbanner"/>
                               @endif

                            </figure>
                            <input type="hidden" value="imagen" name="imageBanner" id="imageBanner" />
                            <a href="#" class="btn btn-default btn-abrirpopup">Seleccionar</a>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="resumen">Imagen banner tablet</label>
                            <figure style="width:70px;">
                                @if(@isset($articulo->tablet))

                                    <img src="/storage/{{@$articulo->tablet}}" class="img-fluid" id="urltablet" />
                                @else
                                    <img src="https://via.placeholder.com/150" class="img-fluid" id="urltablet" />
                                @endif
                            </figure>
                            <input type="hidden" value="" name="imageTablet" id="imageTablet" />
                            <a href="#" class="btn btn-default btn-abrirpopup2">Seleccionar</a>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="resumen">Imagen banner movil</label>
                            <figure style="width:70px;">
                                @if(@isset($articulo->movil))
                                    <img src="/storage/{{@$articulo->movil}}" class="img-fluid" id="urlmovil" />
                                @else
                                    <img src="https://via.placeholder.com/150" class="img-fluid" id="urlmovil"/>
                                @endif
                            </figure>
                            <input type="hidden" value="" name="imageMovil" id="imageMovil" />
                            <a href="#" class="btn btn-default btn-abrirpopup3">Seleccionar</a>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="resumen">Imagen Card</label>
                            <figure style="width:70px;">
                                @if(@isset($articulo->imagenbox))
                                    <img src="/storage/{{@$articulo->imagenbox}}" class="img-fluid" id="urlcard" />
                                @else
                                    <img src="https://via.placeholder.com/150" class="img-fluid" id="urlcard" />
                                @endif
                            </figure>
                            <input type="hidden" value="" name="imageCard" id="imageCard" />
                            <a href="#" class="btn btn-default btn-abrirpopup4">Seleccionar</a>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-check pt-5 pb-5">

                            <input class="form-check-input" type="checkbox" name="destacado" value="1" id="destacado" @if(@$articulo->destacado == 1) checked @endif>
                            <label class="form-check-label" for="destacado">
                                Destacado
                            </label>
                        </div>

                        <div class="form-check  pt-5 pl-5">

                            <input class="form-check-input" type="checkbox" name="estado" value="1" id="estado" @if(@$articulo->estado == 1) checked @endif>
                            <label class="form-check-label" for="estado">
                                Activado
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="titulo">Categoria</label>
                            <select name="categoria_blog_id" id="categoria" class="custom-select" required>
                                <option value="">Seleccione</option>
                                @foreach($categories->sortBy('id') as $cat)

                                    @if(isset($cat->parent))
                                        <option value="{{$cat->id}}" @if(@$articulo->category_id == $cat->id) selected @endif>{{$cat->parent->nombre}} -- {{$cat->nombre}} </option>
                                    @else
                                        <option value="{{$cat->id}}" @if(@$articulo->category_id == $cat->id) selected @endif>{{$cat->nombre}}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="titulo">Tipo de Articulo</label>
                            <select name="tipo_id" id="tipo" class="custom-select" required>
                                <option>Seleccione</option>
                                <option value="1" @if(@$articulo->post_type_id == 1) selected @endif>Nota</option>
                                <option value="2" @if(@$articulo->post_type_id == 2) selected @endif>Video</option>
                                <option value="3" @if(@$articulo->post_type_id == 3) selected @endif>Columna</option>
                                <option value="3" @if(@$articulo->post_type_id == 4) selected @endif>Slider</option>
                            </select>
                        </div>

                    </div>

                    <div class="row row__video">
                        <div class="form-group col-sm-6">
                            <label for="video">Codigo Embed video</label>
                            <input type="text" name="video" id="video" class="form-control" value="{{@$articulo->video}}" placeholder="Codigo Embed video">
                        </div>
                    </div>

                    <div class="row row__author">
                        <div class="form-group col-sm-6">
                            <label for="author">Autor</label>
                            <select name="author" id="author" class="custom-select">
                                <option value="">Seleccione</option>
                                @foreach($authors as $autor)
                                <option value="{{$autor->id}}"  @if(@$articulo->author[0]->id == $autor->id) selected @endif>{{$autor->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fechapublicacion">Fecha de publicación</label>
                                <input type="date" name="fechapublicacion" id="fechapublicacion" value="{{@$articulo->date_publish}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tags</label>
                                <select class="select2" multiple="multiple" name="tags[]" data-placeholder="Seleciones tags" style="width: 100%;">
                                    @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">{{ $tag->nombre }} </option>
                                    @endforeach
                                </select>
                              </div>
                        </div>
                    </div>





                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <legend>Metas</legend>

                        <div class="form-group col-sm-12">
                            <label for="seotitle">Titulo Meta</label>
                            <input type="text" class="form-control" name="seotitle" id="seotitle" value="{{@$articulo->meta_titulo }}" placeholder="Titulo Meta" required>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="seodescripcion">Descripción Meta</label>
                            <input type="text" class="form-control" name="seodescripcion" id="seodescripcion" value="{{@$articulo->meta_description }}" placeholder="Descripción Meta" required>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="keywords">Keywords</label>
                            <input type="text" class="form-control" name="keywords" id="keywords" value="{{@$articulo->meta_keywords }}" placeholder="Keywords">
                        </div>



                        <div class="form-group col-sm-12">
                            <label for="resumen">Imagen meta</label>
                            <figure style="width:70px;">
                                @if(@isset($articulo->meta_image))
                                    <img src="/storage/{{@$articulo->meta_image}}" class="img-fluid" id="urlmeta" />
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
        </div>
    </div>

</div>












