<div class="row  p-2">
    <div class=" col-sm-12">

        <div class="mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="form-group  col-sm-12">
                            <label for="titulo" class="control-label">Titulo </label>
                                <input type="text"  name="titulo" class="form-control  @if($errors->first('titulo')) is-invalid @endif" value="{{ @$quiz->titulo }}" id="nombrecampaign" placeholder="Título" required>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('titulo') }}</strong>
                                </span>
                        </div>

                        <div class="form-group  col-sm-12">
                            <label for="descripcion" class="control-label">Descripción </label>
                                <textarea name="descripcion" id="descripcion" class="form-control" cols="30" rows="10">{{@$quiz->descripcion}}</textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('descripcion') }}</strong>
                                </span>
                        </div>



                    </div>




                </div>
            </div>

        </div>
    </div>

</div>












