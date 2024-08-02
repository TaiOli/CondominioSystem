<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoradoresController;
use App\Http\Controllers\VeiculosController;
use App\Http\Controllers\AnimaisController;
use App\Http\Controllers\DocumentosController;
use App\Http\Controllers\AutorizacoesController;
use App\Http\Controllers\UnidadesController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rotas Adicionando
Route::post('/moradores', [MoradoresController::class, 'store']);
Route::post('/veiculos', [VeiculosController::class, 'store']);
Route::post('/animais', [AnimaisController::class, 'store']);
Route::post('/documentos', [DocumentosController::class, 'store']);
Route::post('/autorizacoes', [AutorizacoesController::class, 'store']);

// Rotas Listando
Route::get('/unidades', [UnidadesController::class, 'index']);
Route::get('/moradores', [MoradoresController::class, 'index']);
Route::get('/veiculos', [VeiculosController::class, 'index']);
Route::get('/animais', [AnimaisController::class, 'index']);
Route::get('/autorizacoes', [AutorizacoesController::class, 'index']);
Route::get('/documentos', [DocumentosController::class, 'index']);