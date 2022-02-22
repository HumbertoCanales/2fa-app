@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center h-75">
        <div class="card">
            <div class="card-header">
                <h3>Registrarse</h3>
                <div class="d-flex justify-content-end social_icon">
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register.post') }}">
                    @csrf
                    <div class="input-group form-group">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                        required autocomplete="name" autofocus placeholder="Nombre">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="input-group form-group">
                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"
                        required autocomplete="phone" autofocus placeholder="Celular (con extensión)">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="input-group form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                        required autocomplete="email" autofocus placeholder="Correo electrónico">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                    </div>
                    <div class="input-group form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        required autocomplete="new-password" placeholder="Contraseña">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="input-group form-group">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password" placeholder="Repetir contraseña">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Registrarse" class="btn float-right login_btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
