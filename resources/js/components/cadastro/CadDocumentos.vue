<template>
    <div class="container cadcontainer">
      <h3 class="mt-5">Cadastro de Documento</h3>
      <form @submit.prevent="submitForm">
        <div class="mb-3 mt-4">
          <label for="tipo_documento" class="form-label">Tipo de Documento</label>
          <input type="text" id="tipo_documento" v-model="form.tipo_documento" class="form-control" required>
        </div>
  
        <div class="mb-3">
          <label for="descricao" class="form-label">Descrição</label>
          <textarea id="descricao" v-model="form.descricao" class="form-control"></textarea>
        </div>
  
        <div class="mb-3">
          <label for="data_emissao" class="form-label">Data de Emissão</label>
          <input type="date" id="data_emissao" v-model="form.data_emissao" class="form-control">
        </div>
  
        <div class="mb-3">
          <label for="morador" class="form-label">Morador</label>
          <select id="morador" v-model="form.morador_id" class="form-control" required>
            <option disabled value="">Selecione um morador</option>
            <option v-for="morador in moradores" :key="morador.id" :value="morador.id">
              {{ morador.nome }}
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
          tipo_documento: '',
          descricao: '',
          data_emissao: '',
          morador_id: null,
        },
        moradores: [],
        errorMessage: '',
        successMessage: ''
      };
    },
    async created() {
      try {
        const response = await axios.get('/api/moradores');
        this.moradores = response.data;
      } catch (error) {
        this.errorMessage = 'Não foi possível carregar os moradores.';
      }
    },
    methods: {
      async submitForm() {
        try {
          const response = await axios.post('/api/documentos', this.form);
          this.successMessage = 'Documento cadastrado com sucesso!';
          this.errorMessage = '';
          // Limpar o formulário
          this.form = {
            tipo_documento: '',
            descricao: '',
            data_emissao: '',
            morador_id: null,
          };
        } catch (error) {
          this.errorMessage = 'Ocorreu um erro ao cadastrar o documento.';
          this.successMessage = '';
        }
      }
    }
  };
</script>