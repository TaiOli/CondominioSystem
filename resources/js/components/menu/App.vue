<template>
    <div class="container-fluid">
      <div class="row">
        <!-- Menu Lateral -->
        <nav id="menu_lateral" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
          <div class="position-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <router-link to="/" class="nav-link active mt-4">
                  Início
                </router-link>
              </li>
              <li class="nav-item">
                <a href="#" @click.prevent="toggleCadastro" class="nav-link">
                  Cadastro
                </a>
                <ul v-if="showCadastroMenu" class="nav flex-column ms-3">
                  <li class="nav-item">
                    <router-link to="/cadastro/moradores" class="nav-link">
                      Moradores
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link to="/cadastro/veiculos" class="nav-link">
                      Veículos
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link to="/cadastro/animais" class="nav-link">
                      Animais
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link to="/cadastro/documentos" class="nav-link">
                      Documentos
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link to="/cadastro/seguranca" class="nav-link">
                      Segurança
                    </router-link>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
  
        <!-- Conteúdo Principal -->
        <main role="main" class="col-md-9 ms-sm-auto col-lg-10 px-4">
          <router-view></router-view>
        </main>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'App',
    data() {
      return {
        showCadastroMenu: false,
        showGestaoCadastroMenu: false
      };
    },
    methods: {
      toggleCadastro() {
        this.showCadastroMenu = !this.showCadastroMenu;
      },
  
      toggleGestaoCadastro() {
        this.showGestaoCadastroMenu = !this.showGestaoCadastroMenu;
      }
    }
  }
</script>