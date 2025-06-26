<?php

namespace App\Http\Controllers;

use App\Models\Tarefas;
use Illuminate\Http\Request;

class TarefasController extends Controller
{
    protected $table = 'tarefas';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarefas = Tarefas::all();

        return $tarefas;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tarefa = Tarefas::find($id);

        return $tarefa;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
