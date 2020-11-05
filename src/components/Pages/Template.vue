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

        <input type="file" accept="image/*" ref="fileInput" @change="uploadImg" style="display: none;">

        <v-layout column>
            <v-flex class="item py-5">
                <v-card class="elevation-10 pa-5 pa-sm-10">
                    <h2>Фавиконка</h2>
                    <p>Фавиконка — это небольшая картинка, которая отображается в сниппете в результатах поиска, рядом с адресом сайта в адресной строке браузера.</p>
                    <p>Для загрузки фавиконки, изображение должно быть формата <b>PGN</b> и размером <b>192x192 пикселя</b>!</p>
                    <img
                            class="img"
                            :src="'img/upload/' + findings.favicon"
                            alt="логотип сайта"
                    >
                    <div>
                        <v-btn class="btn-upload" color="btnUpload" dark @click="triggerUpload('favicon')">
                            Загрузить изображение
                            <v-icon right dark>mdi-cloud-upload-outline</v-icon>
                        </v-btn>
                    </div>
                </v-card>
            </v-flex>

            <v-flex class="item py-5">
                <v-card class="elevation-10 pa-5 pa-sm-10">
                    <h2>Логотип сайта</h2>
                    <p>Логотип сайта — это уникальное изображение, представляющее определенную компанию, организацию, бренд или продукт.<br>На сайте логотип отображается в верхнем и нижнем топ баре.</p>
                    <img
                            class="img"
                            :src="'img/upload/' + findings.logo"
                            alt="логотип сайта"
                    >
                    <div>
                        <v-btn class="btn-upload" color="btnUpload" dark @click="triggerUpload('logo')">
                            Загрузить изображение
                            <v-icon right dark>mdi-cloud-upload-outline</v-icon>
                        </v-btn>
                    </div>
                </v-card>
            </v-flex>
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
    .item {
        width: 100%;
    }

    .btn-save {
        text-align: center;
        position: sticky;
        top: 0;
        margin: 0 0 35px !important;
        z-index: 4;
    }

    .btn-upload {
        zoom: .9;
    }

    .img {
        max-width: 100%;
        margin-bottom: 25px;
    }

    @media (min-width: 600px) {
        .btn-upload {
            zoom: normal;
        }
    }

    @media (min-width: 1263px) {
        .item {
            max-width: 50% !important;
            margin: 0 auto;
        }

        .btn-save {
            top: 87px;
        }
    }
</style>
