import axios from "axios";

const state = () => ({
    user: null,
    token: null
})

const getters = {
    isLoggedIn: state => !!state.user
}

const mutations = {
    setUser(state, user) {
        state.user = user
    },
    setToken(state, token) {
        state.token = token
    }
}

const actions = {
    async register(context, data) {
        const response = await axios.post('/api/users', data)
        context.commit('setUser', response.data)
    },
    async login(context, data) {
        const response = await axios.post('/api/login', data)
        context.commit('setToken', response.data)
        localStorage.setItem('post_app_token', response.data.access_token)
    },
    async loginUser(context) {
        const response = await axios.get('/api/users/me')
        const user = response.data || null
        context.commit('setUser', user)
    },
    logout(context) {
        context.commit('setToken', null)
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}