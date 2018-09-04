@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{secure_url('css/inventario/table.css')}}">
@endsection

@section('navbar-items')
    <li class="nav-item" > <a class="nav-link" href="/registrarse">Registrarse</a> </li>
    <li class="nav-item" > <a class="nav-link" href="/ingresar">Ingresar</a> </li>
    <li class="nav-item" > <a id="logout" class="nav-link" href="#">Salir</a> </li>
@endsection

@section('content')
<div id="articleTable">
    <h2 class="my-4 text-center">Inventario de @{{userName}}</h2>
    <a href="/agregarProducto" class="btn btn-outline-secondary btn-sm mb-2">Agregar producto</a>
    <table id="mainTable" v-if="areProducts" class="table table-hover">
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
                <th scope="row"><a class="text-body" v-bind:href="'/modificar/'+product.article_id">@{{product.article_id}}</a> </th>
                <td>@{{product.name}}</td>
                <td>@{{product.description}}</td>
                <td>@{{product.amount}}</td>
                <td>$@{{product.price}}</td>
                <td>$@{{product.price * product.amount}}</td>
                <td> <span v-on:click="deleteProduct(product.article_id)" id="productId" class="text-muted">Eliminar</span> </td>
            </tr>
        </tbody>
    </table>
    <div id="editor"></div>
    <div v-else class="card p-2 text-center">
        No hay productos en el inventario!!
    </div>
    <div class="btnTable">
        <button v-if="areProducts" v-on:click="exportPDF" class="btn btn-success my-2 mx-3">Descargar PDF</button>
        <button v-if="areProducts" v-on:click="downloadFile" class="btn btn-success my-2 mx-3">Descargar Excel</button>

        <input class="inputExcel my-2" type="file"/>
        <button v-on:click="uploadFile" class="btnExcel btn btn-danger my-2 mx-3">Subir Excel</button>
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
<script src="{{secure_url('js/general/jquery.min.js')}}"></script>
<script src="{{secure_url('js/general/vue.js')}}"></script>

{{--Generar pdf--}}
<script src="{{secure_url('js/general/jspdf.min.js')}}"></script>
<script src="{{secure_url('js/general/jspdf.plugin.autotable.js')}}"></script>

<script type="text/javascript" src="{{secure_url('js/inventario/table.js')}}"></script>
{{--Graficas--}}
<script type="text/javascript" src="{{secure_url('js/inventario/loader.js')}}"></script>
<script type="text/javascript" src="{{secure_url('js/inventario/pieChart.js')}}" ></script>
@endsection
