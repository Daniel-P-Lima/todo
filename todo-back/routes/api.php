<?php

use App\Http\Controllers\TarefasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get("/tarefas", [TarefasController::class, "index"]);
Route::get("/tarefas/{id}", [TarefasController::class, "show"]);
Route::post("/cadastrarTarefa", [TarefasController::class, "store"]);
Route::post("/deletarTarefa/{id}", [TarefasController::class, "destroy"]);