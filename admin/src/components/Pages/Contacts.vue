<template>
    <v-container fluid>
        <v-row
                align="center"
                justify="center"
                class="ma-0"
        >

            <v-flex style="max-width: 1200px;">
                <v-card>
                    <v-toolbar
                            color="indigo"
                            dark
                            flat
                    >
                        <v-toolbar-title class="pa-3 pa-md-7">Контакты</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text class="pa-5 pa-md-10">
                        <v-text-field
                                label="Адрес"
                                prepend-icon="mdi-map-marker"
                                type="text"
                                v-model="findings.adress"
                        ></v-text-field>
                        <v-text-field
                                label="Время работы"
                                prepend-icon="mdi-clock-time-three"
                                type="text"
                                v-model="findings.work"
                        ></v-text-field>
                        <v-text-field
                                label="E-mail (для контактов)"
                                prepend-icon="mdi-email"
                                type="text"
                                v-model="findings.email_contacts"
                        ></v-text-field>
                        <v-text-field
                                label="E-mail (для форм)"
                                prepend-icon="mdi-email"
                                hint="Если несколько, писать через ,"
                                persistent-hint
                                type="text"
                                v-model="findings.email_form"
                        ></v-text-field>


                        <!--Телефоны-->
                        <div class="contact__phones">
                            <h5 class="contact__title">Телефоны:</h5>
                            <v-row
                                    class="phone-list ma-0"
                                    align="center"
                                    v-for="(phone, index) of findings.contacts"
                                    :key="phone.operator"
                            >
                                <!--Телефон-->
                                <v-col class="pa-0 pa-md-3 pl-md-0" cols="12" sm="6" md="">
                                    <v-text-field
                                            label="Телефон"
                                            prepend-icon="mdi-phone"
                                            type="text"
                                            v-model="phone.num"
                                            @keydown.space.prevent
                                    ></v-text-field>
                                </v-col>

                                <!--Оператор-->
                                <v-col class="d-flex align-center pa-0 pl-9 pa-md-3" cols="12" sm="6" md="2">
                                    <v-select
                                            :items="items"
                                            item-text="state"
                                            item-value="code"
                                            label="Оператор"
                                            persistent-hint
                                            v-model="phone.operator"
                                    ></v-select>
                                    <v-tooltip bottom>
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-icon
                                                    style="font-size: 18px;"
                                                    color="primary"
                                                    dark
                                                    v-bind="attrs"
                                                    v-on="on"
                                            >mdi-help-circle</v-icon>
                                        </template>
                                        <span>Иконка выбранного оператора будет отображаться слева от номера телефона</span>
                                    </v-tooltip>
                                </v-col>

                                <!--Мессенджеры-->
                                <v-col class="d-flex align-center pa-0 pl-9 pa-md-3" cols="12" sm="6" md="4">
                                    <v-select
                                            :items="messengers"
                                            item-text="state"
                                            item-value="code"
                                            label="Мессенджеры"
                                            persistent-hint
                                            v-model="phone.messenger"
                                            multiple
                                    ></v-select>
                                    <v-tooltip bottom>
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-icon
                                                    style="font-size: 18px;"
                                                    color="primary"
                                                    dark
                                                    v-bind="attrs"
                                                    v-on="on"
                                            >mdi-help-circle</v-icon>
                                        </template>
                                        <span>Иконки выбранных мессенджеров будут отображаться справа от номера телефона</span>
                                    </v-tooltip>
                                </v-col>


                                <!--Закрпепить в топ бар-->
                                <div class="block__phone-item pl-9 pa-md-3">
                                    <v-checkbox
                                            label="топ-бар"
                                            v-model="phone.topbar"
                                            hide-details
                                            class="shrink mr-2 mt-0"
                                    ></v-checkbox>
                                    <v-tooltip bottom>
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-icon
                                                    style="font-size: 18px;"
                                                    color="primary"
                                                    dark
                                                    v-bind="attrs"
                                                    v-on="on"
                                            >mdi-help-circle</v-icon>
                                        </template>
                                        <span>Этот номер телефона также будет отображаться на сайте в верхнем топ баре</span>
                                    </v-tooltip>
                                </div>


                                <!--Удалить номер-->
                                <div class="contact__btn-delete d-flex align-center pl-9 pa-md-3 pr-md-0 mt-5 ma-sm-0 ml-sm-auto">
                                    <v-tooltip bottom>
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-icon
                                                    style="font-size: 30px;"
                                                    class="pointer"
                                                    color="red"
                                                    dark
                                                    v-bind="attrs"
                                                    v-on="on"
                                                    @click="delItemPhone(index)"
                                            >mdi-close</v-icon>
                                        </template>
                                        <span>Удалить данный телефон</span>
                                    </v-tooltip>
                                    <span class="btn-delete-title">Удалить номер</span>
                                </div>

                                <div class="contact__divider">
                                    <v-divider class="d-block my-8" color="indigo"></v-divider>
                                </div>
                            </v-row>
                            <v-btn class="ma-0"
                                   tile
                                   outlined
                                   color="btnAdd"
                                   @click="addItemPhone"
                            >
                                <v-icon left>mdi-phone-plus</v-icon> Добавить телефон
                            </v-btn>
                        </div>




                        <!--Ссылки на мессенджеры-->
                        <div class="contact__messengers">
                            <v-row class="contact__title ma-0">
                                <h5 class="ma-0" style="padding-right: 5px;">Ссылки на мессенджеры:</h5>
                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-icon
                                                style="font-size: 18px;"
                                                color="primary"
                                                dark
                                                v-bind="attrs"
                                                v-on="on"
                                        >mdi-help-circle</v-icon>
                                    </template>
                                    <span>Иконки мессенджеров будут отображаться справа от номеров телефонов. <br>При клике на эту иконку у клиента откроется чат с вами.</span>
                                </v-tooltip>
                            </v-row>

                            <v-row class="ma-0">

                                <!--Viber-->
                                <v-col class="d-flex align-center pa-0 pa-md-3 pl-md-0" cols="12" sm="6" md="3">
                                    <v-text-field
                                            label="Номер телефона Viber"
                                            type="tel"
                                            prepend-icon="mdi-phone-in-talk"
                                            hint="Например, 375330000000"
                                            persistent-hint
                                            v-model="findings.messengers[0].number"
                                            :disabled="findings.messengers[1].number.length>0"
                                            @keydown.space.prevent
                                    ></v-text-field>
                                </v-col>

                                <v-col class="d-flex align-center pa-0 pl-9 pa-md-3 pl-md-0" cols="12" sm="6" md="3">
                                    <v-text-field
                                            label="Login чат бота Viber"
                                            type="text"
                                            hint="Например, testbot"
                                            persistent-hint
                                            v-model="findings.messengers[1].number"
                                            :disabled="findings.messengers[0].number.length>0"
                                            @keydown.space.prevent
                                    ></v-text-field>
                                </v-col>

                                <!--Telegram-->
                                <v-col class="d-flex align-center pa-0 pa-md-3" cols="12" sm="6" lg="3" md="3">
                                    <v-text-field
                                            label="Login Telegram"
                                            type="text"
                                            prepend-icon="mdi-telegram"
                                            hint="Например, test"
                                            persistent-hint
                                            v-model="findings.messengers[2].number"
                                            @keydown.space.prevent
                                    ></v-text-field>
                                </v-col>

                                <!--WhatsApp-->
                                <v-col class="d-flex align-center pa-0 pl-sm-9 pa-md-3" cols="12" sm="6" md="3">
                                    <v-text-field
                                            label="Номер телефона WhatsApp"
                                            type="text"
                                            prepend-icon="mdi-whatsapp"
                                            hint="Например, 375330000000"
                                            persistent-hint
                                            v-model="findings.messengers[3].number"
                                            @keydown.space.prevent
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                        </div>


                        <!--Ссылки на соц. сети-->
                        <div class="contact__social">
                            <v-row class="contact__title ma-0">
                                <h5 class="ma-0" style="padding-right: 5px;">Ссылки на социальные сети:</h5>
                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-icon
                                                style="font-size: 18px;"
                                                color="primary"
                                                dark
                                                v-bind="attrs"
                                                v-on="on"
                                        >mdi-help-circle</v-icon>
                                    </template>
                                    <span>Вставьте ссылки на ваши социальные сети</span>
                                </v-tooltip>
                            </v-row>


                            <v-row class="ma-0">

                                <!--VK-->
                                <v-col class="contact__social-item d-flex align-center pa-0 pa-md-3 pl-md-0" cols="12" md="6" lg="auto">
                                    <v-text-field
                                            prepend-icon="mdi-vk"
                                            label="VK"
                                            type="text"
                                            v-model="findings.social[0].link"
                                            @keydown.space.prevent
                                    ></v-text-field>
                                </v-col>

                                <!--Insta-->
                                <v-col class="contact__social-item d-flex align-center pa-0 pa-md-3 pl-md-0" cols="12" md="6" lg="auto">
                                    <v-text-field
                                            prepend-icon="mdi-instagram"
                                            label="Instagram"
                                            type="text"
                                            v-model="findings.social[1].link"
                                            @keydown.space.prevent
                                    ></v-text-field>
                                </v-col>

                                <!--facebook-->
                                <v-col class="contact__social-item d-flex align-center pa-0 pa-md-3 pl-md-0" cols="12" md="6" lg="auto">
                                    <v-text-field
                                            prepend-icon="mdi-facebook"
                                            label="Facebook"
                                            type="text"
                                            v-model="findings.social[2].link"
                                            @keydown.space.prevent
                                    ></v-text-field>
                                </v-col>

                                <!--Одноклассники-->
                                <v-col class="contact__social-item d-flex align-center pa-0 pa-md-3 pl-md-0" cols="12" md="6" lg="auto">
                                    <v-text-field
                                            prepend-icon="mdi-odnoklassniki"
                                            label="Одноклассники"
                                            type="text"
                                            v-model="findings.social[3].link"
                                            @keydown.space.prevent
                                    ></v-text-field>
                                </v-col>

                                <!--Youtube-->
                                <v-col class="contact__social-item d-flex align-center pa-0 pa-md-3 pl-md-0" cols="12" md="6">
                                    <v-text-field
                                            prepend-icon="mdi-youtube"
                                            label="Youtube"
                                            type="text"
                                            v-model="findings.social[4].link"
                                            @keydown.space.prevent
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                        </div>


                        <v-btn class="contact__btn-save"
                                color="success"
                                dark
                                type="submit"
                                @click="saveFindings"
                                :loading="loading"
                        >Сохранить</v-btn>

                        <div style="margin-top: 30px;">
                            <p style="font-size: 16px;">
                                *Наведите на иконку
                                <v-icon
                                        style="font-size: 18px;"
                                        color="primary"
                                        dark
                                >mdi-help-circle</v-icon>
                                для отображения детальной информации.
                            </p>
                        </div>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-row>
    </v-container>
</template>


<script>
    export default {
        data: () => ({
            items: [
                { state: 'A1', code: 'a1' },
                { state: 'MTS', code: 'mts' },
                { state: 'Life:)', code: 'life' },
                { state: 'Городской', code: 'home' },
            ],
            messengers: [
                { state: 'Viber', code: 'viber' },
                { state: 'Telegram', code: 'telegram' },
                { state: 'WhatsApp', code: 'whatsapp' },
            ],
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
            addItemPhone () {
                this.op = 'a1';
                this.number = '';
                this.findings.contacts.push({
                    operator: this.op,
                    num: this.number
                })
            },
            delItemPhone: function(index){
                this.findings.contacts.splice(index, 1)
            },
            saveFindings ()  {
                const findings = this.findings
                this.$store.dispatch('saveFindings', findings)
            }
        }
    }


</script>


<style>
    .contact__title {
        font-size: 18px;
        font-weight: 400;
        margin-bottom: 10px !important;
    }

    .contact__title h5 {
        font-size: 18px;
        font-weight: 400;
    }

    .contact__phones {
        margin-top: 65px;
    }

    .contact__messengers {
        margin-top: 65px;
    }

    .contact__social {
        margin-top: 50px;
    }

    .block__phone-item {
        display: flex;
        align-items: center;
    }

    .pointer {
        cursor: pointer !important;
    }

    .block__phone-item .v-label  {
        margin-bottom: 0 !important;
    }

    .contact__btn-delete {
        width: 100%;
    }

    .contact__btn-save {
        margin-top: 30px !important;
    }

    .btn-delete-title {
        font-size: 16px;
    }

    .contact__divider {
        width: 100%;
    }

    @media (min-width: 600px) {
        .contact__title {
            font-size: 20px;
        }

        .contact__title h5 {
            font-size: 20px;
        }

        .contact__btn-delete {
            width: auto;
        }

        .btn-delete-title {
            display: none;
        }
    }

    @media (min-width: 960px) {
        .contact__phones {
            margin-top: 55px;
        }

        .contact__messengers {
            margin-top: 55px;
        }

        .contact__social {
            margin-top: 40px;
        }

        .contact__divider {
            display: none;
        }
    }
    @media (min-width: 1264px) {
        .contact__social-item {
            flex: 1 !important;
        }
    }

</style>
