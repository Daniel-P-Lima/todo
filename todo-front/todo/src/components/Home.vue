<script lang="ts">
import { obterTarefas, deletarTarefa, concluirTarefa } from '@/http'
import type ITarefa from '@/interfaces/ITarefa'
import Botao from '@/components/Botao.vue'
import ProgressBar from 'primevue/progressbar';

export default {
    components: {
        Botao,
        ProgressBar
    },
    data() {
        return {
            tarefas: [] as ITarefa[],
            tarefaSelecionada: null as ITarefa | null,
            mostrarModal: false,
            statusTarefa: "",
            mostrarBarra: false,
            mostrarLixeira: true,
        }
    },
    async created() {
        const tarefas = await obterTarefas()
        this.tarefas = tarefas
    },
    methods: {
        show() {
            this.$toast.add({ severity: 'info', summary: 'Info', detail: 'Message Content', life: 3000 });
        },
        goToCadastrarTarefa() {
            this.$router.push('/cadastrarTarefa')
        },
        async deletarTarefa(tarefaId: number) {
            this.mostrarBarra = true;

            await deletarTarefa(tarefaId);
            const tarefas = await obterTarefas();

            setTimeout(() => {
                this.tarefas = tarefas
                this.mostrarLixeira = true;
                this.mostrarBarra = false;
            }, 2000);
            
        },
        verTarefa(tarefa: ITarefa) {
            this.tarefaSelecionada = tarefa;
            if (tarefa.status == 0) {
                this.statusTarefa = "Em andamento"
            }
            this.mostrarModal = true;
        },
        async concluirTarefa(tarefaId: number) {
            this.show();
            await concluirTarefa(tarefaId);
            this.mostrarModal = false;
            
            const tarefas = await obterTarefas();
            this.tarefas = tarefas
        },
        formatarData(data : string) {
            const date = new Date(data);
            const formattedDate = new Intl.DateTimeFormat('pt-BR').format(date);
            return formattedDate
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
            <li v-if="tarefas.length > 0" class="tarefa" v-for="tarefa in tarefas" :key="tarefa.id">
                <div class="divTarefa" @click="tarefa.id !== undefined && verTarefa(tarefa)">
                    {{ tarefa.conteudo }}
                </div>
                <span v-if="mostrarLixeira" class="material-icons lixo"
                    @click="tarefa.id !== undefined && deletarTarefa(tarefa.id)">delete
                </span>
            </li>
            <ProgressBar mode="indeterminate" v-if="mostrarBarra" class="barraProgresso"/>
            <span class="semTarefas" v-else-if="tarefas.length < 0"><img src="../assets/sobre_icon.svg" alt="">Nenhuma tarefa em andamento</span>
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
                    <p><strong>Data de inclusão:</strong> {{ tarefaSelecionada?.created_at !== undefined && formatarData(tarefaSelecionada?.created_at) }}</p>
                </div>
                <div class="botoesModal">
                    <Botao texto="Concluir Tarefa" @click="tarefaSelecionada?.id !== undefined && concluirTarefa(tarefaSelecionada?.id)"/>
                </div>
                <Toast />
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
    border: solid 1px rgba(0, 0, 0, 0.144);
}

.divTarefa {
    width: 100%;
    height: 100%;
    padding: 15px;
}

.tarefa:hover {
    cursor: pointer;
    background-color: rgba(0, 0, 0, 0.068);
}

.lixo {
    padding: 15px;
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

.semTarefas {
    display: flex;
    align-items: center;
    gap: 10px;
}


.barraProgresso {
    height: 5px;
    border-radius: 5px;
    background-color: transparent;
    --p-progressbar-value-background: #F53003
}
</style>
