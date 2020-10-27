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
                        <v-toolbar-title>Авторизация</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form v-on:submit.prevent="login">
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
                                color="indigo"
                                dark
                        >Вход</v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>


<script>
    const axios = require('axios');
    export default {
        data () {
            return {
                password: '',
                checkPassword: false,
                passwordRules: [
                    v => !!v || 'Введите пароль',
                    v => (v && v.length >= 6) || 'Пароль должен содержать не менее 6 символов',
                ]
            }
        },
        methods: {
            login() {
                if(this.password.length > 5){
                    this.checkPassword = false;
                    alert(this.password)

                    axios
                        .post('./api/login.php', {'password': this.password})
                        .then(res => {
                            if(res.data.auth === true){
                                this.auth = res.data.auth;
                                //this.start();
                            }  else {
                                this.checkPassword = true
                            }
                            console.log(res.data);
                        })
                } else {
                    this.checkPassword = true
                }
            }
        }
    }
</script>
