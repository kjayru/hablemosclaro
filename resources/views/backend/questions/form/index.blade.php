<div class="row  p-2">
    <div class=" col-sm-12">

        <div class="mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="form-group  col-sm-12">
                            <label for="titulo" class="control-label">Pregunta </label>
                                <input type="text"  name="pregunta" class="form-control  @if($errors->first('pregunta')) is-invalid @endif" value="{{ @$question->pregunta }}" id="nombrecampaign" placeholder="Pregunta" required>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pregunta') }}</strong>
                                </span>
                        </div>





                    </div>




                </div>
            </div>

        </div>
    </div>

</div>












