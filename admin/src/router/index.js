import Vue from 'vue'
import Router from 'vue-router'
import AuthGuard from './auth-guard'
import Home from '@/components/Home'
import Seo from '@/components/Pages/Seo'
import Template from '@/components/Pages/Template'
import Contacts from '@/components/Pages/Contacts'
import Backups from '@/components/Pages/Backups'
import Code from '@/components/Pages/Code'
import Login from '@/components/Auth/Login'
import Settings from '@/components/Pages/Settings'
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
            path: '/backup',
            name: 'backup',
            component: Backups,
            beforeEnter: AuthGuard
        },
        {
            path: '/template',
            name: 'template',
            component: Template,
            beforeEnter: AuthGuard
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/contacts',
            name: 'contacts',
            component: Contacts,
            beforeEnter: AuthGuard
        },
        {
            path: '/seo',
            name: 'seo',
            component: Seo,
            beforeEnter: AuthGuard
        },
        {
            path: '/code',
            name: 'code',
            component: Code,
            beforeEnter: AuthGuard
        },
        {
            path: '/settings',
            name: 'settings',
            component: Settings
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
