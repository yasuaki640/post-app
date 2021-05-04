import Vue from 'vue'
import App from './App.vue'
import axios from "axios";
import router from './router'
import store from "@/store";
import VueAxios from "vue-axios";

const createApp = async ()=>{

    await store.dispatch('auth/loginUser')
    Vue.config.productionTip = false
    Vue.use(VueAxios, axios)
    require('@/assets/scss/style.scss')

    new Vue({
        router,
        store,
        render: h => h(App)
    }).$mount('#app')
}

createApp()
