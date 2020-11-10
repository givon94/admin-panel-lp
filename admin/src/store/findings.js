import Axios from "axios";

export default {
    state: {
        findings: []
    },
    getters: {
        FINDINGS : state => {
            return state.findings
        },
    },
    actions: {
        loadFindings ({ commit }) {
            let prefix = Math.floor(Math.random() * 1000) + 1;

            Axios
                .get('api/database.json?' + prefix)
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
    },
    mutations: {
        SET_FINDINGS : (state, findings) => {
            state.findings = findings
        }
    }
}
