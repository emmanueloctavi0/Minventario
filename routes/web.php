<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@home');

Route::get('/login', 'PagesController@login')->name('login');
Route::get('/ingresar', 'PagesController@ingresar');
Route::get('/registrarse', 'PagesController@registrarse');
Route::get('/agregarProducto', 'PagesController@agregarProducto');
Route::get('/modificar/{articleId}', 'PagesController@modificar');