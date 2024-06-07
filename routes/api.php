<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RequestsAppController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EnlacesController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UserController;



//para subir imagenes
use App\Http\Controllers\FileUploadController;

//ruta para GUARDAR imagenes en local
Route::post('imagen', [FileUploadController::class, 'upload']);
Route::get('imagen/{urlimage}', [FileUploadController::class, 'imagenID']);

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

//restablecer contraseña
Route::post('auth/saveNewPassword', [AuthController::class, 'saveNewPassword']);



Route::middleware('auth:sanctum')->group(function () {

    Route::resource('sales', SalesController::class);
    Route::resource('requestApp',RequestsAppController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('provider', ProviderController::class);
    Route::get('auth/logout', [AuthController::class, 'logout']);

    //actualizar ranking de provider
    Route::put('/provider/updateOnlyRanking/{id}', [ProviderController::class, 'updateOnlyRanking']);




 //rutas de filtrado
 Route::get('/filtrarPorNombre', [ProductController::class, 'filtrarPorNombre']);
 Route::get('/filtrarPorPrecioMenorAMayor', [ProductController::class, 'filtrarPorPrecioMenorAMayor']);
 Route::get('/filtrarPorPrecioMayorAMenor', [ProductController::class, 'filtrarPorPrecioMayorAMenor']);
 Route::get('/filtrarPorCertificado', [ProductController::class, 'filtrarPorCertificado']);


});




// ruta adicional
Route::get('/usuariosPersonas', [EnlacesController::class, 'joinProvPeo']);
Route::get('/productosProvedoresPernas', [EnlacesController::class, 'joinProdProvPers']);
Route::get('/joinProdProvPeopleID/{id}', [EnlacesController::class, 'joinProdProvPeopleID']);
Route::get('/joinReqPeoUsu/{id}', [EnlacesController::class, 'joinReqPeoUsu']);
Route::get('joinUserPeople/{id}',[EnlacesController::class, 'joinUserPeople']);
Route::get('/joinProvedorpeopleID/{id}', [EnlacesController::class, 'joinProvedorpeopleID']);
Route::get('/showReqPeoUsu', [EnlacesController::class, 'showReqPeoUsu']);
Route::get('/joinProduProviderID/{id}', [EnlacesController::class, 'joinProduProviderID']);
Route::get('/showPeopleUsers', [EnlacesController::class, 'showPeopleUsers']);
Route::get('/joinUserPeopleID/{id}', [EnlacesController::class, 'joinUserPeopleID']);






