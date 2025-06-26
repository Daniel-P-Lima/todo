<?php

use App\Http\Controllers\TarefasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/ola', function (Request $request) {
    return 'ola';
});

Route::get("/tarefas", [TarefasController::class, "index"]);
Route::get("/tarefas/{id}", [TarefasController::class, "show"]);