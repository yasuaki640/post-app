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
        beforeEnter: redirectIfNotLogin
    }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router
