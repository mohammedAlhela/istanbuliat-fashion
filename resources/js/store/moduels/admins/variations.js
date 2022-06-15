import toasts from "../../../mixins/toasts";
export default {
    namespaced: true,

    state() {
        return {
            // ---------- main
            dialog: false,
            saveDialog: false,
            activeProduct: {
                id: "",
                name: "",
                variations: [],
            },
            variations: [],
            // ---------- main

            // ---------- delete
            singleDelete: true,
            deleteSnackbar: false,
            deleteIndex: -1,
            // ---------- delete

            // ---------- dialog data
            buttonLoading: false,
            errors: {},
            dialog: false,
            editedIndex: -1,
            variationEditedIndex: -1,
            editedItem: {
                id: "",
                color: {
                    id: "",
                    name: "",
                },

                size: {
                    id: "",
                    name: "",
                },

                selling_price: 0,
                discount_price: 0,

                stock_qty: 0,
            },
            defaultItem: {
                id: "",
                color: {
                    id: "",
                    name: "",
                },

                size: {
                    id: "",
                    name: "",
                },

                selling_price: 0,
                discount_price: 0,

                stock_qty: 0,
            },

            // ---------- dialog data
        };
    },

    getters: {
     

        formTitle: (state) => {
            return state.editedIndex == -1
                ? "Add new record"
                : "Update record ";
        },
    
    },

    mutations: {
        // ---------- main
        manageVariations: (state, item) => {
            state.activeProduct = Object.assign({}, item);

            state.dialog = true;
        },

        // ---------- main

        // ---------- delete
        closeDeleteSnackbar: (state) => {
            state.deleteSnackbar = false;
        },
        showDeleteSnackbar: (state, item) => {
            state.deleteIndex = item.id;
            state.deleteSnackbar = true;
        },

        // ---------- delete

        // ---------- dialog data --------------------------------

        setDialogValues: (state, dataObject) => {
            if (dataObject.variableType == "color") {
                state.editedItem.color = dataObject.e;
            } else if (dataObject.variableType == "selling_price") {
                state.editedItem.selling_price = dataObject.e;
            } else if (dataObject.variableType == "discount_price") {
                state.editedItem.discount_price = dataObject.e;
            } else if (dataObject.variableType == "size") {
                state.editedItem.size = dataObject.e;
            } else if (dataObject.variableType == "stock_qty") {
                state.editedItem.stock_qty = dataObject.e;
            }
        },

        closeDialog: (state) => {
            state.dialog = false;
            state.saveDialog = false;
            state.buttonLoading = false;
            state.errors = {};

            setTimeout(() => {
                state.editedItem = Object.assign({}, state.defaultItem);
                state.editedIndex = -1;
            }, 100);
        },

        closeData: (state) => {
            state.saveDialog = false;
            state.buttonLoading = false;
            state.errors = {};

            setTimeout(() => {
                state.editedItem = Object.assign({}, state.defaultItem);
                state.editedIndex = -1;
            }, 100);
        },

        editItem: (state, item) => {
            state.editedIndex = item.id;
            state.editedItem = Object.assign({}, item);
            state.saveDialog = true;
        },

        intializeSave: (state) => {
            state.errors = {};
            state.buttonLoading = true;
            state.editedItem.product_id = state.activeProduct.id;
        },

        openSaveDialog: (state) => {
            state.saveDialog = true;
        },

        fillDialogErrors: (state, erros) => {
            state.errors = erros;
            state.buttonLoading = false;
        },


        // ---------- dialog data ---------------------------
    },

    actions: {
        closeDialogAction({ commit }) {
            commit("closeDialog");
            setTimeout(() => {
                commit("products/closeData", null, { root: true });
            }, 200);
        },

        async delete({ state, dispatch, commit }) {
            commit("closeDeleteSnackbar");
            const Data = await axios
                .delete(`/variation/${state.deleteIndex}`)
                .catch((error) => {
                    toasts.methods.fireErrorToast();
                });

            if (Data) {
                const DATAFETCHED = await dispatch("products/fetch", null, {
                    root: true,
                });
                toasts.methods.fireSuccessToast("Record deleted successfully");
            }
        },



        async save({ state, commit, dispatch }) {
            commit("intializeSave");
            let variationData = new FormData();
            variationData.append("product_id", state.activeProduct.id);
            variationData.append("color_id", state.editedItem.color.id);
            variationData.append("size_id", state.editedItem.size.id);

            variationData.append(
                "selling_price",
                state.editedItem.selling_price
            );
            variationData.append(
                "discount_price",
                state.editedItem.discount_price
            );
            variationData.append("stock_qty", state.editedItem.stock_qty);

            variationData.append("id", state.editedItem.id);
            if (state.editedIndex == -1) {
                const Data = await axios
                    .post(`/variation/store`, variationData)
                    .catch((error) => {
                        commit("fillDialogErrors", error.response.data.errors);
                    });

                if (Data) {
                    const DATAFETCHED = await dispatch("products/fetch", null, {
                        root: true,
                    });
                    commit("closeData");
                    toasts.methods.fireSuccessToast(
                        "Record added successfully"
                    );
                }
            } else {
                const Data = await axios
                    .post(
                        `/variation/update/${state.editedIndex}`,
                        variationData
                    )
                    .catch((error) => {
                        commit("fillDialogErrors", error.response.data.errors);
                    });

                if (Data) {
                    const DATAFETCHED = await dispatch("products/fetch", null, {
                        root: true,
                    });
                    commit("closeData");
                    toasts.methods.fireSuccessToast(
                        "Record updated successfully"
                    );
                }
            }
        },

    },
};
