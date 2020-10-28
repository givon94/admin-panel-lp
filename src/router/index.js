import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home'
import Seo from '@/components/Pages/Seo'
import Pages from '@/components/Pages/Pages'
import Contacts from '@/components/Pages/Contacts'
import Code from '@/components/Pages/Code'
import Login from '@/components/Auth/Login'

Vue.use(Router)


export default new Router({
    routes: [
        {
            path: '',
            name: 'home',
            component: Home
        },
        {
            path: '/pages/:id',
            name: 'pages',
            component: Pages,
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/contacts',
            name: 'contacts',
            component: Contacts
        },
        {
            path: '/seo',
            name: 'seo',
            component: Seo
        },
        {
            path: '/code',
            name: 'code',
            component: Code
        },
    ],
    mode: 'history'
})
