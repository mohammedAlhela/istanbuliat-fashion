import toasts from "../../../mixins/toasts";
export default {
    namespaced: true,

    state() {
        return {
            // ---------- main
            dialog: false,

            activeColor: {
                name: "",
                id: "",
            },
            activeProduct: {
                name: "",
                id: "",
            },
            // ---------- main

            // ---------- delete
            singleDelete: true,
            deleteSnackbar: false,
            deleteIndex: -1,
            // ---------- delete

            // ---------- dialog data
            buttonLoading: false,
            errors: {},
            editedIndex: -1,
            editedItem: {
                id: "",
                color_id: "",
                product_id: "",
                image: "",
            },
            defaultItem: {
                id: "",
                color_id: "",
                product_id: "",
                image: "",
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
        formTitle: (state) => {
            return state.editedIndex == -1 ? "Add new record" : "Update record";
        },

        getImageParagraph: (state) => (item) => {
            if (item.id == state.editedIndex) {
                if (state.errors.hasOwnProperty("image")) {
                    return `<span class = 'error-paragraph'>  ${state.errors.image[0]}  </span> `;
                } else if (state.image.name) {
                    return `<span class = 'paragraph'>  ${state.image.name}  </span> `;
                }
            } else {
                return;
            }
        },

        getImage: (state) => (item) => {
            let dynamicData;
            if (state.image.preview && item.id == state.editedIndex) {
                dynamicData = state.image.preview;
            } else if (item.image) {
                dynamicData = item.image;
            } else {
                dynamicData = "/images/products/images/product.webp";
            }

            return dynamicData;
        },
    },

    mutations: {
        // ---------- main

        manageImages: (state, dataObject) => {
            state.activeColor = Object.assign({}, dataObject.activeColor);
            state.activeProduct = Object.assign(
                {},
                dataObject.activeProduct
            );
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

        closeDialog: (state) => {
            state.dialog = false;
            state.buttonLoading = false;
            state.errors = {};

            setTimeout(() => {
                state.editedItem = Object.assign({}, state.defaultItem);
                state.image = Object.assign({}, state.defaultImage);
                state.editedIndex = -1;
            }, 100);
        },

        closeData: (state) => {
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
            state.buttonLoading = false;
        },

        intializeSave: (state) => {
            state.errors = {};
            state.buttonLoading = true;
        },

        initializeAdd: (state) => {
            state.buttonLoading = false;
            state.errors = {};
            state.editedItem = Object.assign({}, state.defaultItem);
            state.image = Object.assign({}, state.defaultImage);
            state.editedIndex = -1;
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

        // ---------- dialog data ---------------------------
    },

    actions: {
        async delete({ state, dispatch, commit }) {
            commit("closeDeleteSnackbar");
            const Data = await axios
                .delete(`/productColorImage/${state.deleteIndex}`)
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

            let productImageData = new FormData();

            productImageData.append("image", state.image.file);
            productImageData.append("product_id", state.activeProduct.id);
            productImageData.append("color_id", state.activeColor.id);
            productImageData.append("id", state.editedItem.id);

            if (state.editedIndex == -1) {
                const Data = await axios
                    .post(`/productColorImage/store`, productImageData)
                    .catch((error) => {
                        commit("fillDialogErrors", error.response.data.errors);
                    });

                if (Data) {
                    const DATAFETCHED = await dispatch("products/fetch", null, {
                        root: true,
                    });
                }
            } else {
                const Data = await axios.post(
                    `/productColorImage/update/${state.editedIndex}`,
                    productImageData
                );
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
