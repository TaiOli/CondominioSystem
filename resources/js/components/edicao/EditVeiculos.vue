<template>
    <div class="container mt-4">
        <h3 class="mt-5 mb-4">Editar Veículo</h3>
        <form @submit.prevent="saveVeiculo">
            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text" v-model="veiculo.marca" class="form-control mb-3" id="marca" required />
            </div>
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" v-model="veiculo.modelo" class="form-control mb-3" id="modelo" required />
            </div>
            <div class="form-group">
                <label for="ano">Ano</label>
                <input type="number" v-model="veiculo.ano" class="form-control mb-3" id="ano" required />
            </div>
            <div class="form-group">
                <label for="cor">Cor</label>
                <input type="text" v-model="veiculo.cor" class="form-control mb-3" id="cor" required />
            </div>
            <div class="form-group">
                <label for="placa">Placa</label>
                <input type="text" v-model="veiculo.placa" class="form-control mb-3" id="placa" required />
            </div>
            <div class="form-group">
                <label for="chassi">Chassi</label>
                <input type="text" v-model="veiculo.chassi" class="form-control mb-3" id="chassi" required />
            </div>
            <div class="form-group">
                <label for="unidade_id">Unidade</label>
                <select v-model="veiculo.unidade_id" class="form-control mb-3" id="unidade_id" required>
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
            veiculo: {},
            unidades: [],
        };
    },
    methods: {
        fetchVeiculo() {
            axios.get(`/api/veiculos/${this.id}`)
                .then(response => {
                    this.veiculo = response.data;
                })
                .catch(error => {
                    console.error('Erro ao carregar veículo:', error);
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
        saveVeiculo() {
            axios.put(`/api/veiculos/${this.id}`, this.veiculo)
                .then(() => {
                    this.$router.push({ path: '/lista/moradores' });
                })
                .catch(error => {
                    if (error.response) {
                        console.error('Erro ao salvar veículo:', error.response.data);
                    } else {
                        console.error('Erro desconhecido:', error.message);
                    }
                });
        }
    },
    mounted() {
        this.fetchVeiculo();
        this.fetchUnidades();
    }
};
</script>