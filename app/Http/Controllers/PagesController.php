<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ArticleExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Article;

class PagesController extends Controller
{
    // Para la api
    public function login()
    {
        $response = [
            'login' => false,
            'message' => 'Tienes que estar logeado',
        ];

        return response()->json($response, 401);
    }

    public function ingresar()
    {
        return view('register.login');
    }

    public function registrarse()
    {
        return view('register.register');
    }

    public function home()
    {
        return view('inventario.inventarioIndex');
    }

    public function agregarProducto()
    {
        return view('inventario.addProduct');
    }

    public function modificar($articleId)
    {
        return view('inventario.updateProduct', ['articleId' => $articleId]);
    }

    public function download(Request $request)
    {
        $user_id = $request->user()->id;
        return Excel::download(new ArticleExport($user_id), 'articulos.xlsx');
    }
}
