import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

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
        component: () => import('@/views/EditProfile.vue')
    },
    {
        path: '/list-post',
        name: 'ListPost',
        component: () => import('@/views/ListPost.vue')
    }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

router.beforeEach((to, from, next) => {
    next()
})

export default router
