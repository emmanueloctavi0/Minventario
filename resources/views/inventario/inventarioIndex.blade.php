@extends('layouts.app')

@section('content')



<h3 class="m-4">Inventario de NOMBRE</h3>

<button class="btn btn-success mb-3" type="button" name="button">Descargar PDF</button>
<button class="btn btn-success mb-3 ml-3" type="button" name="button">Descargar Excel</button>

<button class="btn btn-danger mb-3 float-right" type="button" name="button">Subir Excel</button>


<table class="table table-hover">

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
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Ladrillos</td>
            <td>Ladrillos rojos</td>
            <td>100</td>
            <td>$2.3</td>
            <td>$230</td>
        </tr>
    </tbody>
</table>


@endsection
