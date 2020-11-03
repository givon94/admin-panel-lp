<template>
    <v-container>
        <div class="my-2" style="margin: 0 auto 30px !important;">
            <v-btn
                    large
                    color="success"
                    @click="saveFindings"
                    :loading="loading"
                    dark
            >Сохранить
            </v-btn>
        </div>
        <input type="file" accept="image/*" ref="fileInput" @change="uploadImg" style="display: none;">
        <v-layout column>
            <v-card class="elevation-10 pa-10" style="margin: 15px 0;">
                <h2>Фавиконка</h2>
                <p>Фавиконка — это небольшая картинка, которая отображается в сниппете в результатах поиска, рядом с адресом сайта в адресной строке браузера.</p>
                <p>Для загрузки фавиконки, изображение должно быть формата <b>PGN</b> и размером <b>192x192 пикселя</b>!</p>
                <img
                    class="img"
                    :src="'img/upload/' + findings.favicon"
                    alt="логотип сайта"
                >
                <div>
                    <v-btn class="warning" @click="triggerUpload('favicon')">
                        Загрузить изображение
                        <v-icon right dark>mdi-cloud-upload-outline</v-icon>
                    </v-btn>
                </div>
            </v-card>


            <v-card class="elevation-10 pa-10" style="margin: 15px 0;">
                <h2>Логотип сайта</h2>
                <p>Логотип сайта — это уникальное изображение, представляющее определенную компанию, организацию, бренд или продукт.<br>На сайте логотип отображается в верхнем и нижнем топ баре.</p>
                <img
                    class="img"
                    :src="'img/upload/' + findings.logo"
                    alt="логотип сайта"
                >
                <div>
                    <v-btn class="warning" @click="triggerUpload('logo')">
                        Загрузить изображение
                        <v-icon right dark>mdi-cloud-upload-outline</v-icon>
                    </v-btn>
                </div>
            </v-card>
        </v-layout>
    </v-container>
</template>


<script>
    const Axios = require('axios');

    export default {
        data: () => ({
            index: null,
        }),
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
            triggerUpload (index) {
                this.index = index
                this.$refs.fileInput.click()
            },
            async uploadImg (e) {
                const file = e.target.files[0];

                if(file) {
                    let formData = new FormData();
                    formData.append("image", file);
                    Axios
                        .post('./api/uploadImg.php', formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then((res)=>{
                            this.findings[this.index] = res.data.src
                            this.index = ''
                        })
                        .catch(error => {
                            this.index = ''
                            this.$store.dispatch('setError', 'Ошибка на сервере, повторите попытку позже')
                            throw error
                        })
                }
            },
            saveFindings ()  {
                const findings = this.findings
                this.$store.dispatch('saveFindings', findings)
            }
        }
    }
</script>


<style scoped>
    .img {
        max-width: 100%;
        margin-bottom: 25px;
    }
</style>
