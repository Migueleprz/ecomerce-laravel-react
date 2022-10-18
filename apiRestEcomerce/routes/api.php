<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Categorias\CategoriaController;
use App\Http\Controllers\Marcas\MarcaController;
use App\Http\Controllers\Producto\ProductoController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('ingreso', [AuthController::class, 'login']);

Route::resource('categorias', CategoriaController::class)->only(['index','store','show','update','destroy']);
Route::resource('marcas', MarcaController::class)->only(['index','store','show','destroy']);
Route::post('marcas/{id}', [MarcaController::class, 'update']);

Route::resource('productos', ProductoController::class)->only(['index','store','show','destroy']);
Route::post('productos/{id}', [ProductoController::class, 'update']);
