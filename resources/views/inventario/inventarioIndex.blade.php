@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{url('css/inventario/table.css')}}">
@endsection

@section('navbar-items')
    <li class="nav-item" > <a class="nav-link" href="/registrarse">Registrarse</a> </li>
    <li class="nav-item" > <a class="nav-link" href="/ingresar">Ingresar</a> </li>
    <li class="nav-item" > <a id="logout" class="nav-link" href="#">Salir</a> </li>
@endsection

@section('content')
<div id="articleTable">
    <h2 class="my-4 text-center">Inventario de @{{userName}}</h2>
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
    <div class="btnTable">
        <button v-if="areProducts" class="btn btn-success my-2 mx-3">Descargar PDF</button>
        <button v-if="areProducts" class="btn btn-success my-2 mx-3">Descargar Excel</button>

        <button class="btnExcel btn btn-danger my-2 mx-3">Subir Excel</button>
    </div>

</div>
<div class="border-top my-4"></div>
<h2 class=" text-center" >Gráficas</h2>
<select id="selectPie" class="mx-auto d-block custom-select w-25">
  <option selected value="0">Productos (cantidad)</option>
  <option value="1">Productos (precio unitario)</option>
  <option value="2">Productos (precio total)</option>
</select>
<div id="chart_div">
</div>

<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script type="text/javascript" src="{{url('js/inventario/table.js')}}"></script>
{{--Graficas--}}
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="{{url('js/inventario/pieChart.js')}}" ></script>
@endsection
