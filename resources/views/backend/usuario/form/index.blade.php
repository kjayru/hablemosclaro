<div class="row">
    <div class="card col-sm-12">

        <div class="card-body">
            <div class="row">

                <div class="form-group  col-sm-6">
                    <label for="name" class="control-label">Nombres  </label>
                        <input type="text"  name="name" class="form-control  @if($errors->first('name')) is-invalid @endif" value="{{ @$user->name}}" id="name" placeholder="Nombres" required>
                        <span class="error invalid-feedback" role="alert">
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
                        <input type="text"  name="email" class="form-control usuario__email @if($errors->first('email')) is-invalid  @endif"  value="{{ @$user->email}}"  id="email" placeholder="Email" required>
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                </div>


                @if($rol =="administrador")
                <div class="form-group  col-sm-8" required>
                    <label for="agencia" class="control-label">Empresa</label>

                    <select name="agencia"  class="form-control @if($errors->first('agencia')) has-error is-invalid @endif" id="agencia" >
                        <option value="">Seleccione</option>
                        @foreach($agencias as $agen)
                        <option value="{{ $agen->id }}">{{ $agen->nombre }}</option>
                        @endforeach
                    </select>

                    @error('agencia')
                    <span class="error invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                @else
                        <input type="hidden" name="agencia" value="{{ $usuario->agency->nombre}}" >
                        <input type="hidden" name="agencia" value="{{ $usuario->agency->id}}" id="getunidadadmin" >
                @endif


                <div class="form-group  col-sm-8" required>
                    <label for="unidadnegocio" class="control-label">Unidad de negocio</label>

                    <select name="unidadnegocio"  class="form-control @if($errors->first('unidadnegocio')) has-error  is-invalid @endif @if($rol !="administrador") getunidades @endif" id="unidadnegocio" >
                        <option value="">Seleccione</option>

                    </select>

                    @error('unidadnegocio')
                    <span class="error invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


                <div class="form-group  col-sm-6">
                    <label for="password" class="control-label">Clave</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback " role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                </div>

                <div class="form-group col-sm-6">
                    <label for="password-confirm" class="control-label">Repita su clave</label>

                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">

                </div>



            </div>
        </div>
    </div>

</div>












