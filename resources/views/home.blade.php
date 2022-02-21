@extends('layouts.app')

@section('content')
@if (Auth::check())
    <div class="container">
        <div class="d-flex justify-content-center h-75">
            <div class="card">
                <div class="card-header text-md-center">
                    <h4>¡Has iniciado sesión en la aplicación, bienvenido!</h4>
                    <img src="https://i.pinimg.com/originals/a0/26/1b/a0261b885cfba5a65c675c33327acf5a.png" alt="">
                </div>
            </div>
        </div>
    </div>
@else
    <script>window.location = "/login";</script>
@endif
@endsection
