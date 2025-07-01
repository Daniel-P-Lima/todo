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
            Home
        </li>
        <li class="todasTarefas" @click="goToTodasTarefas">
            Todas Tarefas
        </li>
        <li class="sobre" @click="goToSobre">
            Sobre
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

.home:hover {
    color: #F53003;
}

.tarefas:hover {
    color: #F53003;
}

.sobre:hover {
    color: #F53003;
}

.todasTarefas:hover {
    color: #F53003;
}
</style>