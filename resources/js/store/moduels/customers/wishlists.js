import toasts from "../../../mixins/toasts";
export default {
    namespaced: true,
    state() {
        return {
            wishlists: [],
            showContent: false,
            dataObject: {
                product_id: null,
            },
        };
    },

    mutations: {
        assignApiData: (state, response) => {
            state.wishlists = response.wishlists;

            setTimeout(() => {
                state.showContent = true;
            }, 300);
        },

        removeDeletedWishlist: (state, item) => {
            state.wishlists = state.wishlists.filter((wishlist) => {
                return wishlist.id != item.id;
            });

            toasts.methods.fireSuccessToast("item removed");
        },
    },

    getters: {},

    actions: {
        async fetch({ commit }) {
            try {
                const DATA = await axios
                    .get("/wishlists/getData")
                    .then((response) => {
                        commit("assignApiData", response.data);
                        commit("closeLoader", null, { root: true });
                    });
            } catch (error) {
                toasts.methods.fireErrorToast();
            }
        },

        async delete({ commit }, wishlist) {
            const Data = await axios
                .delete(`/wishlist/${wishlist.id}`)
                .then((response) => {
                    commit("removeDeletedWishlist", wishlist);
                    toasts.methods.fireSuccessToast("Item deleted");
                })
                .catch((error) => {
                    toasts.methods.fireErrorToast();
                });
        },
        async deleteAll({ dispatch }) {
            const Data = await axios
                .delete(`/wishlists`)
                .then((response) => {
                    dispatch("fetch");
                    toasts.methods.fireSuccessToast("Items deleted");
                })
                .catch((error) => {
                    toasts.methods.fireErrorToast();
                });
        },

        async add({ state, dispatch }, product_id) {

            if (this._vm.$user) {
                state.dataObject.product_id = product_id;

                let itemIsAdded;
                let idsArray = [];
                state.wishlists.forEach((item) => {
                    idsArray.push(item.id);
                });

                itemIsAdded =
                    idsArray.indexOf(product_id) !== -1 ? true : false;

                if (itemIsAdded) {
                    toasts.methods.fireWarningToast("Product is already added");
                } else {
                    let dataObject = {};

                    dataObject.product_id = product_id;


                    try {
                        let addData = await axios.post(
                            "/wishlist/add",
                            dataObject
                        );

                        let updateData = dispatch("fetch");
                        toasts.methods.fireSuccessToast(
                            "Product added to the wishlist"
                        );
                    } catch (error) {
                        toasts.methods.fireErrorToast();
                    }
                }
            } else {
                toasts.methods.fireWarningToast("you need to login first");
            }
        },
    },
};
