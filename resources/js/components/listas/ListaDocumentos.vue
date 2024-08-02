<template>
    <div class="container mt-4">
      <h3 class="mt-5 mb-4">Lista Documentos</h3>
      <div class="form-group">
        <h5 for="morador" class="mt-5 mb-4">Selecione o Morador:</h5>
        <select class="form-control" v-model="selectedMorador" @change="fetchDocumentos">
          <option value="">Selecione o Morador</option>
          <option v-for="morador in moradores" :key="morador.id" :value="morador.id">
            {{ morador.nome }}
          </option>
        </select>
      </div>
  
      <!-- Tabela para exibir os Documentos -->
      <div v-if="documentos.length > 0" class="mt-4">
        <h4 class="mt-5 mb-4">Documentos do Morador Selecionado</h4>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tipo Documento</th>
              <th>Descrição</th>
              <th>Data Emissão</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="documento in documentos" :key="documento.id">
              <td>{{ documento.id }}</td>
              <td>{{ documento.tipo_documento }}</td>
              <td>{{ documento.descricao }}</td>
              <td>{{ documento.data_emissao }}</td>
              <td>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <!-- Mensagem se nenhum documento for encontrado -->
      <div v-else-if="selectedDocumento" class="mt-4">
        <p class="alert alert-info">Nenhum documento encontrado para o morador selecionado.</p>
      </div>
    </div>
</template>
  
<script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        moradores: [], 
        documentos: [], 
        selectedMorador: '',
      };
    },
    methods: {
      fetchMoradores() {
        axios.get('/api/moradores')
          .then(response => {
            this.moradores = response.data;
          })
          .catch(error => {
            console.error('Erro ao carregar moradores:', error);
          });
      },
      fetchDocumentos() {
        if (this.selectedMorador) {
          axios.get(`/api/documentos?morador_id=${this.selectedMorador}`)
            .then(response => {
              this.documentos = response.data;
            })
            .catch(error => {
              console.error('Erro ao carregar os documentos:', error);
            });
        } else {
          this.documentos = [];
        }
      }
    },
    mounted() {
      this.fetchMoradores(); 
    }
  };
</script>