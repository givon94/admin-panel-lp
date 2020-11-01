<template>
    <v-container>
        <v-col cols="8" sm="4" offset-sm="3">
            <v-card class="elevation-12 pa-10">
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
                                color="indigo"
                                dark
                                @click="restoreBackup(list)"
                        >Загрузить</v-btn>
                    </v-list-item>
                </div>
            </v-card>
        </v-col>
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
