<script lang="ts">
import Botao from './Botao.vue';
import { cadastrarTarefa } from '@/http';
import ProgressBar from 'primevue/progressbar';
import FloatLabel from 'primevue/floatlabel';
import Select from 'primevue/select';
import InputText from 'primevue/inputtext';


export default {
    components: { Botao, ProgressBar, FloatLabel, Select, InputText},
    data() {
        return {
            nomeTarefa: '',
            erro: false,
            sucesso: false,
            mensagemErro: '',
            mensagemSucesso: '',
            valorBarra: 0,
            mostrarBarraProgresso: false,
            dificuldadeSelecionada: "",
            dificuldades: [
                {nome: 'Fácil', codigo: 'F'},
                {nome: 'Média', codigo: 'M'},
                {nome: 'Difícil', codigo: 'D'}
            ]
        };
    },
    methods: {
        showSuccess() {
            this.$toast.add({ severity: 'success', summary: 'Sucesso', detail: 'Tarefa cadastrada com sucesso', life: 3000});
        },
        showError () {
            this.$toast.add({ severity: 'error', summary: 'Erro', detail: 'Erro ao cadastrar a tarefa', life: 3000 });
        },
        async salvar() {
            if (this.nomeTarefa.trim() === '') {
                this.mensagemErro = 'O nome da tarefa é obrigatório.';
                return this.erro = true;
            }

            this.erro = false;
            this.mensagemErro = '';

            try {
                this.mostrarBarraProgresso = true;
                await cadastrarTarefa({ conteudo: this.nomeTarefa, status: 0, dificuldade: this.dificuldadeSelecionada });
                this.nomeTarefa = '';
                this.sucesso = true
            } catch (error) {
                console.error(error);
                this.showError();
            }

            if (this.sucesso) {
                setTimeout(() => {
                    this.showSuccess();
                    this.mostrarBarraProgresso = false;
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
            <div class="container-input">    
                <FloatLabel class="labelTarefa">
                    <label for="tarefa">Tarefa</label>
                    <InputText class="inputTarefa" id="tarefa" type="text" v-model="nomeTarefa" @input="limparErro()"/>
                </FloatLabel>
            </div>
            <span v-if="erro" class="mensagemErro">{{ mensagemErro }}</span>
            <Select v-model="dificuldadeSelecionada" :options="dificuldades" option-label="nome" placeholder="Selecione a dificuldade"></Select>
            
            <ProgressBar v-if="mostrarBarraProgresso" mode="indeterminate" class="barraProgresso"/>
            <Botao texto="Salvar" @click="salvar"/>
        </div>
    </div>
    <Toast position="bottom-right"/>
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

.labelTarefa {
    width: 100%;
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

.inputTarefa {
    width: 100%;
}

.barraProgresso {
    height: 5px;
    border-radius: 5px;
    background-color: transparent;
    --p-progressbar-value-background: #F53003
}
</style>