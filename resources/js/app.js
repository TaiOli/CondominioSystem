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
// Listas
import ListaMoradores from './components/listas/ListaMoradores.vue';
import ListaSeguranca from './components/listas/ListaSeguranca.vue';
import ListaDocumentos from './components/listas/ListaDocumentos.vue';
// Edição
import EditAutorizacoes from './components/edicao/EditAutorizacoes.vue';
import EditDocumentos from './components/edicao/EditDocumentos.vue';
import EditMoradores from './components/edicao/EditMoradores.vue';
import EditAnimais from './components/edicao/EditAnimais.vue';
import EditVeiculos from './components/edicao/EditVeiculos.vue';

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

        // Tela de Lista de moradores
        { path: '/lista/moradores', component: ListaMoradores },
        // Tela de Lista de moradores
        { path: '/lista/seguranca', name: 'Seguranca', component: ListaSeguranca },
        // Tela de Lista de moradores
        { path: '/lista/documentos', component: ListaDocumentos },

        // Tela de edicao
        { path: '/edit-autorizacao/:id', name: 'EditAutorizacoes', component: EditAutorizacoes, props: true },
        { path: '/edit-documento/:id', name: 'EditDocumentos', component: EditDocumentos, props: true },
        { path: '/edit-morador/:id', name: 'EditMoradores', component: EditMoradores, props: true },
        { path: '/edit-animais/:id', name: 'EditAnimais', component: EditAnimais, props: true },
        { path: '/edit-veiculos/:id', name: 'EditVeiculos', component: EditVeiculos, props: true }
    ]  
});

const app = createApp(App);
app.use(router);
app.mount('#app');