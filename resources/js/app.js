import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import '../css/app.css';

// Menu lateral
import App from './components/menu/App.vue';
// Página inicial
import Home from './components/home/Home.vue';
// Cadastros
import CadMoradores from './components/cadastro/CadMoradores.vue';
import CadVeiculos from './components/cadastro/CadVeiculos.vue';
import CadAnimais from './components/cadastro/CadAnimais.vue';
import CadDocumentos from './components/cadastro/CadDocumentos.vue';
import CadSeguranca from './components/cadastro/CadAutorizacoes.vue';

// Rotas de navegação
const router = createRouter({
    history: createWebHistory(),
    routes: [
        // Tela de Início
        { path: '/', component: Home },
        // Tela de Cadastro de moradores
        { path: '/cadastro/moradores', component: CadMoradores },
        // Tela de Cadastro de veiculos
        { path: '/cadastro/veiculos', component: CadVeiculos },
        // Tela de Cadastro de animais
        { path: '/cadastro/animais', component: CadAnimais },
        // Tela de Cadastro de documentos
        { path: '/cadastro/documentos', component: CadDocumentos },
        // Tela de Cadastro de autorizacoes
        { path: '/cadastro/seguranca', component: CadSeguranca },
    ]
});

const app = createApp(App);
app.use(router);
app.mount('#app');