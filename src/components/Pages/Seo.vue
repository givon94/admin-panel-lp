<template>
    <v-container
            class="fill-height"
            fluid
    >
        <input type="file" accept="image/*" ref="fileInput" @change="uploadImg" style="display: none;">
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
                    v-for="(link, index) of findings.meta"
                    :key="index"
            >
                <v-toolbar
                        color="indigo"
                        dark
                        flat
                >
                    <v-toolbar-title class="pa-3" v-text="'Страница: ' + link.page"></v-toolbar-title>
                </v-toolbar>
                <v-card-text class="pa-7">
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

                    <div style="margin-bottom: 10px">
                        <span style="font-size: 16px; font-weight: 400; margin-right: 5px;">Open Graph Image</span>
                        <v-tooltip bottom max-width="280px">
                            <template v-slot:activator="{ on, attrs }">
                                <v-icon
                                        style="font-size: 18px;"
                                        color="primary"
                                        dark
                                        v-bind="attrs"
                                        v-on="on"
                                >mdi-help-circle</v-icon>
                            </template>
                            <span>Open Graph Image позволяет контролировать превью картинки, которое формируется при публикации ссылки на сайт в социальных сетях.</span>
                        </v-tooltip>
                    </div>
                    <img
                            style="border: 1px solid #d3d3d3;"
                            class="img"
                            :src="'img/upload/' + link.image"
                            alt="og image"
                    >
                    <div style="margin-bottom: 15px;">
                        <span>Размер изображения должен быть <b>968×504 пикселя!</b></span>
                    </div>
                    <div>
                        <v-btn class="warning" @click="triggerUpload(index)">
                            Загрузить изображение
                            <v-icon right dark>mdi-cloud-upload-outline</v-icon>
                        </v-btn>
                    </div>
                </v-card-text>
            </v-card>
        </v-row>
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
                            this.findings.meta[this.index].image = res.data.src
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
    .pointer {
        cursor: pointer !important;
    }

    .img {
        max-width: 100%;
        margin-bottom: 25px;
    }
</style>
