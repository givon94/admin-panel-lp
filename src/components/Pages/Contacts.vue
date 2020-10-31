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
                    sm="8"
                    md="6"
            >
                <v-card class="elevation-12">
                    <v-toolbar
                            color="indigo"
                            dark
                            flat
                    >
                        <v-toolbar-title>Контакты</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form v-on:submit.prevent="saveFindings">
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
                                <v-col class="d-flex" cols="6" sm="3">
                                    <v-select
                                            :items="items"
                                            item-text="state"
                                            item-value="code"
                                            label="Оператор"
                                            persistent-hint
                                            v-model="phone.operator"
                                    ></v-select>
                                </v-col>

                                <v-col class="d-flex" cols="6" sm="3">
                                    <v-select
                                            :items="messengers"
                                            item-text="state"
                                            item-value="code"
                                            label="Мессенджеры"
                                            persistent-hint
                                            v-model="phone.messenger"
                                            multiple
                                    ></v-select>
                                </v-col>
                                <v-checkbox
                                        label="в топ-бар"
                                        v-model="phone.topbar"
                                        hide-details
                                        class="shrink mr-2 mt-0 test"
                                ></v-checkbox>
                                <v-icon
                                        color="red"
                                        class="pointer"
                                        title="Удалить"
                                        left
                                        @click="delItemPhone(index)"
                                >mdi-close</v-icon>
                            </v-row>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
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
    .pointer {
        cursor: pointer !important;
    }
</style>
