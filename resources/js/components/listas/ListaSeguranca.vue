<template>
  <div class="container mt-4">
    <h3 class="mt-5 mb-4">Lista Autorizações</h3>
    <div class="form-group">
      <h5 class="mt-5 mb-4">Selecione a Unidade:</h5>
      <select class="form-control" v-model="selectedUnidade" @change="fetchAutorizacoes">
        <option value="">Selecione a Unidade</option>
        <option v-for="unidade in unidades" :key="unidade.id" :value="unidade.id">
          {{ unidade.edificio }} - Apartamento {{ unidade.apartamento }}
        </option>
      </select>
    </div>

    <!-- Tabela para exibir as autorizações -->
    <div v-if="autorizacoes.length > 0" class="mt-4">
      <h3 class="mt-5 mb-4">Autorizações da Unidade Selecionada</h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Morador</th>
            <th>Nível de Acesso</th>
            <th>Visitante</th>
            <th>Data Início</th>
            <th>Data Fim</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="autorizacao in autorizacoes" :key="autorizacao.id">
            <td>{{ autorizacao.id }}</td>
            <td>{{ autorizacao.morador.nome }}</td>
            <td>{{ autorizacao.nivel_acesso }}</td>
            <td>{{ autorizacao.visitante }}</td>
            <td>{{ autorizacao.data_inicio }}</td>
            <td>{{ autorizacao.data_fim }}</td>
            <td>
              <button class="btn btn-primary btn-sm" @click="editAutorizacao(autorizacao.id)">
                Editar
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Mensagem se nenhuma autorização for encontrada -->
    <div v-else-if="selectedUnidade" class="mt-4">
      <p class="alert alert-info">Nenhuma autorização encontrada para o morador selecionado.</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      unidades: [],
      autorizacoes: [],
      selectedUnidade: '',
    };
  },
  methods: {
    fetchUnidades() {
      axios.get('/api/unidades')
        .then(response => {
          this.unidades = response.data;
        })
        .catch(error => {
          console.error('Erro ao carregar unidades:', error);
        });
    },
    fetchAutorizacoes() {
      if (this.selectedUnidade) {
        axios.get(`/api/autorizacoes?unidade_id=${this.selectedUnidade}`)
          .then(response => {
            this.autorizacoes = response.data;
          })
          .catch(error => {
            console.error('Erro ao carregar autorizações:', error);
          });
      } else {
        this.autorizacoes = [];
      }
    },
    editAutorizacao(id) {
      this.$router.push({ name: 'EditAutorizacoes', params: { id: id } });
    },
  },
  mounted() {
    this.fetchUnidades();
  }
};
</script>