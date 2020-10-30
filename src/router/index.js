import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home'
import Seo from '@/components/Pages/Seo'
import Template from '@/components/Pages/Template'
import Contacts from '@/components/Pages/Contacts'
import Code from '@/components/Pages/Code'
import Login from '@/components/Auth/Login'
import NotFound from '@/components/Pages/NotFound'

Vue.use(Router)


export default new Router({
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/template',
            name: 'template',
            component: Template,
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
        {
            path: '/404',
            name: '404',
            component: NotFound,
        }, {
            path: '*',
            redirect: '/404'
        }
    ],
    base: '/admin/',
    mode: 'history'
})
