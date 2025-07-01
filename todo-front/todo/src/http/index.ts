import type ITarefa from "@/interfaces/ITarefa";

export async function obterTarefas() {
    const resposta = await fetch("http://127.0.0.1:8000/api/tarefas")
    const tarefas : ITarefa[] = await resposta.json();
    return tarefas;
}

export async function cadastrarTarefa(tarefa: ITarefa) {
    const resposta = await fetch('http://127.0.0.1:8000/api/cadastrarTarefa', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(tarefa)
      })
    
      if (!resposta.ok) {
        throw new Error('Erro ao cadastrar tarefa')
      }
}

export async function deletarTarefa(id : number) {
    const resposta = await fetch("http://127.0.0.1:8000/api/deletarTarefa/" + id, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(id)
    })
    
    return resposta;
}

export async function concluirTarefa(id: number) {
  const resposta = await fetch("http://127.0.0.1:8000/api/concluirTarefa/" + id, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(id)
  })

  return resposta;
}

export async function listarTarefas() {
  const resposta = await fetch("http://127.0.0.1:8000/api/listarTarefas")

  const tarefas : ITarefa[] = await resposta.json();
  return tarefas;
}