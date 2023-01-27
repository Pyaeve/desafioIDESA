<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
    \DB::table('users')->insert([
  'name' => 'Desafio Idesa',
  'email' => 'rifarca@gmail.com',
'password' => Hash::make('12345678' )
]);
     \DB::table('users')->insert([
  'name' => 'Valentin Idesa',
  'email' => 'valentin.zaracho@idesa.com.py',
'password' => Hash::make('12345678' )
]);
      \DB::table('users')->insert([
  'name' => 'Martin Martinez',
  'email' => 'martin.martinez@idesa.com.py',
'password' => Hash::make('12345678' )
]);
      
});


