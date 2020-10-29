<template>
    <v-container
            class="fill-height"
            fluid
    >

        <v-row
                align="start"
                justify="center"
                style="margin: -25px;"
        >

            <v-card class="elevation-12"
                    style="width: calc(25% - 50px); margin: 25px;"
            >
                <v-toolbar
                        color="indigo"
                        dark
                        flat
                >
                    <v-toolbar-title v-text="findings.scripts.gtm.title"></v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <v-form>
                        <v-textarea
                                v-model="findings.scripts.gtm.code_head"
                                label="Скрипт перед закрывающим тегом <head>"
                                name="code"
                                type="text"
                                multi-line
                        ></v-textarea>
                        <v-textarea
                                v-model="findings.scripts.gtm.code_body"
                                label="Скрипт после открывающего тега <body>"
                                name="code2"
                                type="text"
                                multi-line
                        ></v-textarea>
                        <v-sheet class="pa-5">
                            <v-switch
                                    v-model="findings.scripts.gtm.enabled"
                                    :label="findings.scripts.gtm.enabled ? 'Включен' : 'Выключен'"
                            >
                            </v-switch>
                        </v-sheet>

                    </v-form>
                </v-card-text>
            </v-card>



            <v-card class="elevation-12"
                    v-for="list of findings.scripts.lists"
                    :key="list.name"
                    style="width: calc(25% - 50px); margin: 25px;"
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
                        <v-sheet class="pa-5">
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
                        <v-sheet class="pa-5">
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


<style>
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
