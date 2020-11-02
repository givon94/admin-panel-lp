<template>
  <v-app id="inspire">
    <v-navigation-drawer
            v-model="drawer"
            app
    >
      <v-list nav>
        <v-list-item
                v-for="link of links"
                :key="link.title"
                :to="link.url"
        >
          <v-list-item-action>
            <v-icon>{{ link.icon }}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title v-text="link.title"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-divider v-if="auth"></v-divider>

        <v-list-item
                @click="onLogout"
                v-if="auth"
        >
          <v-list-item-icon>
            <v-icon>mdi-exit-to-app</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title v-text="'Выйти'"></v-list-item-title>
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
        <v-main>
          <router-view></router-view>
        </v-main>
        <template v-if="success">
          <v-snackbar
                  color="success"
                  :multi-line="true"
                  :timeout="3000"
                  @input="closeSuccess"
                  :value="true"
          >
            {{ success }}
            <v-btn dark text @click.native="closeSuccess">Закрыть</v-btn>
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
            <v-btn dark text @click.native="closeError">Закрыть</v-btn>
          </v-snackbar>
        </template>
      </v-container>
    </v-main>
    <v-footer
            class="pa-4"
            color="indigo"
            app
    >
      <span class="white--text">&copy; {{ new Date().getFullYear() }}</span>
    </v-footer>
  </v-app>
</template>

<script>

  const Axios = require('axios');

  export default {
    created() {
      Axios.get('./api/checkAuth.php')
          .then(res => {
            this.$store.dispatch('autoLoginUser', res.data.auth)
          })
    },
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
      },
      links () {
        if (this.auth) {
          return [
            {title: 'Резервные копии', icon: 'mdi-cog', url: '/backup'},
            {title: 'Шаблон', icon: 'mdi-home', url: '/template'},
            {title: 'SEO', icon: 'mdi-clipboard-text', url: '/seo'},
            {title: 'Контакты', icon: 'mdi-email', url: '/contacts'},
            {title: 'Скрипты', icon: 'mdi-code-not-equal-variant', url: '/code'},
          ]
        } else {
          return [
            {title: 'Войти', icon: 'mdi-lock', url: '/login'},
          ]
        }
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
</style>
