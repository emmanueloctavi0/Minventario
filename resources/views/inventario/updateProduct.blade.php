@extends('layouts.app')

@section('navbar-items')
    <li class="nav-item" > <a class="nav-link" href="/">Home</a></li>
@endsection

@section('content')
    <h3 class="text-center my-2">Modificar producto</h3>
    <div class="card p-4 my-4 mx-auto w-50">
        <fieldset disabled>
            <div class="form-group">
                <label for="articleId">ID</label>
                <input type="text" id="articleId" class="form-control" value="{{$articleId}}">
            </div>
        </fieldset>
        <div class="form-group">
            <label for="nameAdd">Nombre del producto</label>
            <input id="nameAdd" class="form-control" type="text"/>
        </div>
        <div class="form-group">
            <label for="descriptionAdd">Descripción del producto</label>
            <textarea id="descriptionAdd" class="form-control" rows="3"> </textarea>
        </div>
        <div class="form-group">
            <label for="amountAdd">Cantidad</label>
            <input id="amountAdd" class="form-control" type="number"/>
        </div>
        <div class="form-group">
            <label for="priceAdd">Precio</label>
            <input id="priceAdd" class="form-control" type="number"/>
            <small id="addHelp" class="text-danger form-text"></small>
        </div>

        <button id="sendData" class="w-50 mx-auto btn btn-success" type="button" name="button">Modificar</button>
    </div>
    <script type="text/javascript" src="{{url('js/inventario/updateProduct.js')}}" ></script>
@endsection
