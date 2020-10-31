<template>
    <v-container>
        <input type="file" accept="image/*" ref="fileInput" @change="uploadImg" style="display: none;">
        <v-layout column>
            <v-card class="elevation-12 pa-5">
                <h2>Фавиконка</h2>
                <p>Фавиконка — это небольшая картинка, которая отображается в сниппете в результатах поиска, рядом с адресом сайта в адресной строке браузера.</p>
                <p>Для загрузки фавиконки, изображение должно быть формата <b>PGN</b> и размером <b>192x192px</b>!</p>
                <div class="img-wrapper"
                     @click="triggerUpload"
                     title="Загрузить новое изображение"
                >
                    <img
                            class="og-image"
                            style="max-width: 100%;"
                            :src="'../img/upload/' + findings.favicon"
                            alt="Фавиконка"
                    >
                    <span>Загрузить новое изображение <br><b>192x192px</b></span>
                </div>
                <div>
                    <v-btn
                            color="indigo"
                            dark
                            type="submit"
                            @click="saveFindings"
                            :loading="loading"
                    >Сохранить</v-btn>
                </div>
            </v-card>
        </v-layout>
    </v-container>
</template>


<script>
    const Axios = require('axios');

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
            triggerUpload () {
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
                            this.findings.favicon = res.data.src
                        })
                        .catch(error => {
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
    .img-wrapper {
        display: inline-block;
        position: relative;
        transition: all ease .3s;
        cursor: pointer;
        margin-bottom: 20px;
    }

    .img-wrapper:before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        background: transparent;
        transition: all ease .3s;
    }
    .img-wrapper:hover:before {
        background: rgba(0,0,0,.8);
    }

    .img-wrapper span {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        top: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: transparent;
        font-size: 20px;
        line-height: 1.5;
        user-select: none;
    }
    .img-wrapper span>b {
        font-size: 26px;
    }

    .img-wrapper:hover span {
        color: #fff;
    }
</style>
