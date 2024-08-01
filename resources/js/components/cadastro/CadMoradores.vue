<template>
    <div class="container cadcontainer">
      <h3 class="mt-5">Cadastro de Moradores</h3>
      <form @submit.prevent="submitForm">
  
        <div class="mb-3 mt-4">
          <label for="nome" class="form-label">Nome Completo</label>
          <input type="text" id="nome" v-model="form.nome" class="form-control" required>
        </div>
  
        <div class="mb-3">
          <label for="dataNascimento" class="form-label">Data de Nascimento</label>
          <input type="date" id="dataNascimento" v-model="form.dataNascimento" class="form-control">
        </div>
  
        <div class="mb-3">
          <label for="rg" class="form-label">RG</label>
          <input type="text" id="rg" v-model="form.rg" class="form-control" placeholder="00.000.000-0">
        </div>
  
        <div class="mb-3">
          <label for="cpf" class="form-label">CPF</label>
          <input type="text" id="cpf" v-model="form.cpf" class="form-control" placeholder="000.000.000-00" required>
        </div>
  
        <!-- Contatos -->
        <h3 class="mt-5">Contatos</h3>
  
        <div class="mb-3">
          <label for="telefone" class="form-label mt-4">Telefone</label>
          <input type="tel" id="telefone" v-model="form.telefone" class="form-control" placeholder="(00) 0000-0000">
        </div>
  
        <div class="mb-3">
          <label for="celular" class="form-label">Celular</label>
          <input type="tel" id="celular" v-model="form.celular" class="form-control" placeholder="(00) 00000-0000" required>
        </div>
  
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" id="email" v-model="form.email" class="form-control" placeholder="exemplo@dominio.com">
        </div>
  
        <div class="mb-3">
          <label for="unidade" class="form-label">Unidade</label>
          <select id="unidade" v-model="form.unidade_id" class="form-control" required>
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
          nome: '',
          dataNascimento: '',
          rg: '',
          cpf: '',
          telefone: '',
          celular: '',
          email: '',
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
    // Remove caracteres não numéricos
    methods: {
      formatCpf(cpf) {
        return cpf.replace(/[^\d]+/g, ''); 
      },
      formatTelefone(telefone) {
        return telefone.replace(/[^\d]+/g, ''); 
      },
      formatCelular(celular) {
        return celular.replace(/[^\d]+/g, '');
      },
      validateCpf(cpf) {
        return cpf.length === 11;
      },
      async submitForm() {
        // Formata CPF, telefone e celular
        this.form.cpf = this.formatCpf(this.form.cpf);
        this.form.telefone = this.formatTelefone(this.form.telefone);
        this.form.celular = this.formatCelular(this.form.celular);
  
        if (!this.validateCpf(this.form.cpf)) {
          this.errorMessage = 'O CPF deve ter exatamente 11 dígitos.';
          return;
        }
  
        try {
          const response = await axios.post('/api/moradores', this.form);
          this.successMessage = 'Morador cadastrado com sucesso!';
          this.errorMessage = '';
          // Limpar o formulário 
          this.form = {
            nome: '',
            dataNascimento: '',
            rg: '',
            cpf: '',
            telefone: '',
            celular: '',
            email: '',
            unidade_id: null
          };
        } catch (error) {
          this.errorMessage = 'Ocorreu um erro ao cadastrar o morador.';
          this.successMessage = '';
        }
      }
    }
  };
</script>