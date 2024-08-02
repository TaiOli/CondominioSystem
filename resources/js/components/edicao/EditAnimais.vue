<template>
  <div class="container mt-4">
    <h3 class="mt-5 mb-4">Editar Animal</h3>
    <form @submit.prevent="saveAnimal">
      <div class="form-group">
        <label for="tipo">Tipo</label>
        <input type="text" v-model="animal.tipo" class="form-control mb-3" id="tipo" required />
      </div>
      <div class="form-group">
        <label for="raca">Raça</label>
        <input type="text" v-model="animal.raca" class="form-control mb-3" id="raca" required />
      </div>
      <div class="form-group">
        <label for="idade">Idade</label>
        <input type="number" v-model="animal.idade" class="form-control mb-3" id="idade" required />
      </div>
      <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" v-model="animal.nome" class="form-control mb-3" id="nome" required />
      </div>
      <div class="form-group">
        <label for="unidade_id">Unidade</label>
        <select v-model="animal.unidade_id" class="form-control mb-3" id="unidade_id" required>
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
      animal: {},
      unidades: [],
    };
  },
  methods: {
    fetchAnimal() {
      axios.get(`/api/animais/${this.id}`)
        .then(response => {
          this.animal = response.data;
        })
        .catch(error => {
          console.error('Erro ao carregar animal:', error);
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
    saveAnimal() {
      axios.put(`/api/animais/${this.id}`, this.animal)
        .then(() => {
          this.$router.push({ path: '/lista/moradores' });
        })
        .catch(error => {
          if (error.response) {
            console.error('Erro ao salvar animal:', error.response.data);
          } else {
            console.error('Erro desconhecido:', error.message);
          }
        });
    }
  },
  mounted() {
    this.fetchAnimal();
    this.fetchUnidades();
  }
};
</script>