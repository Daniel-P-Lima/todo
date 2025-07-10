<script lang="ts">
    export default {
        methods: {
            goToHome() {
                this.$router.push('/');
            },
            goToSobre() {
                this.$router.push('/sobre')
            }, 
            goToTodasTarefas() {
                this.$router.push('/todasTarefas')
            }
        }
    }
</script>


<template>
    <ul class="navbarUl">
        <li class="home" @click="goToHome">
            <img src="../assets/home_icon.svg" alt="">Home
        </li>
        <li class="todasTarefas" @click="goToTodasTarefas">
            <img src="../assets/tarefa_icon.svg" alt="">Tarefas
        </li>
        <li class="sobre" @click="goToSobre">
            <img src="../assets/sobre_icon.svg" alt="">Sobre
        </li>
    </ul>
</template>

<style scoped>
.navbarUl {
    list-style: none;
    display: flex;
    align-items: center;
    justify-content: space-around;
}

.navbarUl li:hover {
    cursor: pointer;
}

.home {
    display: flex;
    align-items: center;
    gap: 10px;
}

.home:hover {
    color: #F53003;
}

.tarefas:hover {
    color: #F53003;
}

.sobre {
    display: flex;
    align-items: center;
    gap: 10px;
}
.sobre:hover {
    color: #F53003;
}

.todasTarefas{
    display: flex;
    align-items: center;
    gap: 10px;
}

.todasTarefas:hover {
    color: #F53003;
}


</style>