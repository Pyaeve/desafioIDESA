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
Route::post('user/auth', 'AuthController@login')->name('api.users.auth');
//agrupamos las rutas bajo auth 
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('clientes','ClientesController')
        ->parameters([
            'clientes' => 'id'
        ])
        ->names([
            'index' => 'api.clientes.listar',
            'show' => 'api.clientes.ver',
            'update' => 'api.clientes.actualizar',
            'destroy' => 'api.clientes.borrar',
            'store' => 'api.clientes.guardar',
            
    ]);
    Route::apiResource('clientes.cuotas','ClientesCuotasController')
        ->only(['show'])
        ->parameters([
         'cliente' => 'id',
        'cuota'=> 'lote'
        ])
        ->names([
            'show' => 'api.clientes.cuotas.ver'
        ]);
      
   
});




