<template>
    <div class="container cadcontainer">
      <h3 class="mt-5">Cadastro de Veículo</h3>
      <form @submit.prevent="submitForm">
        <div class="mb-3  mt-4">
          <label for="marca" class="form-label">Marca</label>
          <input type="text" id="marca" v-model="form.marca" class="form-control">
        </div>
  
        <div class="mb-3">
          <label for="modelo" class="form-label">Modelo</label>
          <input type="text" id="modelo" v-model="form.modelo" class="form-control">
        </div>
  
        <div class="mb-3">
          <label for="ano" class="form-label">Ano</label>
          <input type="text" id="ano" v-model="form.ano" class="form-control">
        </div>
  
        <div class="mb-3">
          <label for="cor" class="form-label">Cor</label>
          <input type="text" id="cor" v-model="form.cor" class="form-control">
        </div>
  
        <div class="mb-3">
          <label for="placa" class="form-label">Placa</label>
          <input type="text" id="placa" v-model="form.placa" class="form-control">
        </div>
  
        <div class="mb-3">
          <label for="chassi" class="form-label">Chassi</label>
          <input type="text" id="chassi" v-model="form.chassi" class="form-control">
        </div>

        <div class="mb-3">
        <label for="unidade" class="form-label">Unidade</label>
        <select id="unidade" v-model="form.unidade_id" class="form-control">
          <option disabled value="">Selecione uma unidade</option>
          <option v-for="unidade in unidades" :key="unidade.id" :value="unidade.id">
            {{ unidade.edificio }} - Apartamento {{ unidade.apartamento }}
          </option>
        </select>
      </div>
  
        <button type="submit" class="btn btn-primary">Salvar</button>
      </form>
      <div v-if="errorMessage" class="alert alert-danger mt-3">{{ errorMessage }}</div>
      <div v-if="successMessage" class="alert alert-success mt-3">{{ successMessage }}</div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        form: {
          marca: '',
          modelo: '',
          ano: '',
          cor: '',
          placa: '',
          chassi: '',
          unidade_id: null
        },
        unidades: [],
        errorMessage: '',
        successMessage: ''
      };
    },
    async created() {
    try {
      const response = await axios.get('/api/unidades');
      this.unidades = response.data;
    } catch (error) {
      this.errorMessage = 'Não foi possível carregar as unidades.';
    }
  },
    methods: {
      async submitForm() {
        try {
          const response = await axios.post('/api/veiculos', this.form);
          this.successMessage = 'Veículo cadastrado com sucesso!';
          this.errorMessage = '';
          // Limpar o formulário 
          this.form = {
            marca: '',
            modelo: '',
            ano: '',
            cor: '',
            placa: '',
            chassi: ''
          };
        } catch (error) {
          this.errorMessage = 'Ocorreu um erro ao cadastrar o veículo.';
          this.successMessage = '';
        }
      }
    }
  };
</script>  