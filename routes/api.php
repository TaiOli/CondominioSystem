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

// Rota para obter dados através do ID
Route::get('/autorizacoes/{id}', [AutorizacoesController::class, 'show']);
Route::get('/documentos/{id}', [DocumentosController::class, 'show']);
Route::get('/moradores/{id}', [MoradoresController::class, 'show']);
Route::get('/animais/{id}', [AnimaisController::class, 'show']);
Route::get('/veiculos/{id}', [VeiculosController::class, 'show']);

// Rota Atualizando
Route::put('/autorizacoes/{id}', [AutorizacoesController::class, 'update']);
Route::put('/documentos/{id}', [DocumentosController::class, 'update']);
Route::put('/moradores/{id}', [MoradoresController::class, 'update']);
Route::put('/animais/{id}', [AnimaisController::class, 'update']);
Route::put('/veiculos/{id}', [VeiculosController::class, 'update']);

