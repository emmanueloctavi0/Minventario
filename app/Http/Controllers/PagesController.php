<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // Para la api
    public function login()
    {
        $response = [
            'success' => false,
            'message' => 'Tienes que estar logeado',
        ];

        return response()->json($response, 401);
    }

    public function ingresar()
    {
        return view('login');
    }

    public function home()
    {
        return view('inventario.inventarioIndex');
    }
}
