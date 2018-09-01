@extends('layouts.app')

@section('navbar-items')
    <li class="nav-item"> <a class="nav-link" href="/"> Home </a> </li>
    {{-- <li class="nav-item"> <a class="nav-link" href="/registrarse"> Crear cuenta </a> </li> --}}
@endsection
@section('content')

{{-- Iniciar sesion --}}
<div class="row justify-content-center">
    <div class="col-sm-12 card mt-5 p-5">
        <h3>Iniciar sesión</h3>
        <div class="form-group">
            <label for="emailLogin">Correo electrónico</label>
            <input class="form-control" type="email" id="emailLogin" placeholder="Ingresa tu correo electrónico">
        </div>
        <div class="form-group">
            <label for="passwordLogin">Contraseña</label>
            <input class="form-control" type="password" id="passwordLogin" placeholder="Contraseña">
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="rememberMe">
            <label class="form-check-label" for="recuerdame">Mantener iniciada la sesión</label>
            <small id="loginHelp" class="text-danger form-text"></small>
        </div>
        <button id="btnLogin" class="w-25 m-auto btn btn-success">Iniciar sesión</button>
        <p class="mt-3 mb-0 mx-auto ">Si áun no tienes una cuenta puedes registrar aquí abajo</p>
        <a  href="/registrarse" class="w-25 mx-auto d-inline-block btn btn-primary">Crear una cuenta</a>

    </div>
</div>

<script type="text/javascript" src="{{secure_url('js/register/login.js')}}"> </script>

@endsection
