@extends('layouts.app')

@section('content')

{{-- Iniciar sesion --}}
<div class="row justify-content-center">
    <div class="col-sm-12 card mt-5 p-5">
        <h3>Iniciar sesión</h3>
        <div class="form-group">
            <label for="emailLogin">Correo electrónico</label>
            <input class="form-control" type="email" id="emailLogin" placeholder="Ingresa tu correo electrónico">
            <small id="loginHelp" class="text-danger form-text"></small>
        </div>
        <div class="form-group">
            <label for="passwordLogin">Contraseña</label>
            <input class="form-control" type="password" id="passwordLogin" placeholder="Contraseña">
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="rememberMe">
            <label class="form-check-label" for="recuerdame">Mantener iniciada la sesión</label>
        </div>
        <button id="btnLogin" class="w-25 btn btn-primary">Iniciar sesión</button>
    </div>
</div>
    {{--Registrarse  --}}
<div class="row justify-content-center">

    <form class="col-sm-12 card mt-1 p-5">
        <h3>Registrarse</h3>
        <div class="form-group">
            <label for="emailRegister">Correo electrónico</label>
            <input class="form-control" type="email" id="emailRegister" placeholder="Ingresa tu correo electrónico">
        </div>
        <div class="form-group">
            <label for="passwordRegister">Contraseña</label>
            <input class="form-control" type="password" id="passwordRegister" placeholder="Contraseña">
        </div>
        <div class="form-group">
            <label for="passwordRegisterConfirmation">Confirmar contraseña</label>
            <input class="form-control" type="password" id="passwordRegisterConfirmation" placeholder="Contraseña">
        </div>

        <button type="submit" class="w-25 btn btn-success">Registrarse</button>
    </form>
</div>

<script type="text/javascript" src="{{url('js/inventario/login.js')}}"> </script>

@endsection
