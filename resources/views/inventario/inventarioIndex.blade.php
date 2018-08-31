@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{url('css/inventario/table.css')}}">
@endsection

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
    <h3 class="my-4">Inventario de @{{userName}}</h3>
    <button type="button" class="btn btn-outline-secondary btn-sm mb-2">Agregar producto</button>
    <table v-if="areProducts" class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio unitario</th>
                <th scope="col">Precio Total</th>
                <th scope="col"></th>
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
                <td> <span v-on:click="deleteProduct(product.article_id)" id="productId" class="text-muted">Eliminar</span> </td>
            </tr>
        </tbody>
    </table>
    <div v-else class="card p-2 text-center">
        No hay productos en el inventario!!
    </div>

    <button v-if="areProducts" class="btn btn-success my-2 float-left">Descargar PDF</button>
    <button v-if="areProducts" class="btn btn-success my-2 ml-3 float-left">Descargar Excel</button>

    <button class="btn btn-danger my-2 float-right">Subir Excel</button>

</div>

<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script type="text/javascript" src="{{url('js/inventario/table.js')}}"></script>
@endsection
