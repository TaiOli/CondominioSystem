<template>
    <div class="container cadcontainer">
      <h3 class="mt-5">Cadastro de Animal</h3>
      <form @submit.prevent="submitForm">
        <div class="mb-3 mt-4">
          <label for="tipo" class="form-label">Tipo de Animal</label>
          <input type="text" id="tipo" v-model="form.tipo" class="form-control">
        </div>
  
        <div class="mb-3">
          <label for="raca" class="form-label">Raça</label>
          <input type="text" id="raca" v-model="form.raca" class="form-control">
        </div>
  
        <div class="mb-3">
          <label for="idade" class="form-label">Idade</label>
          <input type="number" id="idade" v-model="form.idade" class="form-control">
        </div>
  
        <div class="mb-3">
          <label for="nome" class="form-label">Nome</label>
          <input type="text" id="nome" v-model="form.nome" class="form-control">
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
          tipo: '',
          raca: '',
          idade: '',
          nome: '',
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
          const response = await axios.post('/api/animais', this.form);
          this.successMessage = 'Animal cadastrado com sucesso!';
          this.errorMessage = '';
          // Limpar o formulário
          this.form = {
            tipo: '',
            raca: '',
            idade: '',
            nome: '',
            unidade_id: null
          };
        } catch (error) {
          this.errorMessage = 'Ocorreu um erro ao cadastrar o animal.';
          this.successMessage = '';
        }
      }
    }
  };
</script>