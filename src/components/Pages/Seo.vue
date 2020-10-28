<template>
    <v-container
            class="fill-height"
            fluid
    >
        <p>{{findings}}</p>
        <p>{{auth}}</p>
        <v-row
                align="flex-start"
                justify="center"
                style="margin: -25px;"
        >

            <v-card class="elevation-12"
                    style="margin: 25px;"
                    width="calc(33.33% - 50px)"
                    v-for="link of findings.meta"
                    :key="link.title"
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
                                id=""
                                label="Заголовок"
                                name="pageTitle"
                                type="text"
                                multi-line
                                auto-grow
                                rows="1"
                                v-model="link.title"
                        ></v-textarea>
                        <v-textarea
                                id=""
                                label="Описание"
                                name="pageDescr"
                                type="text"
                                multi-line
                                auto-grow
                                rows="1"
                                v-model="link.descr"
                        ></v-textarea>

                        <v-textarea
                                id=""
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
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                            color="indigo"
                            dark
                    >Сохранить</v-btn>
                </v-card-actions>
            </v-card>
        </v-row>
    </v-container>
</template>


<script>
    import { mapState } from 'vuex'

    export default {
        mounted () {
            this.$store.dispatch('loadFindings')
        },
        computed: mapState([
            'findings',
            'auth'
        ])
    }
</script>



<style scoped>
    .pointer {
        cursor: pointer !important;
    }
</style>
