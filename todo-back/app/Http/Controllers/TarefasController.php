<?php

namespace App\Http\Controllers;

use App\Models\Tarefas;
use App\Enums\Dificuldade;
use Illuminate\Http\Request;

class TarefasController extends Controller
{
    protected $table = 'tarefas';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarefas = Tarefas::where('status', 0)
            ->orderBy('created_at')    
            ->get();

        return $tarefas;
    }

    public function listarTarefas()
    {
        $tarefas = Tarefas::orderBy('status', 'DESC')->get();

        return $tarefas;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tarefa = new Tarefas();
        $tarefa->conteudo = $request->input('conteudo');
        $tarefa->status = $request->input('status');
        $tarefa->dificuldade = $request->input('dificuldade')['codigo'];
        $tarefa->save();

        return response()->json(['mensagem' => 'Tarefa cadastrada com sucesso']);
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
        if ($id !== null) {
            try {
                $tarefa = Tarefas::find($id);
                $tarefa->status = 1;
                $tarefa->save();
            }
            catch (\Throwable $e) {
                return $e;
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            if ($id != null) {
                Tarefas::destroy($id);
            }
        } catch (\Throwable $e) {
            return $e;
        }
    }
}
