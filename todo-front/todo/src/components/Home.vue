<script lang="ts">
import { obterTarefas, deletarTarefa, concluirTarefa } from '@/http'
import type ITarefa from '@/interfaces/ITarefa'
import Botao from '@/components/Botao.vue'

export default {
    components: {
        Botao
    },
    data() {
        return {
            tarefas: [] as ITarefa[],
            tarefaSelecionada: null as ITarefa | null,
            mostrarModal: false,
            statusTarefa: ""
        }
    },
    async created() {
        const tarefas = await obterTarefas()
        this.tarefas = tarefas
    },
    methods: {
        goToCadastrarTarefa() {
            this.$router.push('/cadastrarTarefa')
        },
        async deletarTarefa(tarefaId: number) {
            await deletarTarefa(tarefaId);
            const tarefas = await obterTarefas();
            this.tarefas = tarefas
        },
        verTarefa(tarefa: ITarefa) {
            this.tarefaSelecionada = tarefa;
            if (tarefa.status == 0) {
                this.statusTarefa = "Em andamento"
            }
            this.mostrarModal = true;
        },
        async concluirTarefa(tarefaId: number) {
            await concluirTarefa(tarefaId);
            this.mostrarModal = false;
            
            const tarefas = await obterTarefas();
            this.tarefas = tarefas
        }

    }
}
</script>

<template>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <div class="home">
        <div class="cabecalhoHome">
            <h1>Tarefas à Fazer</h1>
            <Botao texto="Cadastrar Tarefa" @click="goToCadastrarTarefa" />
        </div>
        <ul class="listaTarefas">
            <li class="tarefa" v-for="tarefa in tarefas" :key="tarefa.id"
                @click="tarefa.id !== undefined && verTarefa(tarefa)">
                {{ tarefa.conteudo }}
                <span class="material-icons lixo"
                    @click="tarefa.id !== undefined && deletarTarefa(tarefa.id)">delete</span>
            </li>
        </ul>

        <div v-if="mostrarModal" class="modalOverlay">
            <div class="modal">



                <div class="headerModal">
                    <h2>Detalhes da Tarefa</h2>
                    <span class="material-icons botaoFecharModal" @click="mostrarModal = false">
                        close
                    </span>
                </div>
                <div class="conteudoModal">
                    <p><strong>Conteúdo:</strong> {{ tarefaSelecionada?.conteudo }}</p>
                    <p><strong>Status:</strong> {{ statusTarefa }}</p>
                </div>
                <div class="botoesModal">
                    <Botao texto="Concluir Tarefa" @click="tarefaSelecionada?.id !== undefined && concluirTarefa(tarefaSelecionada?.id)"/>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.cabecalhoHome {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.listaTarefas {
    list-style: none;
}

.tarefa {
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
    padding: 15px;
    border: solid 1px rgba(0, 0, 0, 0.144);
}

.tarefa:hover {
    cursor: pointer;
    height: 4.5vh;
    background-color: rgba(0, 0, 0, 0.068);
}

.lixo {
    color: red;
}

.headerModal {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: -1.5rem;
    margin-bottom: 1rem;
}

.conteudoModal {
    margin-bottom: 3rem;
}

.botaoFecharModal {
    display: flex;
    justify-self: flex-end;
    cursor: pointer;
}
.modalOverlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.botoesModal {
    display: flex;
    justify-content: end;
}
.modal {
    background: white;
    padding: 20px;
    border-radius: 8px;
    width: 500px;
}
</style>
