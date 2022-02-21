@extends('layouts.app')

@section('content')
@if (Auth::check())
    <script>window.location = "/home";</script>
@else
<div class="container">
    <div class="d-flex justify-content-center h-75">
        <div class="card">
            <div class="card-header">
                <h3>Iniciar sesión</h3>
                <div class="d-flex justify-content-end social_icon">
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
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
                    <div class="row align-items-center remember">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>Recuérdame
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Iniciar sesión" class="btn float-right login_btn">
                    </div>
                </form>
                <br>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        ¿No tienes una cuenta?<a href="{{ route('register') }}">Regístrate</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
