<script lang="ts">
import type ITarefa from '@/interfaces/ITarefa';
import { listarTarefas, } from '@/http'
import Botao from './Botao.vue';

    export default {

    data() {
        return {
            tarefas: [] as ITarefa[],
            statusTarefa: ""
        }
    },

    async created() {
        const tarefas = await listarTarefas()
        this.tarefas = tarefas
    },

    methods: {
        goToCadastrarTarefa() {
            this.$router.push('/cadastrarTarefa')
        },

        verificarStatus(status: number) {
            if (status === 1) {
                this.statusTarefa = "Concluída"
            }
            else {
                this.statusTarefa = "Em andamento"
            }
            return this.statusTarefa;
        }
    },
    
    components: {
        Botao
    }
    }
</script>

<template>
    <div class="cabecalhoTodasTarefas">
        <h1>Tarefas</h1>
        <Botao texto="Cadastrar Tarefa" @click="goToCadastrarTarefa" />
    </div>
    <div>
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
</style>