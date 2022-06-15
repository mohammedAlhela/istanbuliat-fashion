import toasts from "../../../mixins/toasts";
export default {
    namespaced: true,

    state() {
        return {
            // ---------- main
            sizes: [],
            products: [],
            // ---------- main

            // ---------- delete
            singleDelete: true,
            deleteSnackbar: false,
            deleteIndex: -1,
            blockDeleteSnackbar: false,
            blockDeleteReport: ``,
            // ---------- delete

            // ---------- dialog data
            buttonLoading: false,
            errors: {},
            dialog: false,

            editedIndex: -1,

            editedItem: {
                id: "",
                name: "",
            },
            defaultItem: {
                id: "",
                name: "",
            },
            // ---------- dialog data
        };
    },

    getters: {
        formTitle: (state) => {
            return state.editedIndex == -1 ? "Add new record" : "Update record";
        },

        getUniqueProducts: (state) => (products) => {
            let uniqueProducts = [];
            let productIndexInUniqueArray = -1;

            products.forEach((product) => {
                productIndexInUniqueArray = uniqueProducts.findIndex(function (
                    item
                ) {
                    return item.id == product.id;
                });

                if (productIndexInUniqueArray == -1) {
                    uniqueProducts.push(product);
                }
            });

            return uniqueProducts;
        }
    },

    mutations: {
        // ---------- main
        assignApiData: (state, sizes) => {
            state.sizes = sizes;
        },

        // ---------- main

        // ---------- delete
        closeDeleteSnackbar: (state) => {
            state.deleteSnackbar = false;
        },
        showDeleteSnackbar: (state, item) => {
            state.products = item.products;
            state.deleteIndex = item.id;
            state.deleteSnackbar = true;
        },

        fillBlockDeleteSnackbar: (state , data) => {
            state.blockDeleteReport = `<p class = "block-delete-header"> you cant delete this Size because it have related data in the below products</p>`;
            data.forEach((element) => {
                state.blockDeleteReport += ` <p class = "block-delete-paragraph"> ${element.name}</p>   `;
            });
        },

        showBlockDeleteSnackbar: (state) => {
            state.blockDeleteSnackbar = true;
        },

        closeBlockDeleteSnackbar: (state) => {
            state.blockDeleteSnackbar = false;
        },

        removeDeletedSize: (state) => {
            state.sizes = state.sizes.filter((size) => {
                return size.id != state.deleteIndex;
            });

            state.deleteIndex = -1;

            toasts.methods.fireSuccessToast("Record deleted successfully");
        },
        // ---------- delete

        // ---------- dialog data

        setDialogValues: (state, dataObject) => {
            if (dataObject.variableType == "name") {
                state.editedItem.name = dataObject.e;
            }
        },

        closeData: (state) => {
            state.dialog = false;
            state.buttonLoading = false;
            state.errors = {};
            state.editedItem = Object.assign({}, state.defaultItem);
            setTimeout(() => {
                state.editedIndex = -1;
            }, 100);
        },

        closeFileData: (state) => {
            state.file = Object.assign({}, state.defaultFile);
        },

        editItem: (state, item) => {
            state.editedIndex = item.id;
            state.editedItem = Object.assign({}, item);
            state.dialog = true;
        },

        intializeSave: (state) => {
            state.errors = {};
            state.buttonLoading = true;
        },

        openSaveDialog: (state) => {
            state.dialog = true;
        },

        fillDialogErrors: (state, erros) => {
            state.errors = erros;
            state.buttonLoading = false;
        },

        updateRecord: (state, objectData) => {
            state.sizes = state.sizes.filter((size) => {
                return size.id != state.editedIndex;
            });
            state.sizes.splice(objectData.index, 0, objectData.size);
        },
        // ---------- dialog data
    },

    actions: {
        async fetch({ state, commit }) {
            const Data = await axios.get("/sizes/getData").catch((error) => {
                toasts.methods.fireErrorToast();
            });

            commit("assignApiData", Data.data.sizes);
        },

        async delete({ state, dispatch, commit , getters }) {
            if (state.products.length) {
                commit("fillBlockDeleteSnackbar" , getters.getUniqueProducts(state.products));
                commit("closeDeleteSnackbar");
                commit("showBlockDeleteSnackbar");
            } else {
                const Data = await axios
                    .delete(`/size/${state.deleteIndex}`)
                    .catch((error) => {
                        toasts.methods.fireErrorToast();
                    });

                if (Data) {
                    commit("closeDeleteSnackbar");
                    const DATAFETCHED = await dispatch("fetch");
                    toasts.methods.fireSuccessToast(
                        "Record deleted successfully"
                    );
                }
            }
        },

        async save({ state, commit, dispatch }) {
            commit("intializeSave");
            if (state.editedIndex === -1) {
                const Data = await axios
                    .post(`/size/store`, state.editedItem)
                    .catch((error) => {
                        commit("fillDialogErrors", error.response.data.errors);
                    });

                if (Data) {
                    const DATAFETCHED = await dispatch("fetch");
                    commit("closeData");
                    toasts.methods.fireSuccessToast(
                        "Record added successfully"
                    );
                }
            } else {
                const Data = await axios
                    .post(`/size/update/${state.editedIndex}`, state.editedItem)
                    .catch((error) => {
                        commit("fillDialogErrors", error.response.data.errors);
                    });

                if (Data) {
                    const DATAFETCHED = await dispatch("fetch");
                    commit("closeData");
                    toasts.methods.fireSuccessToast(
                        "Record updated successfully"
                    );
                }
            }
        },

        async importAction({ state, commit, dispatch }) {
            const formData = new FormData();
            formData.append("file", state.file.file);
            const Data = await axios
                .post(`/sizes/import`, formData)
                .catch((error) => {
                    commit("fillDialogErrors", error.response.data.errors);
                });

            if (Data) {
                commit("closeFileData");
                dispatch("fetch");
                toasts.methods.fireSuccessToast("data imported successfully");
            }
        },
    },
};
