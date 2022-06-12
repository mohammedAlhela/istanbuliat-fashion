import toasts from "../../../mixins/toasts";
export default {
    namespaced: true,

    state() {
        return {
            // ---------- main
            colors: [],
            products: [],
            // ---------- main

            // ---------- delete
            singleDelete: true,
            deleteSnackbar: false,
            blockDeleteSnackbar: false,
            blockDeleteReport: ``,
            deleteIndex: -1,
            // ---------- delete

            // ---------- dialog data
            buttonLoading: false,
            errors: {},
            dialog: false,

            editedIndex: -1,

            editedItem: {
                id: "",
                name: "",
                hex: "",
            },
            defaultItem: {
                id: "",
                name: "",
                hex: "",
            },
            file: {
                file: "",
                name: "",
            },

            defaultFile: {
                file: "",
                name: "",
            },
            // ---------- dialog data
        };
    },

    getters: {
        formTitle: (state) => {
            return state.editedIndex === -1
                ? "Add new color"
                : "Update color record";
        },
    },

    mutations: {
        // ---------- main
        assignApiData: (state, colors) => {
            state.colors = colors;
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

        showBlockDeleteSnackbar: (state) => {
            state.blockDeleteSnackbar = true;
        },

        closeBlockDeleteSnackbar: (state) => {
            state.blockDeleteSnackbar = false;
        },

        fillBlockDeleteSnackbar: (state) => {
            state.blockDeleteReport = `<p class = "block-delete-header"> you cant delete this color because it have related data in the below products</p>`;
            state.products.forEach((element) => {
                state.blockDeleteReport += ` <p class = "block-delete-paragraph"> ${element.name}</p>   `;
            });
        },

        removeDeletedColor: (state) => {
            state.colors = state.colors.filter((color) => {
                return color.id != state.deleteIndex;
            });

            state.deleteIndex = -1;

            toasts.methods.fireSuccessToast("Record deleted successfully");
        },
        // ---------- delete

        // ---------- dialog data

        setDialogValues: (state, dataObject) => {
            if (dataObject.variableType === "name") {
                state.editedItem.name = dataObject.e;
            } else {
                state.editedItem.hex = dataObject.e;
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
            state.colors = state.colors.filter((color) => {
                return color.id != state.editedIndex;
            });
            state.colors.splice(objectData.index, 0, objectData.color);
        },
        // ---------- dialog data
    },

    actions: {
        async fetch({ state, commit }) {
            const Data = await axios.get("/colors").catch((error) => {
                toasts.methods.fireErrorToast();
            });

            commit("assignApiData", Data.data.colors);
        },

        async delete({ state, dispatch, commit }) {
            if (state.products.length) {
                commit("fillBlockDeleteSnackbar");
                commit("closeDeleteSnackbar");
                commit("showBlockDeleteSnackbar");
            } else {
              const Data = await axios
              .delete(`/color/${state.deleteIndex}`)
              .catch((error) => {
                toasts.methods.fireErrorToast()
              })

              if ( Data) {
                commit("closeDeleteSnackbar");
                const DATAFETCHED = await dispatch('fetch')
                toasts.methods.fireSuccessToast('Record deleted successfully')
              }
            }

  




        },

        async save({ state, commit, dispatch }) {
            commit("intializeSave");
            if (state.editedIndex === -1) {
                const Data = await axios
                    .post(`/color/store`, state.editedItem)
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
                    .post(
                        `/color/update/${state.editedIndex}`,
                        state.editedItem
                    )
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
                .post(`/colors/import`, formData)
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
