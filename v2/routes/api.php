<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//ruta para autenticar
Route::post('auth', 'AuthController@login');
//agrupamos las rutas bajo auth 
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('clientes','ClientesController')
        parameters([
         'clientes' => 'id'
        ]);
    Route::apiResource('clientes.cuotas','ClientesCuotasController')
        ->only(['index', 'show'])
        parameters([
         'clientes' => 'id'
        ]);;//->shallow();
    Route::apiResource('cuotas','CuotasController')
        ->except([
        'index', 'show'
        ])
        ->parameters([
         'cuotas' => 'id'
        ]);;
});




