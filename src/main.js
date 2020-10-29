import Vue from 'vue'
import App from './App.vue'
import store from './store'
import router from './router'
import vuetify from './plugins/vuetify';
import "./plugins/vuetify-mask.js";

import axios from 'axios'



new Vue({
  store,
  router,
  vuetify,
  axios,
  render: h => h(App),
}).$mount('#app')



// Vue.directive('input-mask', {
//   bind: function(el) {
//     new Inputmask().mask(el);
//   },
// });
