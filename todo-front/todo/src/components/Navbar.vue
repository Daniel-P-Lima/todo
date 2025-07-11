<script lang="ts">
    import Drawer from 'primevue/drawer';
    import Button from 'primevue/button';

    export default {
        data() {
            return {
                visible: true
            }
        },
        components: {
            Drawer,
            Button
        },
        methods: {
            goToHome() {
                this.$router.push('/');
                this.visible = false;
            },
            goToSobre() {
                this.$router.push('/sobre')
                this.visible = false;
            }, 
            goToTodasTarefas() {
                this.$router.push('/todasTarefas')
                this.visible = false;
            }
        }
    }
</script>


<template>
    <div class="navBar">
        <Button class="botaoMenu" @click="visible = true" label="Menu"/>
        <Drawer v-model:visible="visible" header="Menu">
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
        </Drawer>
    </div>
</template>

<style scoped>
.botaoMenu {
    background: #F53003;
}

.botaoMenu:hover {
    --p-button-primary-hover-background: #ca2302;
}
.navbarUl {
    list-style: none;
    display: flex;
    flex-direction: column;
    padding-left: 0;
    gap: 20px;
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