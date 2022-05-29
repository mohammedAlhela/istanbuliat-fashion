import toasts from '../../../mixins/toasts'
export default {
    namespaced: true,
    state () {
        return {

            categories: [],

        }
    },

    mutations: {
        assignApiData: (state, response) => {
            state.categories = response.categories
        },

    },


    getters : {
        jsonCategories : (state) => {
            return JSON.stringify(state.categories)
          },
    },

    actions: {
        async fetch ({ state, commit }) {
            try {
                const DATA = await axios
                    .get('/home/get-categories')
                    .then(response => {
                        commit('assignApiData', response.data)

                    })
            } catch (error) {
                toasts.methods.fireErrorToast()
            }
        }
    }
}
