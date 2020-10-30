<template>
    <v-container>
        <v-layout column>
            <v-card class="elevation-12">
                <v-form class="pa-5">
                    <h2>Фавиконка</h2>
                    <p>Фавиконка — это небольшая картинка, которая отображается в сниппете в результатах поиска, рядом с адресом сайта в адресной строке браузера.</p>
                    <p>Для загрузки фавиконки, изображение должно быть формата <b>PGN</b> и размером <b>192*192px</b>!</p>
                    <img
                            style="margin-bottom: 20px;"
                            :src="'api/favicon-192.png?v_' + count"
                            alt="Фавиконка"
                    >
                    <v-layout>
                        <v-flex>
                            <v-btn class="warning" @click="triggerUpload">
                                Загрузить
                                <v-icon right dark>mdi-cloud-upload-outline</v-icon>
                            </v-btn>
                            <input
                                    ref="fileInput"
                                    type="file"
                                    style="display: none;"
                                    accept="image/*"
                                    @change="uploadImg"
                            >
                        </v-flex>
                    </v-layout>
                </v-form>
            </v-card>
        </v-layout>
    </v-container>
</template>


<script>
    export default {
        mounted () {
            this.$store.dispatch('loadFindings')
        },
        computed: {
            count () {
                return this.$store.getters.COUNT
            },
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
            triggerUpload () {
                this.$refs.fileInput.click()
            },
            uploadImg (e) {
                const file = e.target.files[0];
                this.$store.dispatch('uploadImg', file)
                this.$store.commit('increment')
            },
            saveFindings ()  {
                const findings = this.findings
                this.$store.dispatch('saveFindings', findings)
            }
        }
    }
</script>


<style scoped>

</style>
