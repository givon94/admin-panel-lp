<template>
  <v-app id="inspire">
    <v-navigation-drawer
            v-model="drawer"
            v-if="auth"
            app
    >
      <v-list nav>
        <v-list-item link to="template">
          <v-list-item-action>
            <v-icon>mdi-home</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Шаблон</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item link to="seo">
          <v-list-item-action>
            <v-icon>mdi-clipboard-text</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>SEO</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item link to="/contacts">
          <v-list-item-action>
            <v-icon>mdi-email</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Контакты</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item link to="/code">
          <v-list-item-action>
            <v-icon>mdi-code-not-equal-variant</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Код</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

      </v-list>
    </v-navigation-drawer>

    <v-app-bar
            app
            color="indigo"
            dark
    >
      <v-app-bar-nav-icon
              @click.stop="drawer = !drawer"
              v-if="auth"
      ></v-app-bar-nav-icon>
      <router-link to="/" tag="span" class="pointer" style="font-size: 22px;">Панель администратора</router-link>

      <v-spacer></v-spacer>
      <v-toolbar-items class="hidden-sm-and-down">
        <v-btn
                text
                dark
                to="/login"
                v-if="!auth"

        >
          <v-icon left>mdi-lock</v-icon>
          Войти
        </v-btn>

        <v-btn
                @click="onLogout"
                text
                dark
                v-if="auth"

        >
          <v-icon left>mdi-exit-to-app</v-icon>
          Выйти
        </v-btn>
      </v-toolbar-items>


    </v-app-bar>
    <v-main style="padding: 50px;">
      <v-container
              class="fill-height"
              fluid
      >
        <v-content>
          <router-view></router-view>
        </v-content>
        <template v-if="success">
          <v-snackbar
                  color="success"
                  :multi-line="true"
                  :timeout="3000"
                  @input="closeSuccess"
                  :value="true"
          >
            {{ success }}
            <v-btn
                    dark
                    text
                    @click="snackbar = closeError"
            >
              Закрыть
            </v-btn>
          </v-snackbar>
        </template>
        <template v-if="error">
          <v-snackbar
                  color="error"
                  :multi-line="true"
                  :timeout="3000"
                  @input="closeError"
                  :value="true"
          >
            {{ error }}
            <v-btn
                    dark
                    text
                    @click="snackbar = closeError"
            >
              Закрыть
            </v-btn>
          </v-snackbar>
        </template>
      </v-container>
    </v-main>
    <v-footer
            color="indigo"
            app
    >
      <span class="white--text">&copy; {{ new Date().getFullYear() }}</span>
    </v-footer>
  </v-app>
</template>

<script>

  export default {
    props: {
      source: String,
    },
    data: () => ({
      drawer: null,
    }),
    computed: {
      error () {
        return this.$store.getters.error
      },
      success () {
        return this.$store.getters.success
      },
      auth () {
        return this.$store.getters.AUTH
      }
    },
    methods: {
      closeError () {
        this.$store.dispatch('clearError')
      },
      closeSuccess () {
        this.$store.dispatch('clearSuccess')
      },
      onLogout () {
        this.$store.dispatch('userLogout')
            .then(() => {
              this.$router.push('/')
            })
            .catch(() => {})
      }
    }
  }
</script>


<style scoped>
  .pointer {
    cursor: pointer;
    user-select: none;
  }

  .v-list-item * {
    border: none !important;
    text-decoration: none !important;
  }
</style>
