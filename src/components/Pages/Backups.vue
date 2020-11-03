<template>
    <v-container fluid>
        <v-flex row
                justify-center
                align-start
                ma-0
        >
            <v-flex xs12 sm10 lg6 xl3>
                <v-card class="elevation-12 pa-5 pa-sm-10">
                    <h2 style="margin-bottom: 20px;">Резервные копии</h2>
                    <p v-if="backupList.length == 0">Не найдено резервных копий.</p>
                    <div
                            v-else
                            v-for="(list, index) in backupList"
                            :key="index"
                    >
                        <v-divider v-if="index !== 0"></v-divider>
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>{{list.time}}</v-list-item-title>
                            </v-list-item-content>
                            <v-btn
                                    class="upload-btn"
                                    color="indigo"
                                    dark
                                    @click="restoreBackup(list)"
                            >Загрузить</v-btn>
                        </v-list-item>
                    </div>
                </v-card>
            </v-flex>
        </v-flex>
    </v-container>
</template>


<script>
    export default {
        data: () => ({
            index: null
        }),
        mounted () {
            this.$store.dispatch('loadBackups')
        },
        computed: {
            backupList () {
                return this.$store.getters.BACKUPS
            },
            auth () {
                return this.$store.getters.AUTH
            },
        },
        methods: {
            restoreBackup (backup) {
                this.$store.dispatch('restoreBackup', backup)
            }
        }
    }
</script>


<style scoped>
    .upload-btn {
        zoom: .9;
    }

    @media (min-width: 600px) {
        .upload-btn {
            zoom: normal;
        }
    }
</style>
