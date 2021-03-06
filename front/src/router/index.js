import Vue from 'vue'
import VueRouter from 'vue-router'
import store from "../store"

Vue.use(VueRouter)

const redirectIfNotLogin = (to, from, next) => {
    if (!store.getters['auth/isLoggedIn']) next({name: 'Login'})
    else next()
}

const routes = [
    {
        path: '/',
        name: 'Login',
        component: () => import('@/views/Login.vue')
    },
    {
        path: '/sign-up',
        name: 'SignUp',
        component: () => import('@/views/SignUp.vue')
    },
    {
        path: '/edit-profile',
        name: 'EditProfile',
        component: () => import('@/views/EditProfile.vue'),
        beforeEnter: redirectIfNotLogin
    },
    {
        path: '/list-post',
        name: 'ListPost',
        component: () => import('@/views/ListPost.vue'),
        beforeEnter: redirectIfNotLogin,
    },
    {
        path: '/system-error',
        name: 'SystemError',
        component: () => import('@/views/errors/System.vue'),
    },
    {
        path: '/create-post',
        name: 'CreatePost',
        component: () => import('@/views/CreatePost.vue')
    },
    {
        path: '/edit-post',
        name: 'EditPost',
        component: () => import('@/views/EditPost.vue')
    }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router
