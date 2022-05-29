import toasts from "../../../mixins/toasts";
export default {
    namespaced: true,

    state() {
        return {
            // ---------- main
            headers: [
                {
                    text: "Image",
                    align: "start",
                    sortable: false,
                    value: "image",
                },

                {
                    text: " Name",
                    align: "start",
                    sortable: true,
                    value: "name",
                },

                {
                    text: "Description",
                    align: "start",
                    sortable: true,
                    value: "description",
                },

                { text: "Actions", value: "actions", sortable: false },
            ],
            categories: [],
            products: [],
            showContent: false,
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
            activeCategoryIndex: -1,
            editedItem: {
                id: "",
                name: "",
                type: "",
                description: "",
            },
            defaultItem: {
                id: "",
                name: "",
                type: "",
                description: "",
            },
            bigImage: {
                file: "",
                name: "",
                preview: "",
            },

            defaultBigImage: {
                file: "",
                name: "",
                preview: "",
            },

            smallImage: {
                file: "",
                name: "",
                preview: "",
            },

            defaultSmallImage: {
                file: "",
                name: "",
                preview: "",
            },
            // ---------- dialog data
        };
    },

    getters: {
        formTitle: (state) => {
            return state.editedIndex === -1
                ? "Add new category"
                : "Update category data";
        },

        datatableIndex: (state) => {
            if (state.activeCategoryIndex > -1) {
                return state.categories.findIndex(function (category) {
                    return category.id == state.activeCategoryIndex;
                });
            }
            return 0;
        },

        getSmallImage: (state) => {
            return (
                state.smallImage.preview ||
                state.editedItem.small_image ||
                "/images/categories/small/category.jpg"
            );
        },

        getBigImage: (state) => {
            return (
                state.bigImage.preview ||
                state.editedItem.big_image ||
                "/images/categories/big/category.jpg"
            );
        },

        getSmallImageParagraph: (state) => {
            if (state.errors.hasOwnProperty("small_image")) {
                return `<span class = 'error-paragraph'>  ${state.errors.small_image[0]}  </span> `;
            } else if (state.smallImage.name) {
                return `<span class = 'paragraph'>  ${state.smallImage.name}  </span> `;
            } else {
                return `<span class = 'paragraph'> no image selected </span> `;
            }
        },

        getBigImageParagraph: (state) => {
            if (state.errors.hasOwnProperty("big_image")) {
                return `<span class = 'error-paragraph'>  ${state.errors.big_image[0]}  </span> `;
            } else if (state.bigImage.name) {
                return `<span class = 'paragraph'>  ${state.bigImage.name}  </span> `;
            } else {
                return `<span class = 'paragraph'> no image selected </span> `;
            }
        },
    },

    mutations: {
        // ---------- main

        assignApiData: (state, categories) => {
            state.categories = categories;
            setTimeout(() => {
                state.showContent = true;
            }, 300);
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

        fillBlockDeleteSnackbar: (state) => {
            state.blockDeleteReport = `<p class = "block-delete-header"> you cant delete this category because you used it in the below products </p>`;
            state.products.forEach((element) => {
                state.blockDeleteReport += ` <p class = "block-delete-paragraph"> ${element.name}</p>   `;
            });
        },

        closeBlockDeleteSnackbar: (state) => {
            state.blockDeleteSnackbar = false;
        },

        removeDeletedCategory: (state) => {
            state.categories = state.categories.filter((category) => {
                return category.id != state.deleteIndex;
            });

            state.deleteIndex = -1;
            toasts.methods.fireSuccessToast("Record deleted successfully");
        },
        // ---------- delete

        // ---------- dialog data --------------------------------

        setDialogValues: (state, dataObject) => {
            if (dataObject.variableType === "name") {
                state.editedItem.name = dataObject.e;
            } else if (dataObject.variableType === "description") {
                state.editedItem.description = dataObject.e;
            }
        },

        closeData: (state) => {
            state.dialog = false;
            state.buttonLoading = false;
            state.errors = {};
            state.editedItem = Object.assign({}, state.defaultItem);
            state.bigImage = Object.assign({}, state.defaultBigImage);
            state.smallImage = Object.assign({}, state.defaultSmallImage);
            state.editedIndex = -1;
        },

        editItem: (state, item) => {
            state.editedIndex = item.id;
            state.editedItem = Object.assign({}, item);

            setTimeout(() => {
                state.dialog = true;
            }, 300);
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

        bigImageSelected: (state, element) => {
            state.bigImage.file = element.target.files[0];
            state.bigImage.name = element.target.files[0].name;
            let reader = new FileReader();
            reader.readAsDataURL(state.bigImage.file);
            reader.onload = (element) => {
                state.bigImage.preview = element.target.result;
            };
        },

        smallImageSelected: (state, element) => {
            state.smallImage.file = element.target.files[0];
            state.smallImage.name = element.target.files[0].name;
            let reader = new FileReader();
            reader.readAsDataURL(state.smallImage.file);
            reader.onload = (element) => {
                state.smallImage.preview = element.target.result;
            };
        },
        // ---------- dialog data ---------------------------
    },

    actions: {
        async fetch({ state, commit }) {
            const Data = await axios.get("/categories").catch((error) => {
                toasts.methods.fireErrorToast();
            });

            commit("assignApiData", Data.data.categories);
            commit("closeLoader", null, { root: true });
        },

        async delete({ state, dispatch, commit }) {
            if (state.products.length) {
                commit("fillBlockDeleteSnackbar");
                commit("closeDeleteSnackbar");
                commit("showBlockDeleteSnackbar");
            } else {
                state.editedIndex = -1;
                commit("closeDeleteSnackbar");
                const Data = await axios
                    .delete(`/category/${state.deleteIndex}`)
                    .then((response) => {
                        dispatch("fetch");
                        toasts.methods.fireSuccessToast(
                            "Record deleted successfully"
                        );
                    })
                    .catch((error) => {
                        toasts.methods.fireErrorToast();
                    });
            }
        },

        async save({ state, commit, dispatch }) {
            commit("intializeSave");
            let categoryData = new FormData();
            categoryData.append("big_image", state.bigImage.file);
            categoryData.append("small_image", state.smallImage.file);
            categoryData.append("name", state.editedItem.name);

            categoryData.append(
                "description",
                state.editedItem.description ? state.editedItem.description : ""
            );
            categoryData.append("id", state.editedItem.id);

            if (state.editedIndex === -1) {
                const Data = await axios
                    .post(`/category/store`, categoryData)
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
                    .post(`/category/update/${state.editedIndex}`, categoryData)
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

        async updateType({ dispatch }, item) {
            const Data = await axios
                .get(`/category/updateType/${item.id}`)
                .catch((error) => {
                    toasts.methods.fireErrorToast();
                });

            const DATAFETCHED = await dispatch("fetch");
            toasts.methods.fireSuccessToast("Type updated successfully");
        },
    },
};
