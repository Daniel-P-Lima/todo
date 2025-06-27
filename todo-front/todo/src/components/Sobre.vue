<template>
    <h1>
        Sobre
    </h1>
    <div>
        Esse aplicativo é alimentado utilizando <i>Laravel</i> como back-end e <i>Vue</i> como front-end. <br>
        As informações são recebidas via API e todos os dados estão em um banco local
    </div>

    <div>
        <h3>Documentação</h3>
        <ul class="documentacao">
            <li class="laravel">
                <a href="https://laravel.com/" target="_blank">
                    <img class="laravelLogo" src="../assets/laravel_logo.png" alt="Imagem do laravel">Laravel
                </a>
            </li>

            <li class="vue">
                <a href="https://vuejs.org/" target="_blank">
                    <img class="vueLogo" src="../assets/vue_logo.png" alt="">
                    Vue.js
                </a>
            </li>
        </ul>
    </div>
</template>

<style>

.documentacao { 
    list-style: none;
}
.documentacao li {
    margin-bottom: 10px;
    display: flex;
    align-items: center;
}
.documentacao li a{
    width: 10vh;
    color: black;
    text-decoration: none;

}
.laravel a{
    display: flex;
    align-items: center;
}
.laravel a:hover {
    color: #F53003;;
}
.laravelLogo{
    width: 25px;
}

.vueLogo {
    width: 25px;
}

.vue a {
    display: flex;
    align-items: center;
}

.vue a:hover {
    color: #33A06F
}
</style>