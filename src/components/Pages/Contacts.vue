<template>
    <v-container
            class="fill-height"
            fluid
    >
        <v-row
                align="center"
                justify="center"
        >
            <v-col
                    cols="12"
                    sm="10"
                    md="8"
            >
                <v-card class="elevation-12">
                    <v-toolbar
                            color="indigo"
                            dark
                            flat
                    >
                        <v-toolbar-title class="pa-7">Контакты</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text class="pa-10">
                        <v-text-field
                                id=""
                                label="Адрес"
                                name="adress"
                                prepend-icon="mdi-map-marker"
                                type="text"
                                v-model="findings.adress"
                        ></v-text-field>
                        <v-text-field
                                id=""
                                label="Время работы"
                                name="work"
                                prepend-icon="mdi-clock-time-three"
                                type="text"
                                v-model="findings.work"
                        ></v-text-field>
                        <v-text-field
                                id=""
                                label="E-mail (для контактов)"
                                name="email"
                                prepend-icon="mdi-email"
                                type="text"
                                v-model="findings.email_contacts"
                        ></v-text-field>
                        <v-text-field
                                id=""
                                label="E-mail (для форм)"
                                name="email"
                                prepend-icon="mdi-email"
                                hint="Если несколько, писать через ,"
                                persistent-hint
                                type="text"
                                v-model="findings.email_form"
                        ></v-text-field>


                        <h5 style="font-weight: 400; font-size: 20px; margin-top: 25px;">Телефоны:</h5>
                        <v-row
                                align="center"
                                style="padding-left: 10px;"
                                v-for="(phone, index) of findings.contacts"
                                :key="phone.operator"
                        >
                            <v-text-field
                                    id=""
                                    label="Телефон"
                                    name="phone"
                                    prepend-icon="mdi-phone-in-talk"
                                    type="text"
                                    v-model="phone.num"
                            ></v-text-field>

                            <!--Оператор-->
                            <v-col class="d-flex" cols="6" sm="3">
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
                            <v-col class="d-flex" cols="5" sm="3">
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
                            <div class="block__phone-item">
                                <v-checkbox
                                        label="топ-бар"
                                        v-model="phone.topbar"
                                        hide-details
                                        class="shrink mr-2 mt-0 test"
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
                        </v-row>
                        <v-card-actions class="pa-0">
                            <v-spacer></v-spacer>
                            <v-btn class="ma-2"
                                   tile
                                   outlined
                                   color="success"
                                   @click="addItemPhone"
                            >
                                <v-icon left>mdi-phone-plus</v-icon> Добавить телефон
                            </v-btn>
                            <v-btn
                                    color="indigo"
                                    dark
                                    type="submit"
                                    @click="saveFindings"
                                    :loading="loading"
                            >Сохранить</v-btn>
                        </v-card-actions>
                    </v-card-text>
                </v-card>
            </v-col>
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


<style scoped>
    .block__phone-item {
        display: flex;
        align-items: center;
        margin: 0 20px 0 15px;
    }


    .pointer {
        cursor: pointer !important;
    }
</style>


<style>
    .block__phone-item .v-label {
        margin-bottom: 0 !important;
    }
</style>
