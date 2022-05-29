import toasts from '../../../mixins/toasts'
export default {
    namespaced: true,
    state () {
        return {

            products: [],
            categories: [],
            sliders: [],
             showContent: false
        }
    },

    mutations: {
        assignApiData: (state, response) => {
            state.products = response.products

            state.categories = response.categories
            state.sliders = response.sliders
            setTimeout(() => {
                state.showContent = true ;
            } , 200)
        },

    },




    actions: {
        async fetch ({ state, commit }) {
            try {
                const DATA = await axios
                    .get('/home/get-data')
                    .then(response => {
                        commit('assignApiData', response.data)
                        commit("closeLoader" , null , {root:true})
                    })
            } catch (error) {
                toasts.methods.fireErrorToast()
            }
        }
    }
}
