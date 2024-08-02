<template>
  <div>
    <h3 class="mt-5 mb-4">Editar Documento</h3>
    <form @submit.prevent="saveDocumento">
      <div class="form-group">
        <label for="tipo_documento">Tipo de Documento</label>
        <input type="text" v-model="documento.tipo_documento" class="form-control mb-3" id="tipo_documento" required />
      </div>
      <div class="form-group">
        <label for="descricao">Descrição</label>
        <textarea v-model="documento.descricao" class="form-control mb-3" id="descricao"></textarea>
      </div>
      <div class="form-group">
        <label for="data_emissao">Data de Emissão</label>
        <input type="date" v-model="documento.data_emissao" class="form-control mb-3" id="data_emissao" />
      </div>
      <div class="form-group">
        <label for="morador_id">Morador</label>
        <select v-model="documento.morador_id" class="form-control mb-3" id="morador_id" required>
          <option v-for="morador in moradores" :key="morador.id" :value="morador.id">
            {{ morador.nome }}
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
      documento: {},
      moradores: [],
    };
  },
  methods: {
    fetchDocumento() {
      axios.get(`/api/documentos/${this.id}`)
        .then(response => {
          this.documento = response.data;
        })
        .catch(error => {
          console.error('Erro ao carregar documento:', error);
        });
    },
    fetchMoradores() {
      axios.get('/api/moradores')
        .then(response => {
          this.moradores = response.data;
        })
        .catch(error => {
          console.error('Erro ao carregar moradores:', error);
        });
    },
    saveDocumento() {
      axios.put(`/api/documentos/${this.id}`, this.documento)
        .then(() => {
          this.$router.push({ path: '/lista/seguranca' });
        })
        .catch(error => {
          if (error.response) {
            console.error('Erro ao salvar documento:', error.response.data);
          } else {
            console.error('Erro desconhecido:', error.message);
          }
        });
    }
  },
  mounted() {
    this.fetchDocumento();
    this.fetchMoradores();
  }
};
</script>