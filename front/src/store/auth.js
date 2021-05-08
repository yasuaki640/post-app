import axios from "axios";

const state = () => ({
    user: null,
    token: null
})

const getters = {
    isLoggedIn: state => !!state.user,
    loginUser: state => state.user
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
    async edit(context, data) {
        const response = await axios.put('/api/users/me', data)
        if (200 <= response.status && response.status <= 299) {
            return response
        }

        context.commit('setUser', data)
        return response
    },
    async login(context, data) {
        const response = await axios.post('/api/login', data)
        if (200 <= response.status && response.status <= 299) {
            return
        }
        context.commit('setToken', response.data.access_token)
        localStorage.setItem('post_app_token', response.data.access_token)

        const userResponse = await axios.get('/api/users/me')
        context.commit('setUser', userResponse.data)
    },
    async loginUser(context) {
        const response = await axios.get('/api/users/me')

        if (200 <= response.status && response.status <= 299) {
            context.commit('setUser', response.data)
        } else {
            context.commit('setUser', null)
        }
    },
    logout(context) {
        context.commit('setToken', null)
        context.commit('setUser', null)
        localStorage.removeItem('post_app_token')
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}