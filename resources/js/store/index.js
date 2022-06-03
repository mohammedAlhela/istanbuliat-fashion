import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import router from '../router/index'
// admins pagess
import admins from './moduels/admins/users'
import dashboard from './moduels/admins/dashboard'
import sliders from './moduels/admins/sliders'
import categories from './moduels/admins/categories'
import colors from './moduels/admins/colors'
import sizes from './moduels/admins/sizes'
import products from './moduels/admins/products'
import variations from './moduels/admins/variations'
import variationsImages from './moduels/admins/variationsImages'
import sizeGuides from './moduels/admins/sizeGuides'

// admins pagess



export default new Vuex.Store({
    modules: {
        // admins pagess
        admins,
        sliders,
        categories,
        colors,
        sizes,
        products,
        variations,
        variationsImages,
        sizeGuides,
        dashboard
        // admins pagess

  
    },

    state () {
        return {
            loading: true
        }
    },

    mutations: {
        redirect: (state, url) => {
            router.push({ name: url })
        },

        closeLoader: state => {
            state.loading = false
        },

        openLoader: state => {
            state.loading = true
        }
    }
})
