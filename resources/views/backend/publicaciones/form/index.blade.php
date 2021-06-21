<div class="row">
    <div class="card col-sm-12">

        <div class="card-body pt-5 mt-4">
            <div class="row">

                <div class="form-group  col-sm-6">
                    <label for="nombre" class="control-label">Nombre </label>
                        <input type="text"  name="nombre" class="form-control  @if($errors->first('nombre')) is-invalid @endif" value="{{ @$campaign->nombre }}" id="nombrecampaign" placeholder="Nombre" required>
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                </div>


                <div class="form-group">
                    <label for="desdecampaign" class="control-label">Inicio campaña:</label>

                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                      </div>
                      <input type="text" name="desdecampana" class="form-control float-right" value="{{ Carbon\Carbon::parse(@$campaign->desdecampana)->format('d/m/Y') }}" id="desdecampana" required>
                    </div>
                    <!-- /.input group -->
                </div>

                <div class="form-group">
                    <label for="hastacampaign" class="control-label">Final campaña:</label>

                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                      </div>
                      <input type="text" name="finalcampana" class="form-control float-right" value="{{ Carbon\Carbon::parse(@$campaign->finalcampana)->format('d/m/Y') }}" id="finalcampana" required>
                    </div>
                    <!-- /.input group -->
                </div>


                <div class="form-group  col-sm-6">
                    <label for="nombre" class="control-label">Producto </label>


                        <select name="campaignterm1"  class="form-control" id="campaignterm1">
                            <option value="">Seleccionar</option>
                            @foreach($term1 as $prod)
                            <option value="{{$prod->id}} " @if(@$campaign->term_id == $prod->id) selected @endif >{{ $prod->producto}}</option>
                            @endforeach
                        </select>
                </div>

                <div class="form-group  col-sm-6">
                    <label for="nombre" class="control-label">Tipo de campaña </label>

                    <select name="campaignterm2"  class="form-control" id="campaignterm2">
                        <option value="">Seleccionar</option>
                        @foreach($term2 as $tip)
                            <option value="{{$tip->id}}" @if(@$campaign->termtipo_id == $tip->id) selected @endif>{{ $tip->tipo}}</option>
                        @endforeach
                    </select>
                </div>




            </div>
        </div>
    </div>

</div>












