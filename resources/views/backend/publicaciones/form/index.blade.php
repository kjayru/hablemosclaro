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
                                <textarea name="contenido" id="contenido" class="form-control" cols="30" rows="10"></textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('contenido') }}</strong>
                                </span>
                        </div>





                        <div class="form-group col-sm-12">
                            <label for="resumen">Imagen banner</label>
                            <figure style="width:70px;">
                                @if(@isset($articulo->banner))
                                    <img src="hosturl@ViewBag.imagen" class="img-fluid" id="urlbanner" />
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
                                <!--

                                    <img src="@ViewBag.hosturl@ViewBag.imagen_t" class="img-fluid" id="urltablet" />

                                    <img src="https://via.placeholder.com/150" class="img-fluid" id="urltablet" />
                                -->
                            </figure>
                            <input type="hidden" value="" name="imageTablet" id="imageTablet" />
                            <a href="#" class="btn btn-default btn-abrirpopup5">Seleccionar</a>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="resumen">Imagen banner movil</label>
                            <figure style="width:70px;">
                            <!--

                                    <img src="hosturl@ViewBag.imagen_m" class="img-fluid" id="urlmovil" />

                                    <img src="https://via.placeholder.com/150" class="img-fluid" id="urlmovil"/>
                                -->
                            </figure>
                            <input type="hidden" value="" name="imageMovil" id="imageMovil" />
                            <a href="#" class="btn btn-default btn-abrirpopup2">Seleccionar</a>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="resumen">Imagen Card</label>
                            <figure style="width:70px;">
                            <!--

                                    <img src="hosturl@ViewBag.card" class="img-fluid" id="urlcard" />
                                <img src="https://via.placeholder.com/150" class="img-fluid" id="urlcard" />
                                -->
                            </figure>
                            <input type="hidden" value="" name="imageCard" id="imageCard" />
                            <a href="#" class="btn btn-default btn-abrirpopup3">Seleccionar</a>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-check pt-5 pb-5">

                            <input class="form-check-input" type="checkbox" name="destacado" value="1" id="destacado">
                            <label class="form-check-label" for="destacado">
                                Destacado
                            </label>
                        </div>

                        <div class="form-check  pt-5 pl-5">

                            <input class="form-check-input" type="checkbox" name="estado" value="1" id="estado" >
                            <label class="form-check-label" for="estado">
                                Activado
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="titulo">Categoria</label>
                            <select name="categoria_blog_id" id="categoria" class="custom-select" required>
                                <option selected>Seleccione</option>

                            </select>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="titulo">Tipo de Articulo</label>
                            <select name="tipo_id" id="tipo" class="custom-select" required>
                                <option>Seleccione</option>
                                <option value="1" >Nota</option>
                                <option value="2" >Video</option>
                                <option value="3" >Columna</option>
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
                            <input type="text" class="form-control" name="seotitle" id="seotitle" value="" placeholder="Titulo Meta" required>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="seodescripcion">Descripción Meta</label>
                            <input type="text" class="form-control" name="seodescripcion" id="seodescripcion" value="" placeholder="Descripción Meta" required>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="keywords">Keywords</label>
                            <input type="text" class="form-control" name="keywords" id="keywords" value="" placeholder="Keywords">
                        </div>



                        <div class="form-group col-sm-12">
                            <label for="resumen">Imagen meta</label>
                            <figure style="width:70px;">
                                <!-- (ViewBag.seoimagen!=null)

                                    <img src="hosturl@ViewBag.seoimagen" class="img-fluid" id="urlmeta" />

                                    <img src="https://via.placeholder.com/150" class="img-fluid" id="urlmeta" />
                                -->
                            </figure>
                            <input type="hidden" value="" name="imageMeta" id="imageMeta" />
                            <a href="#" class="btn btn-default btn-abrirpopup4">Seleccionar</a>
                        </div>

                        <input type="hidden" name="id" value="" />




                    </div>
                </div>
            </div>
        </div>
    </div>

</div>












