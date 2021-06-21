<div class="row">
    <div class="card col-sm-12">

        <div class="card-body">
            <div class="row">

                <div class="form-group @if($errors->first('name')) has-error @endif col-sm-6">
                    <label for="name" class="control-label">Nombres  </label>
                        <input type="text"  name="name" class="form-control" value="{{ @$user->name}}" id="name" placeholder="Nombres" required>
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                </div>

                <div class="form-group @if($errors->first('lastname')) has-error @endif col-sm-6">
                    <label for="lastname" class="control-label"> Apellidos </label>
                        <input type="text"  name="lastname" class="form-control" value="{{ @$user->lastname}}" id="lastname" placeholder="Apellidos " required>
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>
                </div>

                <div class="form-group  col-sm-6">
                    <label for="email" class="control-label">Email </label>
                        <input type="text"  name="email" class="form-control usuario__email @if($errors->first('email')) is-invalid  @endif"  value="{{ @$user->email}}"  id="email" placeholder="Email" required >
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                </div>

                @if($rol =="administrador")

                <div class="form-group @if($errors->first('agencia')) has-error @endif col-sm-8">
                    <label for="agencia" class="control-label">Empresa</label>

                    <select name="agencia"  class="form-control" id="agencia" >
                        <option value="">Seleccione</option>
                        @foreach($agencias as $agen)
                        <option value="{{ $agen->id }}" @if($agen->id== $user->agency_id)  selected @endif>{{ $agen->nombre }}</option>
                        @endforeach
                    </select>

                </div>
                @else
                        <input type="hidden" name="agencia" value="{{ $usuario->agency->nombre}}" >
                        <input type="hidden" name="agencia" value="{{ $usuario->agency->id}}" id="getunidadadmin" >
                @endif


                <div class="form-group @if($errors->first('unidadnegocio')) has-error @endif   col-sm-8" >
                    <label for="unidadnegocio" class="control-label">Unidad de negocio</label>

                    <select name="unidadnegocio"  class="form-control @if($rol !="administrador") getunidades @endif" id="unidadnegocio"  data-id="{{@$user->unit->id}}" >
                        <option value="">Seleccione</option>
                        @if(@$user->unit_id)
                        <option value="{{@$user->unit->id}}" selected>{{@$user->unit->nombre}}</option>
                        @endif
                    </select>

                </div>

                <div class="form-group  col-sm-6">
                    <label for="password" class="control-label">Cambiar clave</label>
                        <input id="password" type="password" class="form-control" name="password"  autocomplete="new-password">
                </div>

            </div>
        </div>
    </div>

</div>












