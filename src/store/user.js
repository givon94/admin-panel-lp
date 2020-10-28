
import Axios from "axios";
const dataBase = "api/database.json";

export default {
    state: {
        auth: true,
        findings: []
    },
    getters: {
        AUTH : state => {
            return state.auth
        },
        FINDINGS : state => {
            return state.findings
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
        async saveFindings ({commit}, findings) {
            commit('clearSuccess')
            commit('clearError')
            commit('setLoading', true)
            Axios
                .post('api/savePage.php',{jsonResult: findings})
                .then(r => r.data)
                .then(() => {
                    commit('setSuccess', 'Успешно сохранено')
                })
                .catch(error => {
                    commit('setLoading', false)
                    commit('setError', 'Ошибка на сервере, повторите попытку позже')
                    throw error
                })
                .finally(() => (commit('setLoading', false)));
        },
        userLogout ({ commit }) {
            Axios
                .post('api/logout.php')
                .then(r => r.data.logout)
                .then(auth => {
                    commit('USER_LOGOUT', auth)
                })
        },
        async userLogin ({commit}, password) {
            commit('clearError')
            commit('setLoading', true)
            Axios
                .post('api/login.php',{'password': password})
                .then(res => {
                    if(res.data.auth === true){
                        commit('USER_LOGIN', res.data.auth)
                        commit('setLoading', false)
                    } else {
                        commit('setLoading', false)
                        commit('setError', 'Введён неверный пароль')
                    }
                })
                .catch(error => {
                    commit('setLoading', false)
                    commit('setError', 'Ошибка на сервере, повторите попытку позже')
                    throw error
                })
                .finally(() => (commit('setLoading', false)));
        },
    },
    mutations: {
        SET_FINDINGS : (state, findings) => {
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
}
