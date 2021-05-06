window.axios = require('axios')

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

window.axios.interceptors.request.use(config => {
    config.headers['Authorization'] = `Bearer ${localStorage.getItem('post_app_token')}`
    return config
})

window.axios.interceptors.response.use(
    response => response,
    error => error.response || error
)
