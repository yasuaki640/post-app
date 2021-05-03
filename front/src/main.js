import Vue from 'vue'
import App from './App.vue'
import axios from "axios";
import router from './router'
import store from "@/store";
import VueAxios from "vue-axios";

require('@/assets/scss/style.scss')
Vue.config.productionTip = false

Vue.use(VueAxios, axios)

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')
