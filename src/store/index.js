import  Vue from 'vue'
import  Vuex from 'vuex'
import shared from './shared'
import user from './user'
import findings from './findings'
import backups from './backups'

Vue.use(Vuex)





export default new Vuex.Store({
    modules: {
        user,
        findings,
        backups,
        shared
    }
})

