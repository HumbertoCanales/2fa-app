@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center h-75">
        <div class="card">
            <div class="card-header">
                <h3>Iniciar sesión</h3>
                <div class="d-flex justify-content-end social_icon">
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                        required autocomplete="email" autofocus placeholder="Correo electrónico">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        required autocomplete="current-password" placeholder="Contraseña">
                    </div>
                    @if ($message = Session::get('error'))
                        <div class="row">
                          <div class="col-md-12">
                              <div class="alert alert-danger alert-block alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-bs-dismiss="alert">×</button>
                                  <strong>{{ $message }}</strong>
                              </div>
                          </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <input type="submit" value="Iniciar sesión" class="btn float-right login_btn">
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-center links">
                    ¿No tienes una cuenta?<a href="{{ route('register') }}">Regístrate</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
