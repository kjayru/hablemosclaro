 @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
<div class="row  p-2">
    <div class=" col-sm-12">

        <div class="mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="form-group  col-sm-12">
                            <label for="titulo" class="control-label">Título </label>
                                <input type="text"  name="titulo" class="form-control  @if($errors->first('titulo')) is-invalid @endif" value="{{ old('titulo') }}" id="nombrecampaign" placeholder="Título" required>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('titulo') }}</strong>
                                </span>
                        </div>

                        <div class="form-group  col-sm-12">
                            <label for="contenido" class="control-label">Contenido </label>
                                <textarea name="contenido" id="contenido" class="form-control" cols="30" rows="10">{!! old('contenido') !!}</textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('contenido') }}</strong>
                                </span>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="resumen">Imagen banner</label>
                            <figure style="width:70px;">
                                @if(old('imageBanner'))
                                    <img src="/storage/{{old('imageBanner')}}"  class="img-fluid" id="urlbanner"/>
                                @else
                                 <img src="https://via.placeholder.com/150"  class="img-fluid" id="urlbanner"/>
                                @endif
                            </figure>
                            <input type="hidden" value="{{old('imageBanner')}}" name="imageBanner" id="imageBanner" />
                            <a href="#" class="btn btn-default btn-abrirpopup">Seleccionar</a>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="resumen">Imagen banner tablet</label>
                            <figure style="width:70px;">
                                @if(old('imageTablet'))
                                    <img src="/storage/{{old('imageTablet')}}"  class="img-fluid" id="urltablet"/>
                                @else
                                    <img src="https://via.placeholder.com/150" class="img-fluid" id="urltablet" />
                                @endif
                            </figure>
                            <input type="hidden" value="{{old('imageTablet')}}" name="imageTablet" id="imageTablet" />
                            <a href="#" class="btn btn-default btn-abrirpopup2">Seleccionar</a>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="resumen">Imagen banner movil</label>
                            <figure style="width:70px;">
                                @if(old('imageMovil'))
                                    <img src="/storage/{{old('imageMovil')}}"  class="img-fluid" id="urlmovil"/>
                                @else
                                    <img src="https://via.placeholder.com/150" class="img-fluid" id="urlmovil"/>
                                @endif
                            </figure>
                            <input type="hidden" value="{{old('imageMovil')}}" name="imageMovil" id="imageMovil" />
                            <a href="#" class="btn btn-default btn-abrirpopup3">Seleccionar</a>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="resumen">Imagen Card</label>
                            <figure style="width:70px;">
                               @if(old('imageCard'))
                                    <img src="/storage/{{old('imageCard')}}"  class="img-fluid" id="urlcard"/>
                                @else
                                    <img src="https://via.placeholder.com/150" class="img-fluid" id="urlcard" />
                                @endif
                            </figure>
                            <input type="hidden" value="{{old('imageCard')}}" name="imageCard" id="imageCard" />
                            <a href="#" class="btn btn-default btn-abrirpopup4">Seleccionar</a>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-check pt-5 pb-5">

                            <input class="form-check-input" type="checkbox" name="destacado" value="1" id="destacado" {{ old('destacado') == '1' ? 'checked' : '' }}  >
                            <label class="form-check-label" for="destacado">
                                Destacado
                            </label>
                        </div>

                        <div class="form-check  pt-5 pl-5">

                            <input class="form-check-input" type="checkbox" name="estado" value="1" id="estado" {{ old('estado') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="estado">
                                Activado
                            </label>
                        </div>
                    </div>

                    <div class="row">


                        <div class="form-group col-sm-6">
                            <label for="titulo">Tipo de Articulo</label>
                            <select name="tipo_id" id="tipo" class="custom-select" required>
                                <option>Seleccione</option>
                                <option value="1" {{ old('tipo_id') == 1 ? "selected" : "" }} >Nota</option>
                                <option value="2" {{ old('tipo_id') == 2 ? "selected" : "" }}>Video</option>
                                <option value="3" {{ old('tipo_id') == 3 ? "selected" : "" }}>Columna</option>
                                <option value="4" {{ old('tipo_id') == 4 ? "selected" : "" }}>Slider</option>
                                <option value="5" {{ old('tipo_id') == 5 ? "selected" : "" }}>Entrevista</option>
                            </select>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fechapublicacion">Fecha de publicación</label>
                                <input type="date" name="fechapublicacion" id="fechapublicacion" value="{{ old('fechapublicacion')}}" class="form-control">
                            </div>
                        </div>

                    </div>

                    <div class="row row__video"  style="display: {{ old('tipo_id') == 2 ? "block" : "" }};" >
                        <div class="form-group col-sm-6">
                            <label for="video">Codigo Embed video</label>
                            <input type="text" name="video" id="video" class="form-control" value="{{ old('video')}}" placeholder="Codigo Embed video">
                        </div>
                    </div>

                    <div class="row row__author" style="display: {{ old('tipo_id') == 3 ? "block" : "" }};">
                        <div class="form-group col-sm-6">
                            <label for="author">Autor</label>
                            <select name="author" id="author" class="custom-select">
                                <option value="">Seleccione</option>
                                @foreach($authors as $autor)
                                <option value="{{$autor->id}}"  {{ old('author') == $autor->id ? "selected" : "" }} >{{$autor->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">



                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tags</label>

                                <select class="select2" multiple="multiple" name="tags[]" data-placeholder="Seleciones tags" style="width: 100%;">
                                    @foreach($tags as $tag)
                                        @if(old("tags"))
                                         <option value="{{$tag->id}}" @if(in_array($tag->id,old("tags"))) selected @endif >{{ $tag->nombre }} </option>
                                         @else
                                          <option value="{{$tag->id}}"  >{{ $tag->nombre }} </option>
                                        @endif
                                    @endforeach
                                </select>
                              </div>
                        </div>
                    </div>

                    <div class="form-group col-sm-6">

                        <label>Categoría</label>

                            {{-- @foreach($categories->sortBy('id') as $key => $cat)


                                    <div class="form-check">
                                        @if(old('category'))

                                        <input class="form-check-input position-static" name="category[]" type="checkbox" id="maestro${{$key+1}}" value="{{$cat->id}}" @if(in_array($cat->id,old('category'))) checked @endif>
                                        @else
                                        <input class="form-check-input position-static" name="category[]" type="checkbox" id="maestro${{$key+1}}" value="{{$cat->id}}" >
                                        @endif
                                        <label class="form-check-label" for="maestro${{$key+1}}">
                                        {{$cat->nombre}}
                                        </label>
                                    </div>


                            @endforeach --}}
                            <select name="category" id="category" class="custom-select">
                                <option value="">Seleccione</option>
                                @foreach($categories->sortBy('id') as $key => $cat)
                                @if(old('category'))
                                <option value="{{$cat->id}}"  @if(in_array($cat->id,old('category'))) selected @endif>{{$cat->nombre}}</option>
                                @else
                                <option value="{{$cat->id}}" >{{$cat->nombre}}</option>
                                @endif
                                @endforeach
                            </select>
                    </div>


                     <div class="form-group col-sm-6">
                        <div class="form-group">
                            <label>Quiz</label>

                            <select class="custom-select"  name="quiz" id="quiz">
                                <option value="">Seleccionar</option>
                                @foreach($quizes as $quiz)
                                @if(old('quiz'))
                                <option value="{{$quiz->id}}" @if($quiz->id == old('quiz')) selected @endif >{{ $quiz->titulo }} </option>
                                @else
                                <option value="{{$quiz->id}}" >{{ $quiz->titulo }} </option>
                                @endif
                                @endforeach
                            </select>
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
                            <input type="text" class="form-control" name="seotitle" id="seotitle" value="{{old('seotitle') }}" placeholder="Titulo Meta" required>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="seodescripcion">Descripción Meta</label>
                            <input type="text" class="form-control" name="seodescripcion" id="seodescripcion" value="{{old('seodescripcion') }}" placeholder="Descripción Meta" required>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="keywords">Keywords</label>
                            <input type="text" class="form-control" name="keywords" id="keywords" value="{{old('keywords') }}" placeholder="Keywords">
                        </div>



                        <div class="form-group col-sm-12">
                            <label for="resumen">Imagen meta</label>
                            <figure style="width:70px;">
                                @if(old('imageMeta'))
                                    <img src="/storage/{{old('imageMeta')}}"  class="img-fluid" id="urlmeta"/>
                                @else
                                    <img src="https://via.placeholder.com/150" class="img-fluid" id="urlmeta" />
                                @endif
                            </figure>
                            <input type="hidden" value="{{old('imageMeta')}}" name="imageMeta" id="imageMeta" />
                            <a href="#" class="btn btn-default btn-abrirpopup5">Seleccionar</a>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>

</div>












