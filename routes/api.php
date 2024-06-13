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

//ruta para login
Route::post('auth/login', [AuthController::class, 'login']);

//restablecer contraseña
Route::post('auth/saveNewPassword', [AuthController::class, 'saveNewPassword']);
//buscar usuario por cedula
Route::get('auth/searchPhoneCCid/{cc}', [AuthController::class, 'searchPhoneCCid']);

//rutas users
Route::get('/user/create', [UserController::class, 'create']);
Route::post('/user', [UserController::class, 'store']);

//rutas people
Route::post('/people', [PeopleController::class, 'store']);


Route::middleware('auth:sanctum')->group(function () {

    //rutas users token
    Route::get('user/inactive', [UserController::class, 'showUserInactive']);
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/{user}', [UserController::class, 'show']);
    Route::get('/user/{user}/edit', [UserController::class, 'edit']);
    Route::put('/user/{user}', [UserController::class, 'update']);
    Route::patch('/user/{user}', [UserController::class, 'update']);
    Route::delete('/user/{user}', [UserController::class, 'destroy']);

    //rutas people token
    Route::get('/people/create', [PeopleController::class, 'create']);
    Route::get('/people', [PeopleController::class, 'index']);
    Route::get('/people/{people}', [PeopleController::class, 'show']);
    Route::get('/people/{people}/edit', [PeopleController::class, 'edit']);
    Route::put('/people/{people}', [PeopleController::class, 'update']);
    Route::patch('/people/{people}', [PeopleController::class, 'update']);
    Route::delete('/people/{people}', [PeopleController::class, 'destroy']);


    Route::resource('sales', SalesController::class);
    Route::resource('requestApp', RequestsAppController::class);
    Route::resource('product', ProductController::class);
    Route::resource('provider', ProviderController::class);
    Route::get('auth/logout', [AuthController::class, 'logout']);

    //rutes for category and filter whith product
    Route::resource('category', CategoryController::class);
    Route::get('/category/filterproduct/{id}', [CategoryController::class, 'filtroCategoryID']);




    //actualizar ranking de provider
    Route::put('/provider/updateOnlyRanking/{id}', [ProviderController::class, 'updateOnlyRanking']);


    //rutas de filtrado
    Route::get('/filtrarPorNombre', [ProductController::class, 'filtrarPorNombre']);
    Route::get('/filtrarPorPrecioMenorAMayor', [ProductController::class, 'filtrarPorPrecioMenorAMayor']);
    Route::get('/filtrarPorPrecioMayorAMenor', [ProductController::class, 'filtrarPorPrecioMayorAMenor']);
    Route::get('/filtrarPorCertificado', [ProductController::class, 'filtrarPorCertificado']);

//rutas enlazadas
Route::get('/showPeopleUsers', [EnlacesController::class, 'showPeopleUsers']);

});


//ruta para comparar id del provider producto y provider sesion
Route::get('/compararSesionProviderConProductProviderID/{id}/{id2}', [ProductController::class, 'compararSesionProviderConProductProviderID']);
//enviar solicitud de recuperar password
Route::post('requestApp/contrasena', [RequestsAppController::class, 'contrasena']);



// ruta adicional
Route::get('/usuariosPersonas', [EnlacesController::class, 'joinProvPeo']);
Route::get('/productosProvedoresPernas', [EnlacesController::class, 'joinProdProvPers']);
Route::get('/joinProdProvPeopleID/{id}', [EnlacesController::class, 'joinProdProvPeopleID']);
Route::get('/joinReqPeoUsu/{id}', [EnlacesController::class, 'joinReqPeoUsu']);
Route::get('joinUserPeople/{id}', [EnlacesController::class, 'joinUserPeople']);
Route::get('/joinProvedorpeopleID/{id}', [EnlacesController::class, 'joinProvedorpeopleID']);
Route::get('/showReqPeoUsu', [EnlacesController::class, 'showReqPeoUsu']);
Route::get('/joinUserPeopleID/{id}', [EnlacesController::class, 'joinUserPeopleID']);
Route::get('/joinProduProviderID/{id}', [EnlacesController::class, 'unirPeopleProdProviderID']);
