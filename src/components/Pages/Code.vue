<template>
    <v-container
            class="fill-height"
            fluid
    >

        <div class="my-2" style="margin: 0 auto 50px !important;">
            <v-btn
                    x-large
                    color="success"
                    @click="saveFindings"
                    :loading="loading"
                    dark
            >Сохранить
            </v-btn>
        </div>


        <v-row
                align="start"
                justify="center"
                style="margin: -25px;"
        >
            <v-expansion-panels
                    accordion
                    style="width: calc(25% - 50px); margin: 25px;"
            >
                <v-expansion-panel>
                    <v-expansion-panel-header
                            style="background: #fbfbfb; outline: 0;"
                    >
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


        <v-expansion-panels
                accordion
                v-for="list of findings.scripts.lists"
                :key="list.name"
                style="width: calc(25% - 50px); margin: 25px;"
        >
            <v-expansion-panel>
                <v-expansion-panel-header
                        style="background: #fbfbfb; outline: 0;"
                >
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
        </v-row>



        <template>
            <div class="divider"></div>
        </template>



        <v-row
                align="start"
                justify="center"
                style="margin: -25px;"
        >
            <v-card class="elevation-12"
                    v-for="list of findings.scripts.other"
                    :key="list.name"
                    style="width: calc(33.33% - 50px); margin: 25px;"
            >
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

        </v-row>
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
    .mdi:before, .mdi-set {
        font-size: 36px;
    }

    .icon-service {
        flex: none !important;
    }

    .divider {
        width: 100%;
        height: 1px;
        border-bottom: 1px solid #999;
        margin: 85px 0;
    }

    textarea {
        font-size: 14px;
        line-height: 1.5 !important;
    }
</style>
