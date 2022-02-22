@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center h-75">
        <div class="card">
            <div class="card-header text-md-left">
                <h4>¡Bienvenido, {{ Auth::user()->name }}, has iniciado sesión en la aplicación!</h4>
                <img src="https://i.pinimg.com/originals/a0/26/1b/a0261b885cfba5a65c675c33327acf5a.png" alt="">
            </div>
        </div>
    </div>
</div>
@endsection
