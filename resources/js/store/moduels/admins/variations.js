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

            image: {
                file: "",
                name: "",
                preview: "",
            },

            defaultImage: {
                file: "",
                name: "",
                preview: "",
            },

            // ---------- dialog data
        };
    },

    getters: {
        getImage: (state) => {
            let dynamicData;
            if (state.image.preview) {
                dynamicData = state.image.preview;
            } else if (state.editedItem.image != null) {
                dynamicData = state.editedItem.image;
            } else {
                dynamicData = "/images/products/variations/variation.webp";
            }

            return dynamicData;
        },

        formTitle: (state) => {
            return state.editedIndex === -1
                ? "Add new product variation"
                : "Update product variation data";
        },
    
        datatableIndex: (state, getters, rootState, rootGetters) => {
            if (state.variationEditedIndex > -1) {
                return     rootState.products.products[rootGetters['products/datatableIndex']].variations.findIndex(function (
                    variation
                ) {
                    return variation.id == state.variationEditedIndex;
                });
            }
            return 0;
        },

        getImageParagraph: (state) => {
            if (state.errors.hasOwnProperty("image")) {
                return `<span class = 'error-paragraph'>  ${state.errors.image[0]}  </span> `;
            } else if (state.editedItem.imageName) {
                return `<span class = 'paragraph'>  ${state.editedItem.imageName}  </span> `;
            } else if (state.image.name) {
                return `<span class = 'paragraph'>  ${state.image.name}  </span> `;
            } else {
                return `<span class = 'paragraph'> no image selected </span> `;
            }
        },

        showClearImage: (state) => {
            return state.image.preview;
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

        removeDeletedVariation: (state, getters, rootState, rootGetters) => {
            rootState.products.products[rootGetters['products/datatableIndex']].variationss =
            rootState.products.products[rootGetters['products/datatableIndex']].variations.filter((variation) => {
                    return variation.id != state.deleteIndex;
                });
            state.deleteIndex = -1;
            toasts.methods.fireSuccessToast("Record deleted successfully");
        },
        // ---------- delete

        // ---------- dialog data --------------------------------

        setDialogValues: (state, dataObject) => {
            if (dataObject.variableType === "color") {
                state.editedItem.color = dataObject.e;
            } else if (dataObject.variableType === "selling_price") {
                state.editedItem.selling_price = dataObject.e;
            } else if (dataObject.variableType === "discount_price") {
                state.editedItem.discount_price = dataObject.e;
            } else if (dataObject.variableType === "size") {
                state.editedItem.size = dataObject.e;
            } else if (dataObject.variableType === "stock_qty") {
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
                state.image = Object.assign({}, state.defaultImage);
                state.editedIndex = -1;
            }, 100);
        },

        closeData: (state) => {
            state.saveDialog = false;
            state.buttonLoading = false;
            state.errors = {};

            setTimeout(() => {
                state.editedItem = Object.assign({}, state.defaultItem);
                state.image = Object.assign({}, state.defaultImage);
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

        imageSelected: (state, element) => {
            state.image.file = element.target.files[0];
            state.image.name = element.target.files[0].name;
            let reader = new FileReader();
            reader.readAsDataURL(state.image.file);
            reader.onload = (element) => {
                state.image.preview = element.target.result;
            };
        },

        clearImage: (state) => {
            state.image = Object.assign({}, state.defaultImage);
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

        deleteImage({ dispatch, commit }, id) {
            axios
                .delete(`/variation/image/${id}`)
                .then((response) => {
                    dispatch("products/fetch", null, { root: true });

                    commit("closeData");
                })
                .catch((error) => {
                    toasts.methods.fireErrorToast();
                });
        },

        async save({ state, commit, dispatch }) {
            commit("intializeSave");

            let variationData = new FormData();
            variationData.append("image", state.image.file);
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

        manageImages({ state, commit }, item) {
            state.variationEditedIndex = item.id;
            commit("variationsImages/manageImages", item, { root: true });
        },
    },
};
