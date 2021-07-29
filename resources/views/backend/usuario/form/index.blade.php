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





                <div class="form-group  col-sm-6">
                    <label for="email" class="control-label">Email </label>
                        <input type="text"  name="email" class="form-control usuario__email @if($errors->first('email')) is-invalid  @endif"  value="{{ @$user->email}}"  id="email" placeholder="Email" required>
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
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












