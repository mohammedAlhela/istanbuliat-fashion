import toasts from '../../../mixins/toasts'
export default {
    namespaced: true,
    state () {
        return {
            carts: null,
            showContent: false,
            myCarts: [],
            lastArray: [],
        }
    },

    mutations: {
        assignApiData: (state, response) => {
            state.carts = response
            let cartsKeys = Object.keys(state.carts['cartItems'])
            cartsKeys.forEach(key => {
                state.myCarts.push(state.carts['cartItems'][key])
            })

            const ids = state.myCarts.map(o => o.id)
            const filtered = state.myCarts.filter(
                ({ id }, index) => !ids.includes(id, index + 1)
            )

            state.myCarts = filtered

            setTimeout(() => {
                state.showContent = true
            }, 300)
        },


        removeDeletedCart: (state, item) => {
            state.myCarts = state.myCarts.filter((cart) => {
                return item.id != cart.id;
            });

            toasts.methods.fireSuccessToast("item removed");
        },
    },

    getters: {
        getTotalPrice: state => {
            let total = 0
            state.myCarts.forEach(item => {
                total += item.price * item.quantity
            })

            return total
        }
    },

    actions: {
        async fetch ({ commit }) {
            try {
                const DATA = await axios
                    .get('/carts/getData')
                    .then(response => {
                        console.log(response.data.cartItems)
                        commit('assignApiData', response.data)
                        commit('closeLoader', null, { root: true })
                    })
            } catch (error) {
                toasts.methods.fireErrorToast()
            }
        },

        async delete({ commit  }, cart) {
            const Data = await axios
                .delete(`/cart/${cart.id}`)
                .then((response) => {
                    commit("removeDeletedCart", cart);

                })
                .catch((error) => {
                    toasts.methods.fireErrorToast();
                });
        },
        async deleteAll({ state }) {
            const Data = await axios
                .delete(`/carts`)
                .then((response) => {

                   state.myCarts = []
                    toasts.methods.fireSuccessToast("Items deleted");
                })
                .catch((error) => {
                    toasts.methods.fireErrorToast();
                });
        },

        async update({ dispatch }, cart) {
            if (cart.quantity <= 0) {
                toasts.methods.fireWarningToast('item number is not valid')
            }

            else {
                let formData = new FormData()

                formData.append('id', cart.id)
                formData.append('quantity', cart.quantity)

                  axios
                    .post(`/cart/update`, formData)
                    .then(response => {
                        toasts.methods.fireSuccessToast('Cart items updated');
                       dispatch('fetch')
                    })
                    .catch(error => {
                      console.log(error)
                    })
            }
        },
    }
}
