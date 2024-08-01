<template>
    <div class="container cadcontainer">
      <h3 class="mt-5">Cadastro de Autorização</h3>
      <form @submit.prevent="submitForm">
        <div class="mb-3 mt-4">
          <label for="nivel_acesso" class="form-label">Nível de Acesso</label>
          <input type="text" id="nivel_acesso" v-model="form.nivel_acesso" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="visitante" class="form-label">Visitante</label>
          <input type="text" id="visitante" v-model="form.visitante" class="form-control" required>
        </div>
  
        <div class="mb-3">
          <label for="data_inicio" class="form-label">Data de Início</label>
          <input type="date" id="data_inicio" v-model="form.data_inicio" class="form-control" required>
        </div>
  
        <div class="mb-3">
          <label for="data_fim" class="form-label">Data de Fim</label>
          <input type="date" id="data_fim" v-model="form.data_fim" class="form-control" required>
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
          nivel_acesso: '',
          visitante: '',
          data_inicio: '',
          data_fim: '',
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
          const response = await axios.post('/api/autorizacoes', this.form);
          this.successMessage = 'Autorização cadastrada com sucesso!';
          this.errorMessage = '';
          // Limpar o formulário
          this.form = {
            nivel_acesso: '',
            visitante: '',
            data_inicio: '',
            data_fim: '',
            morador_id: null,
          };
        } catch (error) {
          this.errorMessage = 'Ocorreu um erro ao cadastrar a autorização. ' + (error.response.data.message || '');
          this.successMessage = '';
        }
      }
    }
  };
</script>  