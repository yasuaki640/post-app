import './bootstrap/axios'
import './assets/scss/style.scss'
import Vue from 'vue'
import App from './App.vue'
import axios from "axios";
import router from './router'
import store from "./store";
import VueAxios from "vue-axios";

const createApp = async () => {

    await store.dispatch('auth/loginUser')

    Vue.config.productionTip = false

    Vue.use(VueAxios, axios)

    new Vue({
        router,
        store,
        render: h => h(App)
    }).$mount('#app')
}

createApp()
