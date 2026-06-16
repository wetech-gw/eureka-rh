<?php

use App\Http\Controllers\FormacaoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecrutamentoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function () {
    return response()->json(['message' => 'API do Eureka RH funcionando!']);
});

Route::get('/recrutamento', [RecrutamentoController::class, 'apiIndex']);
Route::get('/formacao', [FormacaoController::class, 'apiIndex']);