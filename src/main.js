import Vue from 'vue'
import App from './App.vue'
import store from './store'
import router from './router'
import vuetify from './plugins/vuetify';
import axios from 'axios'


new Vue({
  store,
  router,
  vuetify,
  axios,
  render: h => h(App),
  data: {
    test: 'test',
    auth: true
  }
}).$mount('#app')
