export default {
    state: {
        loading: false,
        error: null,
        success: null
    },
    mutations: {
        setLoading (state, payload) {
            state.loading = payload
        },
        setError (state, payload) {
            state.error = payload
        },
        setSuccess (state, payload) {
            state.success = payload
        },
        clearError (state) {
            state.error = null
        },
        clearSuccess (state) {
            state.success = null
        }
    },
    actions: {
        setLoading ({commit}, payload) {
            commit('setLoading', payload)
        },
        setError ({commit}, payload) {
            commit('setError', payload)
        },
        setSuccess ({commit}) {
            commit('clearSuccess')
        },
        clearSuccess ({commit}) {
            commit('clearSuccess')
        },
        clearError ({commit}) {
            commit('clearError')
        }
    },
    getters: {
        loading (state) {
            return state.loading
        },
        error (state) {
            return state.error
        },
        success (state) {
            return state.success
        }
    }
}
