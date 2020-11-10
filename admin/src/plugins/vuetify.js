import Vue from 'vue';
import Vuetify from 'vuetify/lib';


Vue.use(Vuetify);

export default new Vuetify({
    theme: {
        dark: false,
        themes: {
            light: {
                indigo: '#3f51b5',
                primary: '#1976D2',
                secondary: '#424242',
                accent: '#82B1FF',
                error: '#FF5252',
                info: '#2196F3',
                success: '#4CAF50',
                warning: '#fb8c00',
                us1: '#fbfbfb',
                btnUpload: '#fb8c00',
                btnAdd: '#3f51b5'
            },
            dark: {
                indigo: '#272727',
                us1: '#272727',
                btnUpload: '#3f51b5',
                btnAdd: '#2196f3',
            },
        },
    },
});
