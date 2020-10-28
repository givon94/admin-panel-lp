<template>
    <v-container
            class="fill-height"
            fluid
            v-if="!auth"
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
                        <v-toolbar-title>Авторизация</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form v-on:submit.prevent="onLogin" v-model="valid">
                            <v-text-field
                                    id=""
                                    label="Введите пароль"
                                    name="password"
                                    prepend-icon="mdi-lock"
                                    type="password"
                                    v-model="password"
                                    :counter="6"
                                    :rules="passwordRules"
                            ></v-text-field>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                                style="color: #fff;"
                                color="indigo"
                                type="submit"
                                @click="onLogin"
                                :loading="loading"
                                :disabled="!valid || loading"
                        >Войти</v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>


<script>
    //import { mapState } from 'vuex'

    export default {
        data () {
            return {
                password: '',
                checkPassword: false,
                valid: false,
                passwordRules: [
                    v => !!v || 'Введите пароль',
                    v => (v && v.length >= 6) || 'Пароль должен содержать не менее 6 символов',
                ]
            }
        },
        computed: {
            loading () {
                return this.$store.getters.loading
            },
            auth () {
                return this.$store.getters.AUTH
            }
        },
        methods: {
            onLogin () {
                const password = this.password
                this.$store.dispatch('userLogin', password)
                .then(() => {
                    if(!this.auth === true) {
                        this.$router.push('/')
                    }
                })
                .catch(() => {})
            },
        }
    }
</script>
