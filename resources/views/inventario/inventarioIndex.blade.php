@extends('layouts.app')

@section('navbar')
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item" > <a id="logout" class="nav-link" href="#">Salir</a> </li>
            </ul>
        </div>
    </nav>
@endsection

@section('content')
<div id="articleTable">
    <h3 class="m-4">Inventario de @{{userName}}</h3>

    <button class="btn btn-success mb-3" type="button" name="button">Descargar PDF</button>
    <button class="btn btn-success mb-3 ml-3" type="button" name="button">Descargar Excel</button>

    <button class="btn btn-danger mb-3 float-right" type="button" name="button">Subir Excel</button>


    <table v-if="areProducts" class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio unitario</th>
                <th scope="col">Precio Total</th>
            </tr>
        </thead>
        <tbody v-for="product in products">
            <tr>
                <th scope="row">@{{product.article_id}}</th>
                <td>@{{product.name}}</td>
                <td>@{{product.description}}</td>
                <td>@{{product.amount}}</td>
                <td>$@{{product.price}}</td>
                <td>$@{{product.price * product.amount}}</td>
            </tr>
        </tbody>
    </table>
    <div v-else class="">
        No hay productos en el inventario!!
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script type="text/javascript" src="{{url('js/inventario/table.js')}}"></script>
@endsection
