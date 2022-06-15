window._ = require('lodash')

window.axios = require('axios')

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'


if (process.env.NODE_ENV === 'development') {
    window.axios.defaults.baseURL = 'http://127.0.0.1:8000'
}
if (process.env.NODE_ENV === 'production') {
    window.axios.defaults.baseURL = 'https://istanbuliat.store'
}