<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function home()
    {
        return view('inventario.inventarioIndex');
    }
}
