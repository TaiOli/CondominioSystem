<template>
    <div>
        <h3 class="mt-5 mb-4">Editar Autorização</h3>
        <form @submit.prevent="saveAutorizacao">
            <div class="form-group">
                <label for="morador_id">Morador</label>
                <select v-model="autorizacao.morador_id" class="form-control mb-3" id="morador_id" required>
                    <option v-for="morador in moradores" :key="morador.id" :value="morador.id">
                        {{ morador.nome }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="nivel_acesso">Nível de Acesso</label>
                <input type="text" v-model="autorizacao.nivel_acesso" class="form-control mb-3" id="nivel_acesso"
                    required>
            </div>
            <div class="form-group">
                <label for="visitante">Visitante</label>
                <input type="text" v-model="autorizacao.visitante" class="form-control mb-3" id="visitante" required>
            </div>
            <div class="form-group">
                <label for="data_inicio">Data Início</label>
                <input type="date" v-model="autorizacao.data_inicio" class="form-control mb-3" id="data_inicio"
                    required>
            </div>
            <div class="form-group">
                <label for="data_fim">Data Fim</label>
                <input type="date" v-model="autorizacao.data_fim" class="form-control" id="data_fim" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Salvar</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['id'],
    data() {
        return {
            autorizacao: {
                nivel_acesso: '',
                visitante: '',
                data_inicio: '',
                data_fim: '',
                morador_id: '',
            },
            moradores: [],
        };
    },
    methods: {
        fetchAutorizacao() {
            axios.get(`/api/autorizacoes/${this.id}`)
                .then(response => {
                    this.autorizacao = response.data;
                })
                .catch(error => {
                    console.error('Erro ao carregar autorização:', error.response.data);
                });
        },
        fetchMoradores() {
            axios.get('/api/moradores')
                .then(response => {
                    this.moradores = response.data;
                })
                .catch(error => {
                    console.error('Erro ao carregar moradores:', error.response.data);
                });
        },
        saveAutorizacao() {
            console.log('Dados para atualizar:', this.autorizacao);
            axios.put(`/api/autorizacoes/${this.id}`, this.autorizacao)
                .then(() => {
                    this.$router.push({ path: '/lista/seguranca' });
                })
                .catch(error => {
                    if (error.response) {
                        console.error('Erro ao salvar autorização:', error.response.data);
                    } else {
                        console.error('Erro desconhecido:', error.message);
                    }
                });
        }
    },
    mounted() {
        this.fetchAutorizacao();
        this.fetchMoradores();
    }
};
</script>