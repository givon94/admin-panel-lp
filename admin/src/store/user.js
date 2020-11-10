
import Axios from "axios";



export default {
    state: {
        auth: false
    },
    getters: {
        AUTH : state => {
            return state.auth
        },
    },
    actions: {
        async userLogout ({ commit }) {
            Axios
                .post('./api/logout.php')
                .then(res => {
                    commit('USER_LOGOUT', res.data.logout)
                })
        },
        async userLogin ({commit}, user) {
            commit('clearError')
            commit('setLoading', true)
            Axios
                .post('./api/login.php',{'user': user})
                .then(res => {
                    if(res.data.auth === true){
                        commit('USER_LOGIN', res.data.auth)
                        commit('setLoading', false)
                    } else {
                        commit('setLoading', false)
                        commit('setError', 'Введён неверный логин или пароль')
                    }
                })
                .catch(error => {
                    commit('setLoading', false)
                    commit('setError', 'Ошибка на сервере, повторите попытку позже')
                    throw error
                })
                .finally(() => (commit('setLoading', false)));
        },
        autoLoginUser ({commit}, payload) {
            commit('SET_AUTH', payload)
        },
    },
    mutations: {
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
