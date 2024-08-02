<template>
  <div class="container mt-4">
    <h3 class="mt-5 mb-4">Lista Moradores</h3>
    <div class="form-group">
      <h5 for="unidade" class="mt-5 mb-4">Selecione a Unidade:</h5>
      <select class="form-control" v-model="selectedUnidade" @change="fetchData">
        <option value="">Selecione uma unidade</option>
        <option v-for="unidade in unidades" :key="unidade.id" :value="unidade.id">
          {{ unidade.edificio }} - Apartamento {{ unidade.apartamento }}
        </option>
      </select>
    </div>

    <!-- Tabela para exibir os moradores -->
    <div v-if="moradores.length > 0" class="mt-4">
      <h3>Moradores</h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Data de Nascimento</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="morador in moradores" :key="morador.id">
            <td>{{ morador.nome }}</td>
            <td>{{ morador.data_nascimento }}</td>
            <td>{{ morador.cpf }}</td>
            <td>{{ morador.telefone }}</td>
            <td>
              <button class="btn btn-primary btn-sm" @click="editMorador(morador)">
                Editar
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Mensagem se nenhum morador for encontrado -->
    <div v-if="noMoradores && selectedUnidade" class="mt-4">
      <p class="alert alert-info">Nenhum morador encontrado para a unidade selecionada.</p>
    </div>

    <!-- Tabela para exibir os veículos -->
    <div v-if="veiculos.length > 0" class="mt-4">
      <h3>Veículos</h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Ano</th>
            <th>Cor</th>
            <th>Placa</th>
            <th>Chassi</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="veiculo in veiculos" :key="veiculo.id">
            <td>{{ veiculo.marca }}</td>
            <td>{{ veiculo.modelo }}</td>
            <td>{{ veiculo.ano }}</td>
            <td>{{ veiculo.cor }}</td>
            <td>{{ veiculo.placa }}</td>
            <td>{{ veiculo.chassi }}</td>
            <td>
              <button class="btn btn-primary btn-sm" @click="editVeiculo(veiculo)">
                Editar
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Mensagem se nenhum veículo for encontrado -->
    <div v-if="noVeiculos && selectedUnidade" class="mt-4">
      <p class="alert alert-info">Nenhum veículo encontrado para a unidade selecionada.</p>
    </div>

    <!-- Tabela para exibir os animais -->
    <div v-if="animais.length > 0" class="mt-4">
      <h3>Animais</h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Tipo</th>
            <th>Raça</th>
            <th>Idade</th>
            <th>Nome</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="animal in animais" :key="animal.id">
            <td>{{ animal.tipo }}</td>
            <td>{{ animal.raca }}</td>
            <td>{{ animal.idade }}</td>
            <td>{{ animal.nome }}</td>
            <td>
              <button class="btn btn-primary btn-sm" @click="editAnimal(animal)">
                Editar
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Mensagem se nenhum animal for encontrado -->
    <div v-if="noAnimais && selectedUnidade" class="mt-4">
      <p class="alert alert-info">Nenhum animal encontrado para a unidade selecionada.</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      unidades: [],
      moradores: [],
      veiculos: [],
      animais: [],
      selectedUnidade: "",
      noMoradores: false,
      noVeiculos: false,
      noAnimais: false,
    };
  },
  methods: {
    fetchUnidades() {
      axios.get("/api/unidades")
        .then((response) => {
          this.unidades = response.data;
          console.log('Unidades carregadas:', this.unidades);
        })
        .catch(error => {
          console.error('Erro ao carregar unidades:', error);
        });
    },
    fetchData() {
      if (this.selectedUnidade) {
        axios.get(`/api/moradores?unidade_id=${this.selectedUnidade}`)
          .then((response) => {
            this.moradores = response.data;
            this.noMoradores = this.moradores.length === 0;
            console.log('Moradores carregados:', this.moradores);
          })
          .catch(error => {
            console.error('Erro ao carregar moradores:', error);
          });

        axios.get(`/api/veiculos?unidade_id=${this.selectedUnidade}`)
          .then((response) => {
            console.log('Veículos:', response.data);
            this.veiculos = response.data;
            this.noVeiculos = this.veiculos.length === 0;
            console.log('Veículos carregados:', this.veiculos);
          })
          .catch(error => {
            console.error('Erro ao carregar veículos:', error.response || error.message);
          });

        axios.get(`/api/animais?unidade_id=${this.selectedUnidade}`)
          .then((response) => {
            this.animais = response.data;
            this.noAnimais = this.animais.length === 0;
            console.log('Animais carregados:', this.animais);
          })
          .catch(error => {
            console.error('Erro ao carregar animais:', error.response || error.message);
          });
      } else {
        this.moradores = [];
        this.veiculos = [];
        this.animais = [];
        this.noMoradores = false;
        this.noVeiculos = false;
        this.noAnimais = false;
      }
    },
    editMorador(morador) {
      this.$router.push({ name: 'EditMoradores', params: { id: morador.id } });
    },
    editAnimal(animal) {
      this.$router.push({ name: 'EditAnimais', params: { id: animal.id } });
    },
    editVeiculo(veiculo) {
      this.$router.push({ name: 'EditVeiculos', params: { id: veiculo.id } });
    }
  },
  mounted() {
    this.fetchUnidades();
  },
};
</script>