import { createRouter, createWebHistory } from 'vue-router'
import Home from './components/Home.vue';
import CadastrarTarefa from './components/CadastrarTarefa.vue';
import Sobre from './components/Sobre.vue';

const routes = [
  { path: '/', component: Home },
  { path: '/cadastrarTarefa', component: CadastrarTarefa },
  { path: '/sobre', component: Sobre}
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
