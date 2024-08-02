<template>
    <div>
        <h3 class="mt-5 mb-4">Editar Morador</h3>
        <form @submit.prevent="saveMorador">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" v-model="morador.nome" class="form-control mb-3" id="nome" required />
            </div>
            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento</label>
                <input type="date" v-model="morador.data_nascimento" class="form-control mb-3" id="data_nascimento" />
            </div>
            <div class="form-group">
                <label for="rg">RG</label>
                <input type="text" v-model="morador.rg" class="form-control mb-3" id="rg" />
            </div>
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" v-model="morador.cpf" class="form-control mb-3" id="cpf" required />
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" v-model="morador.telefone" class="form-control mb-3" id="telefone" />
            </div>
            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="text" v-model="morador.celular" class="form-control mb-3" id="celular" />
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" v-model="morador.email" class="form-control mb-3" id="email" />
            </div>
            <div class="form-group">
                <label for="unidade_id">Unidade</label>
                <select v-model="morador.unidade_id" class="form-control mb-3" id="unidade_id" required>
                    <option v-for="unidade in unidades" :key="unidade.id" :value="unidade.id">
                        {{ unidade.edificio }} - Apartamento {{ unidade.apartamento }}
                    </option>
                </select>
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
            morador: {},
            unidades: [],
        };
    },
    methods: {
        fetchMorador() {
            axios.get(`/api/moradores/${this.id}`)
                .then(response => {
                    this.morador = response.data;
                })
                .catch(error => {
                    console.error('Erro ao carregar morador:', error);
                });
        },
        fetchUnidades() {
            axios.get('/api/unidades')
                .then(response => {
                    this.unidades = response.data;
                })
                .catch(error => {
                    console.error('Erro ao carregar unidades:', error);
                });
        },
        saveMorador() {
            axios.put(`/api/moradores/${this.id}`, this.morador)
                .then(() => {
                    this.$router.push({ path: '/lista/moradores' });
                })
                .catch(error => {
                    if (error.response) {
                        console.error('Erro ao salvar morador:', error.response.data);
                    } else {
                        console.error('Erro desconhecido:', error.message);
                    }
                });
        }
    },
    mounted() {
        this.fetchMorador();
        this.fetchUnidades();
    }
}
</script>