<template>
    <v-container fluid>

        <!--Кнопка сохранить-->
        <div class="my-2 btn-save">
            <v-btn
                    large
                    color="success"
                    @click="saveFindings"
                    :loading="loading"
                    dark
            >Сохранить
            </v-btn>
        </div>

        <!--Скрипты модулей-->
        <v-flex
                justify-center
                align-start
                row
                ma-0
        >
            <!--GTM-->
            <v-flex xs12 md6 lg6 xl3
                    py-3 pa-sm-5 pa-md-5 pa-lg-5
            >
                <v-layout>
                    <v-expansion-panels accordion>
                        <v-expansion-panel>
                            <v-expansion-panel-header style="background: #fbfbfb; outline: 0;">
                                <img
                                        class="icon-service"
                                        src="img/code/gtm.png"
                                        alt="google tag manager"
                                >
                                <template v-slot:actions>
                                    <v-icon color="black">$expand</v-icon>
                                </template>
                                <div style="text-align: center;">
                                    <v-icon
                                            v-if="findings.scripts.gtm.enabled"
                                            color="green"
                                    >mdi-check-bold</v-icon>
                                    <v-icon
                                            v-else
                                            color="red"
                                    >mdi-close-thick</v-icon>
                                </div>
                            </v-expansion-panel-header>
                            <v-expansion-panel-content style="padding-top: 25px; border-top: 1px solid #c5c5c5;">
                                <template>
                                    <v-textarea
                                            v-model="findings.scripts.gtm.code_head"
                                            label="Скрипт перед закрывающим тегом <head>"
                                            name="code"
                                            type="text"
                                            multi-line
                                            auto-grow
                                            rows="1"
                                    ></v-textarea>
                                    <v-textarea
                                            v-model="findings.scripts.gtm.code_body"
                                            label="Скрипт после открывающего тега <body>"
                                            name="code2"
                                            type="text"
                                            multi-line
                                            auto-grow
                                            rows="1"
                                    ></v-textarea>
                                    <v-sheet>
                                        <v-switch
                                                v-model="findings.scripts.gtm.enabled"
                                                :label="findings.scripts.gtm.enabled ? 'Включен' : 'Выключен'"
                                        >
                                        </v-switch>
                                    </v-sheet>
                                </template>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                    </v-expansion-panels>
                </v-layout>
            </v-flex>

            <!--Остальные сервисы-->
            <v-flex xs12 md6 lg6 xl3
                    py-3 pa-sm-5 pa-md-5 pa-lg-5
                    v-for="list of findings.scripts.lists"
                    :key="list.name"
            >
                <v-layout>
                    <v-expansion-panels accordion>
                        <v-expansion-panel>
                            <v-expansion-panel-header style="background: #fbfbfb; outline: 0;">
                                <img
                                        class="icon-service"
                                        :src="'img/code/' + list.name + '.png'"
                                        :alt=list.title
                                >
                            <template v-slot:actions>
                                <v-icon color="black">$expand</v-icon>
                            </template>
                                <div style="text-align: center;">
                                    <v-icon
                                            v-if="list.enabled"
                                            color="green"
                                    >mdi-check-bold</v-icon>
                                    <v-icon
                                            v-else
                                            color="red"
                                    >mdi-close-thick</v-icon>
                                </div>
                            </v-expansion-panel-header>
                            <v-expansion-panel-content style="padding-top: 25px; border-top: 1px solid #c5c5c5;">
                                <template>
                                    <v-textarea
                                            label="Скрипт"
                                            name="code"
                                            type="text"
                                            v-model="list.code"
                                            multi-line
                                            auto-grow
                                            rows="1"
                                    ></v-textarea>
                                    <v-sheet>
                                        <v-switch
                                                v-model="list.enabled"
                                                :label="list.enabled ? 'Включен' : 'Выключен'"
                                        >
                                        </v-switch>
                                    </v-sheet>
                                </template>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                    </v-expansion-panels>
                </v-layout>
            </v-flex>
        </v-flex>



        <template>
            <div class="divider my-10 my-sm-10 my-md-10 my-lg-10"></div>
        </template>


        <!--Отдельные скрипты-->
        <v-flex
                justify-center
                align-start
                row
                ma-0
        >
            <v-flex class="xs12 md6 lg6 xl4 py-3 pa-sm-5 pa-md-5 pa-lg-5"
                    v-for="list of findings.scripts.other"
                    :key="list.name"
            >
                <v-card>
                    <v-toolbar
                            color="indigo"
                            dark
                            flat
                    >
                        <v-toolbar-title v-text="list.title"></v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form>
                            <v-textarea
                                    label="Скрипт"
                                    name="code"
                                    type="text"
                                    v-model="list.code"
                                    multi-line
                            ></v-textarea>
                            <v-sheet>
                                <v-switch
                                        v-model="list.enabled"
                                        :label="list.enabled ? 'Включен' : 'Выключен'"
                                >
                                </v-switch>
                            </v-sheet>

                        </v-form>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-flex>
    </v-container>
</template>


<script>
    export default {
        mounted () {
            this.$store.dispatch('loadFindings')
        },
        computed: {
            loading () {
                return this.$store.getters.loading
            },
            findings () {
                return this.$store.getters.FINDINGS
            },
            auth () {
                return this.$store.getters.AUTH
            }
        },
        methods: {
            saveFindings ()  {
                const findings = this.findings
                this.$store.dispatch('saveFindings', findings)
            }
        }
    }
</script>


<style scoped>
    .btn-save {
        text-align: center;
        position: sticky;
        top: 0;
        margin: 0 0 35px !important;
        z-index: 4;
    }

    .mdi:before, .mdi-set {
        font-size: 24px;
    }

    .icon-service {
        flex: none !important;
        max-width: calc(100% - 100px);
    }

    .v-toolbar__title {
        font-size: 1rem;
        white-space: normal;
    }

    .divider {
        width: 100%;
        height: 1px;
        border-bottom: 1px solid #999;
    }

    textarea {
        font-size: 14px;
        line-height: 1.5 !important;
    }

    @media (min-width: 600px) {
        .mdi:before, .mdi-set {
            font-size: 36px;
        }

        .icon-service {
            max-width: 100%;
        }

        .v-toolbar__title {
            font-size: 1.1rem;
            white-space: nowrap;
        }
    }

    @media (min-width: 1263px) {
        .btn-save {
            top: 87px;
        }
    }

</style>
