import  Vue from 'vue'
import  Vuex from 'vuex'

Vue.use(Vuex)
const dataBase = "test2.json";
import Axios from 'axios';




export default new Vuex.Store({
    state: {
        auth: false,
        findings: []
    },
    getters: {
        AUTH : state => {
            return state.auth
        }
    },
    actions: {
        loadFindings ({ commit }) {
            Axios
                .get(dataBase)
                .then(r => r.data)
                .then(findings => {
                    commit('SET_FINDINGS', findings)
                })
        },
        saveFindings ({ commit }) {
            Axios
                .post('api/savePage.php')
                .then(r => r.data)
                .then(findings => {
                    commit('ADD_FINDINGS', findings)
                })
        },
        userLogout ({ commit }) {
            Axios
                .post('api/logout.php')
                .then(r => r.data.logout)
                .then(auth => {
                    commit('USER_LOGOUT', auth)
                })
        },
        userLogin ({ commit }, password) {
            Axios
                .post('api/login.php',{'password': password})
                .then(res => {
                    if(res.data.auth === true){
                        commit('USER_LOGIN', res.data.auth)
                        this.$router.push('/')
                    } else {
                        console.log('Произошла ошибка')
                    }
                })
        },
    },
    mutations: {
        SET_FINDINGS (state, findings) {
            state.findings = findings
        },
        ADD_FINDINGS (state, findings) {
            state.findings = findings
        },
        SET_AUTH : (state, payload) => {
            state.auth = payload
        },
        USER_LOGOUT : (state, payload) => {
            state.auth = payload
        },
        USER_LOGIN : (state, payload) => {
            state.auth = payload
        }
    }
})

