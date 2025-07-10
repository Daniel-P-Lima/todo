<script lang="ts">
import Botao from './Botao.vue';
import { cadastrarTarefa } from '@/http';
import ProgressSpinner from 'primevue/progressspinner';
import ProgressBar from 'primevue/progressbar';

export default {
    components: { Botao, ProgressSpinner, ProgressBar},
    data() {
        return {
            nomeTarefa: '',
            erro: false,
            sucesso: false,
            mensagemErro: '',
            mensagemSucesso: '',
            valorBarra: 0,
            mostrarSpinner: false,
        };
    },
    methods: {
        async salvar() {
            if (this.nomeTarefa.trim() === '') {
                this.mensagemErro = 'O nome da tarefa é obrigatório.';
                return this.erro = true;
            }

            this.erro = false;
            this.mensagemErro = '';

            try {
                this.mostrarSpinner = true;
                await cadastrarTarefa({ conteudo: this.nomeTarefa, status: 0 });
                this.nomeTarefa = '';
                this.sucesso = true
            } catch (error) {
                console.error(error);
                alert('Erro ao cadastrar tarefa');
            }

            if (this.sucesso) {
                setTimeout(() => {
                    this.mensagemSucesso = 'Tarefa cadastrada com sucesso!'
                }, 2000);
                setTimeout(() => {
                    this.$router.push('/');
                }, 3000);
            } 
        },

        limparErro() {
            if (this.nomeTarefa.trim() !== '') {
                this.erro = false;
                this.mensagemErro = '';
            }
        }
    }
}
</script>


<template>
    <h1>Cadastrar tarefa</h1>
    <div class="cardFormulario">
        <div class="formulario">
            <label for="tarefa">Tarefa</label>
            <div class="container-input">    
                <input :class="['tarefaFormulario', { classeErro: erro }]" type="text" id="tarefa"
                    placeholder="Digite aqui..." v-model="nomeTarefa" @input="limparErro" />
                <ProgressSpinner v-if="mostrarSpinner" class="spinner"/>
            </div>
            <span v-if="erro" class="mensagemErro">{{ mensagemErro }}</span>
            <span v-else-if="sucesso" class="mensagemSucesso">{{ mensagemSucesso }}</span>
            <Botao texto="Salvar" @click="salvar"/>
        </div>
    </div>
</template>



<style scoped>
.cardFormulario {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

.formulario {
    display: flex;
    gap: 20px;
    flex-direction: column;
}

.tarefaFormulario {
    border: none;
    outline: none;
    border-bottom: 0.1px solid #000000;
    padding: 10px;
    width: 50vh;
}

.botaoSalvarTarefa {
    display: flex;
    align-self: flex-end;
    border: none;
    padding: 10px;
    float: right;
}

.botaoSalvarTarefa:hover {
    color: #fff;
    width: 10vh;
    height: 6vh;
    background-color: #33A06F;
}

.classeErro {
    border-bottom: 2px solid red;
}

.mensagemErro {
    margin-top: -1rem;
    color: red;
    font-size: 0.8em;
}

.mensagemSucesso {
    margin-top: -1rem;
    color: green;
    font-size: 0.8em;
}

.container-input {
    display: flex;
    align-items: center;
    width: 50vh;
}
.spinner {
    --p-progressspinner-color-one: black;
    --p-progressspinner-color-two : black;
    --p-progressspinner-color-three : black;
    --p-progressspinner-color-four: black;
    height: 30px;
    width: 25px;
}
</style>