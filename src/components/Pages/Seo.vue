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
                        <div class="img-wrapper"
                             @click="triggerUpload(index)"
                             title="Загрузить новое изображение"
                        >
                            <img
                                    class="og-image"
                                    style="max-width: 100%;"
                                    :src="'../img/upload/' + link.image"
                                    alt="og image"
                            >
                            <span>Загрузить новое изображение <br><b>968x504px</b></span>
                        </div>
                    </v-form>
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

    .img-wrapper {
        position: relative;
        transition: all ease .3s;
        cursor: pointer;
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
        font-size: 30px;
        line-height: 1.5;
        user-select: none;
    }
    .img-wrapper span>b {
        font-size: 40px;
    }

    .img-wrapper:hover span {
        color: #fff;
    }

</style>
