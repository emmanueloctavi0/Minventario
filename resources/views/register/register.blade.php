@extends('layouts.app')

@section('navbar-items')
    <li class="nav-item" > <a class="nav-link" href="/">Home</a> </li>
    <li class="nav-item" > <a class="nav-link" href="/ingresar">Ingresar</a> </li>
@endsection

@section('content')
{{--Registrarse  --}}
<div class="row justify-content-center">

<div class="col-sm-12 card mt-5 p-5">
    <h3>Registrarse</h3>
    <div class="form-group">
        <label for="nameRegister">Nombre</label>
        <input class="form-control" type="text" id="nameRegister" placeholder="Ingresa tu nombre">
    </div>
    <div class="form-group">
        <label for="emailRegister">Correo electrónico</label>
        <input class="form-control" type="email" id="emailRegister" placeholder="Ingresa tu correo electrónico">
    </div>
    <div class="form-group">
        <label for="passwordRegister">Contraseña</label>
        <input class="form-control" type="password" id="passwordRegister" placeholder="Contraseña">
    </div>
    <div class="form-group">
        <label for="passwordRegisterC">Confirmar contraseña</label>
        <input class="form-control" type="password" id="passwordRegisterC" placeholder="Contraseña">
        <small id="registerHelp" class="text-danger form-text"></small>
    </div>

    <button id="btnCreate" class="w-25 m-auto btn btn-success">Crear cuenta</button>
    <p class="mt-3 mb-0 mx-auto ">Si ya tienes una cuenta puedes iniciar sesión</p>
    <a  href="/ingresar" class="w-25 mx-auto d-inline-block btn btn-primary">Iniciar sesión</a>
</div>
</div>
<script type="text/javascript" src="{{url('js/register/register.js')}}" ></script>
@endsection
