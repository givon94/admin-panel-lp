<template>
    <v-container>
        <v-flex row
                justify-center
                align-start
                ma-0
        >
            <v-flex xs12 sm10 lg8 xl4>
                <v-card class="elevation-12 pa-5 pa-sm-10">
                    <h3 style="margin-bottom: 30px;">Настройки панели администратора</h3>
                    <div>
                        <v-list-item pa-0>
                            <v-list-item-content>
                                <v-list-item-title>Цвет темы:</v-list-item-title>
                            </v-list-item-content>
                            <v-col class="d-flex ma-0 pa-0" cols="12" sm="6">
                                <v-select
                                        :items="items"
                                        item-text="state"
                                        item-value="code"
                                        label="Цвет темы"
                                        persistent-hint
                                        @change="updateTheme"
                                        v-model="themeDark"
                                        dense
                                        solo
                                ></v-select>
                            </v-col>
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
            items: [
                { state: 'Светлая', code: false },
                { state: 'Тёмная', code: true },
            ],
            themeDark: false
        }),
        mounted () {
            let themeColor  = localStorage.getItem('themeDark')
            themeColor === 'true' ? themeColor = true : themeColor = false
            this.themeDark = themeColor
        },
        methods: {
            updateTheme () {
                this.$vuetify.theme.dark = this.themeDark
                localStorage.setItem('themeDark', this.themeDark)
            }
        }
    }
</script>



