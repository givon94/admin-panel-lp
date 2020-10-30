<template>
    <v-container
            class="fill-height"
            fluid
    >
        <div class="my-2" style="margin: 0 auto 30px !important;">
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

            <v-card class="elevation-12"
                    style="margin: 25px;"
                    width="calc(33.33% - 50px)"
                    v-for="link of findings.meta"
                    :key="link.page"
            >
                <v-toolbar
                        color="indigo"
                        dark
                        flat
                >
                    <v-toolbar-title v-text="'Страница: ' + link.page"></v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <v-form>
                        <v-textarea
                                label="Заголовок"
                                name="pageTitle"
                                type="text"
                                multi-line
                                auto-grow
                                rows="1"
                                v-model="link.title"
                        ></v-textarea>
                        <v-textarea
                                label="Описание"
                                name="pageDescr"
                                type="text"
                                multi-line
                                auto-grow
                                rows="1"
                                v-model="link.descr"
                        ></v-textarea>

                        <v-textarea
                                label="Ключевые слова"
                                name="PageKeywords"
                                type="text"
                                multi-line
                                auto-grow
                                rows="1"
                                v-model="link.keywords"
                        ></v-textarea>

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
    .pointer {
        cursor: pointer !important;
    }
</style>
