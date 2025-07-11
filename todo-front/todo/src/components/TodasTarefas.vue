<script lang="ts">
import type ITarefa from '@/interfaces/ITarefa';
import { listarTarefas, } from '@/http'
import Botao from './Botao.vue';
import Knob from 'primevue/knob';

export default {

    data() {
        return {
            tarefas: [] as ITarefa[],
            statusTarefa: "",
            numTarefasConcluidas: 0,
            numTarefasPendentes: 0,
        }
    },

    async created() {
        const tarefas = await listarTarefas()
        this.tarefas = tarefas

        this.tarefas.forEach(tarefa => {
            this.contarTarefas(tarefa.status);
        });
    },

    methods: {
        goToCadastrarTarefa() {
            this.$router.push('/cadastrarTarefa')
        },

        contarTarefas(status : number) {
            if (status == 1) {
                this.numTarefasConcluidas++;
            }
            else if (status == 0) {
                this.numTarefasPendentes++;
            }
        }
    },
    
    components: {
        Botao,
        Knob
    }
    }
</script>

<template>
    <div class="cabecalhoTodasTarefas">
        <h1>Tarefas</h1>
        <Botao texto="Cadastrar Tarefa" @click="goToCadastrarTarefa" />
    </div>
    <div>
        <div class="container-dados">
            <div class="containerTarefasConcluidas">
                <label for="numTarefasConcluidas">Tarefas Concluídas</label>
                <Knob class="numTarefasConcluidas" id="numTarefasConcluidas" v-bind:disabled="true" v-model="numTarefasConcluidas"/>
            </div>
            <div class="containerTarefasPendentes">
                <label for="numTarefasPendentes">Tarefas Pendentes</label>
                <Knob class="numTarefasPendentes" id="numTarefasPendentes" v-bind:disabled="true" v-model="numTarefasPendentes"/>
            </div>
        </div>
        <ul v-if="tarefas">
            <li class="tarefa" v-for="tarefa in tarefas">
                {{ tarefa.conteudo }}
                <span class="tarefaConcluida" v-if="tarefa.status == 1">Concluída</span>
                <span class="tarefaEmAndamento" v-else>Em andamento</span>
            </li>
        </ul>
    </div>
</template>


<style scoped>
.cabecalhoTodasTarefas {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.tarefa {
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
    padding: 15px;
    border: solid 1px rgba(0, 0, 0, 0.144);
}

.tarefaConcluida {
    color: #28A745;
}

.tarefaEmAndamento {
    color: #FFC107;
}

.container-dados {
    display: flex;
    gap: 50px;
    border: solid 1px rgba(0, 0, 0, 0.144);
    border-radius: 5px;
    padding: 50px;
    width: 30%;
    margin-left: 40px;
}

.containerTarefasConcluidas {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
}

.p-knob {
    opacity: 1;
};

.numTarefasConcluidas{
    --p-knob-value-background: #28A745;
}
.numTarefasPendentes{
    --p-knob-value-background: #FFC107;
}

.containerTarefasPendentes{
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
}
</style>