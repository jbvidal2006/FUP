<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RequestsAppController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\EnlacesController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('user/inactive',[UserController::class,'showUserInactive']);
Route::resource('user', UserController::class);
Route::post('auth/login', [AuthController::class, 'login']);
Route::resource('people', PeopleController::class);

Route::middleware('auth:sanctum')->group(function () {

    Route::resource('sales', SalesController::class);
    Route::resource('requestApp',RequestsAppController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('provider', ProviderController::class);
    Route::get('auth/logout', [AuthController::class, 'logout']);
});



/*rutas adicionales-- para traer personas y provedores
Route::get('/providerWithPeople', [EnlacesController::class, 'getPeopleProvider']);
*/

