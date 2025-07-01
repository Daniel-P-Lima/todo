import { createRouter, createWebHistory } from 'vue-router'
import Home from './components/Home.vue';
import CadastrarTarefa from './components/CadastrarTarefa.vue';
import Sobre from './components/Sobre.vue';
import TodasTarefas from './components/TodasTarefas.vue';

const routes = [
  { path: '/', component: Home },
  { path: '/cadastrarTarefa', component: CadastrarTarefa },
  { path: '/sobre', component: Sobre},
  { path: '/todasTarefas', component: TodasTarefas}
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
