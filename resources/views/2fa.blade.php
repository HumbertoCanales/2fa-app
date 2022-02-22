@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center h-75">
        <div class="card">
            <div class="card-header">
                <h4>Verificación de dos pasos</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('2fa.post') }}">
                    @csrf

                    <p class="text-center">Te envíamos un código a tu teléfono : {{ substr(auth()->user()->phone, 0, 5) . '******' . substr(auth()->user()->phone,  -2) }}</p>

                    <div class="input-group form-group">
                        <label for="code" class="col-md-3 col-form-label text-md-right">Código</label>
                        <input id="code" type="number" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}"
                        required autocomplete="code" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                    </div>
                    @if ($message = Session::get('success'))
                            <div class="row">
                              <div class="col-md-12">
                                  <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-bs-dismiss="alert">×</button>
                                      <strong>{{ $message }}</strong>
                                  </div>
                              </div>
                            </div>
                        @endif

                    @if ($message = Session::get('error'))
                        <div class="row">
                          <div class="col-md-12">
                              <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-bs-dismiss="alert">×</button>
                                  <strong>{{ $message }}</strong>
                              </div>
                          </div>
                        </div>
                    @endif
                    <div class="form-group row mb-0">
                        <div class="col-md-12 text-md-center">
                            <a class="btn btn-link" href="{{ route('2fa.resend') }}">Volver a envíar código</a>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        <input type="submit" value="Iniciar sesión" class="btn float-right login_btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
