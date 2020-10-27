<template>
    <v-container
            class="fill-height"
            fluid
            v-if="!auth" v-show="!auth"
            style="display: none;"
    >
        <v-row
                align="center"
                justify="center"
        >
            <v-col
                    cols="12"
                    sm="8"
                    md="4"
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
                        <v-form v-on:submit.prevent="login">
                            <v-text-field
                                    id=""
                                    label="Адрес"
                                    name="adress"
                                    prepend-icon="mdi-map-marker"
                                    type="text"
                                    v-model="adress"
                            ></v-text-field>
                            <v-text-field
                                    id=""
                                    label="E-mail (прописывать через запятую)"
                                    name="email"
                                    prepend-icon="mdi-email"
                                    type="text"
                                    v-model="email"
                            ></v-text-field>

                            <v-row align="center" style="padding-left: 10px;">
                                <v-text-field
                                        id=""
                                        label="Телефон"
                                        name="phone"
                                        prepend-icon="mdi-phone-in-talk"
                                        type="text"
                                        v-model="phone"
                                ></v-text-field>
                                <v-col class="d-flex" cols="6" sm="3">
                                    <v-select
                                            :items="items"
                                            label="Оператор"
                                    ></v-select>
                                </v-col>
                                <v-icon class="pointer" left>mdi-close</v-icon>
                            </v-row>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn class="ma-2" tile outlined color="success">
                            <v-icon left>mdi-phone-plus</v-icon> Добавить телефон
                        </v-btn>
                        <v-btn
                                color="indigo"
                                dark
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
            items: ['A1', 'MTS', 'Life:)', 'Городской'],
        })
    }
</script>


<style scoped>
    .pointer {
        cursor: pointer !important;
    }
</style>
