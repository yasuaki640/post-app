import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/sign-up',
        name: 'SignUp',
        component: () => import('@/components/SignUp.vue')
    },
    {
        path: '/edit-profile',
        name: 'EditProfile',
        component: () => import('@/components/EditProfile.vue')
    },
    {
        path: '/list-post',
        name: 'ListPost',
        component: () => import('@/components/ListPost.vue')
    }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router
