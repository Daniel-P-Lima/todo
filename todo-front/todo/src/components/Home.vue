<script lang="ts">
import { obterTarefas, deletarTarefa, concluirTarefa } from '@/http'
import type ITarefa from '@/interfaces/ITarefa'
import Botao from '@/components/Botao.vue'
import ProgressBar from 'primevue/progressbar';
import Badge from 'primevue/badge';
export default {
    components: {
        Botao,
        ProgressBar,
        Badge
    },
    data() {
        return {
            tarefas: [] as ITarefa[],
            numTarefas: 0,
            tarefaSelecionada: null as ITarefa | null,
            mostrarModal: false,
            statusTarefa: "",
            mostrarBarraExclusao: false,
            mostrarBarraConclusao: false,
            mostrarLixeira: true,
            chartData: null,
        }
    },
    async created() {
        const tarefas = await obterTarefas()
        this.tarefas = tarefas
        this.numTarefas = tarefas.length
    },
    methods: {
        sucessoTarefaConcluida() {
            this.$toast.add({ severity: 'success', summary: 'Sucesso', detail: 'Tarefa concluída com sucesso', life: 3000});
        },
        sucessoTarefaExcluída() {
            this.$toast.add({ severity: 'success', summary: 'Sucesso', detail: 'Tarefa excluída com sucesso', life: 3000});
        },
        erroTarefaExcluída() {
            this.$toast.add({ severity: 'error', summary: 'Erro', detail: 'Erro ao excluir tarefa', life: 3000});
        },
        goToCadastrarTarefa() {
            this.$router.push('/cadastrarTarefa')
        },
        async deletarTarefa(tarefaId: number) {
            this.mostrarBarraExclusao = true;

            try {
                await deletarTarefa(tarefaId);
                
                const tarefas = await obterTarefas();
                setTimeout(() => {
                    this.tarefas = tarefas;
                    this.numTarefas = tarefas.length
                    this.mostrarBarraExclusao = false;
                    
                    this.sucessoTarefaExcluída();
                }, 2000);   

            } catch (error) {
                this.erroTarefaExcluída();
            }
        },
        verTarefa(tarefa: ITarefa) {
            this.tarefaSelecionada = tarefa;
            if (tarefa.status == 0) {
                this.statusTarefa = "Em andamento"
            }
            this.mostrarModal = true;
        },
        async concluirTarefa(tarefaId: number) {
            this.mostrarBarraConclusao = true;

            try {
                await concluirTarefa(tarefaId);
                
                const tarefas = await obterTarefas();
                setTimeout(() => {   
                    this.tarefas = tarefas
                    this.numTarefas = tarefas.length
                    this.mostrarBarraConclusao = false;
                    this.mostrarModal = false;
                    
                    this.sucessoTarefaConcluida();
                }, 2000);
            } catch (error) {
                
            }
            
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
            <h1 class="cabecalhoHomeHeader">Tarefas à Fazer
                <Badge class="cabecalhoBadge" severity="info" :value="numTarefas"></Badge>
            </h1>
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
            <ProgressBar mode="indeterminate" v-if="mostrarBarraExclusao" class="barraProgresso"/>
            <span class="semTarefas" v-else-if="tarefas.length <= 0"><img src="../assets/sobre_icon.svg" alt="">Nenhuma tarefa em andamento</span>
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
                <ProgressBar mode="indeterminate" v-if="mostrarBarraConclusao" class="barraProgresso"/>
            </div>
        </div>
        <Toast position="bottom-right" />
    </div>
</template>

<style scoped>
.cabecalhoHome {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.cabecalhoHomeHeader {
    display: flex;
    align-items: center;
    gap: 20px;
}

.cabecalhoBadge {
    margin-top: 5px;
}
.listaTarefas {
    list-style: none;
}

.p-badge-info {
    background: #F22B02
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
    margin-bottom: 1vh;
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
