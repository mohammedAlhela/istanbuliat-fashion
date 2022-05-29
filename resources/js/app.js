require('./bootstrap')

window.Vue = require('vue').default

// admins pages ++++++++++
Vue.component(
    'admins-users',
    require('./pages/admins/admins/users.vue').default
)
Vue.component(
    'admins-sliders',
    require('./pages/admins/sliders/sliders.vue').default
)
Vue.component(
    'admins-categories',
    require('./pages/admins/categories/categories.vue').default
)
Vue.component(
    'admins-options',
    require('./pages/admins/options/options.vue').default
)
Vue.component(
    'admins-products',
    require('./pages/admins/products/products.vue').default
)
Vue.component(
        'admins-dashboard',
        require('./pages/admins/dashboard/dashboard.vue').default
    )
    // admins pages ++++++++++

// admins include components ++++++++
Vue.component(
    'admins-navbar',
    require('./components/admins/include/navbar.vue').default
)
Vue.component(
    'delete-data-snackbar',
    require('./components/admins/include/deleteDataSnackbar.vue').default
)
Vue.component(
        'loader',
        require('./components/admins/include/loader.vue').default
    )
    //admins include components ++++++++

Vue.prototype.$user = window.User
Vue.prototype.$token = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute('content')

import Vue from 'vue'
import Vuetify from 'vuetify'
import store from './store/index'
import router from './router'
import 'vuetify/dist/vuetify.min.css'
import '@mdi/font/css/materialdesignicons.css'

import Swal from 'sweetalert2'
window.Swal = Swal
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: toast => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

window.Toast = Toast

import VueApexCharts from 'vue-apexcharts'
Vue.use(VueApexCharts)
Vue.component('apexchart', VueApexCharts)

// owl slider
import OwlCarousel from 'v-owl-carousel'
Vue.use(OwlCarousel)
Vue.component('carousel', OwlCarousel)
    // owl slider



import lightGallery from 'lightgallery'
import lgThumbnail from 'lightgallery/plugins/thumbnail'

window.lightGallery = lightGallery
window.lgThumbnail = lgThumbnail
window.lgZoom = lgThumbnail



Vue.use(Vuetify)

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    store,
    router
})