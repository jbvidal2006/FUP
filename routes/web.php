<?php

use App\Http\Controllers\ResetpasswordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//<!--<a href="www.mercadoagrocologico/resert/{{$token)}}">Recuperar Contraseña</a>-->


Route::get('/', function () {
    return view('resetpassword');
});

