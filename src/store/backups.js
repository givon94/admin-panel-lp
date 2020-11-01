import Axios from "axios";

export default {
    state: {
        backupList: []
    },
    getters: {
        BACKUPS : state => {
            return state.backupList
        },
    },
    actions: {
        loadBackups ({ commit }) {
            let prefix = Math.floor(Math.random() * 1000) + 1;
            commit('clearError')

            Axios
                .get('backups/backups.json?' + prefix)
                .then(res => {
                    let typeFile = res.headers['content-type']
                    if (typeFile.indexOf('application/json') != -1) {
                        commit('SET_BACKUPS', res.data)
                    }
                })
                .catch(error => {
                    throw error
                })
        },
        async restoreBackup ({commit}, backup) {
            commit('clearSuccess')
            commit('clearError')
            Axios
                .post('api/restoreBackup.php',{'file': backup.file, 'name': backup.name, 'time': backup.time})
                .then(r => r.data)
                .then(() => {
                    commit('setSuccess', 'Резервная копия загружена загружена')
                })
                .catch(error => {
                    commit('setError', 'Ошибка на сервере, повторите попытку позже')
                    throw error
                })
        },
    },
    mutations: {
        SET_BACKUPS : (state, backups) => {
            state.backupList = backups
        }
    }
}
