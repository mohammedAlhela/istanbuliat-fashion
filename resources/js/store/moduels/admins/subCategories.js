import toasts from "../../../mixins/toasts";
export default {
    namespaced: true,

    state() {
        return {
            // ---------- main
            dialog: false,
            saveDialog: false,
            // ---------- main

            // ---------- delete
            singleDelete: true,
            deleteSnackbar: false,
            deleteIndex: -1,
            blockDeleteSnackbar: false,
            blockDeleteReport: ``,
            products: [],
            // ---------- delete

            // ---------- dialog data
            buttonLoading: false,
            errors: {},
            dialog: false,
            editedIndex: -1,
            category_id: -1,
            editedItem: {
                id: "",
                name: "",
                arabic_name: "",
                category_id: "",
                image: "",
                category : { 

                }
            },
            defaultItem: {
                id: "",
                name: "",
                arabic_name: "",
                category_id: "",
                image: "",
                category : { 
                    
                }
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
            } else if (state.editedItem.image) {
                dynamicData = state.editedItem.image;
            } else {
                dynamicData = "/images/categories/categories/category.webp";
            }

            return dynamicData;
        },

        formTitle: (state) => {
            return state.editedIndex == -1
                ? "Add new record "
                : "Update record";
        },

        getImageParagraph: (state) => {
            if (state.errors.hasOwnProperty("image")) {
                return `<span class = 'error-paragraph'>  ${state.errors.image[0]}  </span> `;
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
        // ---------- delete
        closeDeleteSnackbar: (state) => {
            state.deleteSnackbar = false;
        },
        showDeleteSnackbar: (state, item) => {
            state.deleteIndex = item.id;
            state.deleteSnackbar = true;
            state.products = item.products;
        },

        showBlockDeleteSnackbar: (state) => {
            state.blockDeleteSnackbar = true;
        },

        fillBlockDeleteSnackbar: (state) => {
            if (state.products.length) {
                state.blockDeleteReport = `<p class = "block-delete-header"> you cant delete this sub category because you used it in the below products </p>`;
                state.products.forEach((element) => {
                    state.blockDeleteReport += ` <p class = "block-delete-paragraph"> ${element.name}</p>   `;
                });
            }
        },

        closeBlockDeleteSnackbar: (state) => {
            state.blockDeleteSnackbar = false;
        },

        // ---------- delete

        // ---------- dialog data --------------------------------

        manageSubCategories: (state, item) => {
            state.dialog = true;
            state.category_id = item.id;
        },

        setDialogValues: (state, dataObject) => {
            if (dataObject.variableType == "name") {
                state.editedItem.name = dataObject.e;
            } else if (dataObject.variableType == "category") {
                state.editedItem.category = Object.assign({}, dataObject.e);
            } else {
                state.editedItem.arabic_name = dataObject.e;
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
        async delete({ state, dispatch, commit }) {
            if (state.products.length) {
                commit("fillBlockDeleteSnackbar");
                commit("closeDeleteSnackbar");
                commit("showBlockDeleteSnackbar");
            } else {
                commit("closeDeleteSnackbar");
                const Data = await axios
                    .delete(`/subCategory/${state.deleteIndex}`)
                    .catch((error) => {
                        toasts.methods.fireErrorToast();
                    });

                if (Data) {
                    const DATAFETCHED = await dispatch(
                        "categories/fetch",
                        null,
                        {
                            root: true,
                        }
                    );
                    toasts.methods.fireSuccessToast(
                        "Record deleted successfully"
                    );
                }
            }
        },

        async save({ state, commit, dispatch }) {
            commit("intializeSave");

            let DATA = new FormData();
            DATA.append("image", state.image.file);
            DATA.append("category_id", state.editedIndex > -1 ? state.editedItem.category.id : state.category_id);
            DATA.append("name", state.editedItem.name);
            DATA.append("arabic_name", state.editedItem.arabic_name);
            DATA.append("id", state.editedItem.id);
            if (state.editedIndex == -1) {
                const Data = await axios
                    .post(`/subCategory/store`, DATA)
                    .catch((error) => {
                        commit("fillDialogErrors", error.response.data.errors);
                    });

                if (Data) {
                    const DATAFETCHED = await dispatch(
                        "categories/fetch",
                        null,
                        {
                            root: true,
                        }
                    );
                    commit("closeData");
                    toasts.methods.fireSuccessToast(
                        "Record added successfully"
                    );
                }
            } else {
                const Data = await axios
                    .post(`/subCategory/update/${state.editedIndex}`, DATA)
                    .catch((error) => {
                        commit("fillDialogErrors", error.response.data.errors);
                    });

                if (Data) {
                    const DATAFETCHED = await dispatch(
                        "categories/fetch",
                        null,
                        {
                            root: true,
                        }
                    );
                    commit("closeData");
                    toasts.methods.fireSuccessToast(
                        "Record updated successfully"
                    );
                }
            }
        },

        async updateStatus({ dispatch }, item) {
            const Data = await axios
                .get(`/subCategory/updateStatus/${item.id}`)
                .catch((error) => {
                    toasts.methods.fireErrorToast();
                });

            const DATAFETCHED = await dispatch("categories/fetch", null, {
                root: true,
            });
            toasts.methods.fireSuccessToast("Status updated successfully");
        },
    },
};
