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

        <v-list-group
                prepend-icon="mdi-file-document"
                no-action
        >
          <template v-slot:activator>
            <v-list-item-content>
              <v-list-item-title>Страницы</v-list-item-title>
            </v-list-item-content>
          </template>

          <v-list-item
                  v-for="link of results.meta"
                  :key="link.title"
                  :to="'/pages/' +link.page"
          >
            <v-list-item-content>
              <v-list-item-title v-text="link.page"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-group>

        <v-list-item link>
          <v-list-item-action>
            <v-icon>mdi-home</v-icon>
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
                @click="onlogout"
                text
                dark
                v-if="auth"

        >
          <v-icon left>mdi-exit-to-app</v-icon>
          Выйти
        </v-btn>
      </v-toolbar-items>


    </v-app-bar>
    <v-main>
      <v-container
              class="fill-height"
              fluid
      >
        <v-content>
          <router-view></router-view>
        </v-content>
<!--        <template v-if="error">-->
<!--          <v-snackbar-->
<!--                  color="error"-->
<!--                  :multi-line="true"-->
<!--                  :timeout="5000"-->
<!--                  @input="closeError"-->
<!--                  :value="true"-->
<!--          >-->
<!--            {{ error }}-->
<!--            <v-btn-->
<!--                    dark-->
<!--                    text-->
<!--                    @click="snackbar = closeError"-->
<!--            >-->
<!--              Close-->
<!--            </v-btn>-->
<!--          </v-snackbar>-->
<!--        </template>-->
      </v-container>
    </v-main>
    <v-footer
            color="indigo"
            app
    >
  <span style="margin-right: 20px;">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 180.43 36" width="150.358" height="30">
        <path fill="#39c3de" d="M29.38 19.69L17.11 2.02 13.55 15.7l15.83 3.99z"></path>
        <path fill="#00a3dc" d="M0 0l17.11 2.02-3.99 15.77-6.07-8.28L0 0z"></path>
        <path fill="#0081c7" d="M0 3.19l2.08-.31 5.4 7.24L0 3.19z"></path>
        <path fill="#3cc4e0" d="M13.12 17.79l2.21 9.69v2.51L7.48 36l5.64-18.21z"></path>
        <path fill="#00a4da" d="M29.38 19.69l-14.05 7.79-2.21-9.69.5-2.03 15.76 3.93z"></path>
        <path fill="#50c3df" d="M28.76 21.89l.62-2.2-14.05 7.79 13.43-5.59z"></path>
        <path fill="#00aad4" d="M32.87 11.22l-8.52 1.23 5.03 7.24 3.49-8.47z"></path>
        <path fill="#0084bf" d="M36.31 15.03l-3.44-3.81-1.53 3.81h4.97z"></path>
        <path d="M57.22 12A7.61 7.61 0 0155 17.85c-1.47 1.41-3.62 2.08-6.38 2.08h-1.76v7.55h-6.14V4.78h7.85c2.88 0 5 .62 6.44 1.9A6.81 6.81 0 0157.22 12zm-10.36 3H48a3 3 0 002.21-.79A2.74 2.74 0 0051 12c0-1.53-.85-2.27-2.57-2.27h-1.6V15zM67 19.2v8.28h-6.16V4.78h7.42c6.19 0 9.26 2.21 9.26 6.69 0 2.64-1.29 4.66-3.86 6.13l6.68 9.88h-6.93l-4.84-8.28zm0-4.6h1.17c2.14 0 3.19-.92 3.19-2.82 0-1.6-1-2.34-3.13-2.34H67z" fill="#fff"></path>
        <path d="M96.29 27.48l-1.11-4.24h-7.36l-1.16 4.24h-6.75l7.42-22.82h8.22L103 27.48zm-2.4-9.33l-1-3.74c-.24-.86-.49-1.9-.86-3.19S91.5 9 91.38 8.4c-.12.55-.31 1.41-.55 2.64S90 14.66 89 18.21h4.9zM114.62 14.17h9.82v12.26a26.59 26.59 0 01-8.77 1.35c-3.5 0-6.2-1-8.1-3.06s-2.88-4.91-2.88-8.71 1-6.5 3.13-8.59 5-3.07 8.77-3.07a17.68 17.68 0 014 .43 14.27 14.27 0 013.32 1l-2 4.84a12.16 12.16 0 00-5.39-1.23 5 5 0 00-4.17 1.78 7.47 7.47 0 00-1.48 5 7.38 7.38 0 001.42 4.83 4.65 4.65 0 003.81 1.65 10.81 10.81 0 002.51-.24v-3.52h-4v-4.72zM138.91 27.48l-4.6-16.38h-.12c.24 2.76.3 5 .3 6.5v9.88H129V4.78h8.15l4.72 16.13h.13l4.7-16.13h8.22v22.7h-5.65V15.82c0-.61.07-2.21.19-4.66h-.12l-4.6 16.32zM173.74 27.48l-1.1-4.24h-7.36l-1.16 4.24h-6.75l7.42-22.82H173l7.48 22.82zm-2.39-9.33l-1-3.74c-.24-.86-.49-1.9-.86-3.19S169 9 168.84 8.4c-.12.55-.31 1.41-.55 2.64s-.86 3.62-1.84 7.17h4.9z" fill="#fff"></path>
        </svg>
      </span>
      <span class="white--text">&copy; {{ new Date().getFullYear() }}</span>
    </v-footer>
  </v-app>
</template>

<script>
  const url = "test.json";
  const axios = require('axios');



  export default {
    props: {
      source: String,
    },
    data: () => ({
      drawer: null,
      results: [],
      auth: true
    }),
    mounted() {
      axios.get(url).then(response => {
        this.results = response.data
      })
    },
    methods: {
      saveJson(){
        axios.post('api/savePage.php', {jsonResult: this.results})
          .then(console.log('work'))
          .catch(console.log('error'))
      },
      onlogout(){
        axios
          .get('./api/logout.php')
          .then(res => {
            if(this.auth === res.data.logout) {
              window.location.replace('/');
            }
            // console.log(res.data);
          })
      },
    }
  }
</script>


<style scoped>
  .pointer {
    cursor: pointer;
    user-select: none;
  }
</style>
