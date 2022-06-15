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
                    text: " Arabic name",
                    align: "start",
                    sortable: true,
                    value: "arabic_name",
                },

                {
                    text: " Status",
                    align: "start",
                    sortable: true,
                    value: "status",
                },

                { text: "Actions", value: "actions", sortable: false },
            ],
            categories: [],
            products: [],
            sub_categories : [],
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
            subCategoriesEditIndex: -1,
            editedItem: {
                id: "",
                name: "",
                arabic_name: "",
                type: "",
            },
            defaultItem: {
                id: "",
                arabic_name: "",
                type: "",
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
            return state.editedIndex == -1
                ? "Add new record"
                : "Update record";
        },

        getImage: (state) => {
            return (
                state.image.preview ||
                state.editedItem.image ||
                "/images/categories/category.webp"
            );
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


        showClearImage: (state) =>   {
      
                return state.image.preview
        
        },

        datatableIndex: (state) => {
            if (state.subCategoriesEditIndex > -1) {
                return state.categories.findIndex(function (category) {
                    return category.id == state.subCategoriesEditIndex;
                });
            }
            return 0;
        },

    },

    mutations: {
        // ---------- main
        assignApiData: (state, categories) => {
            state.categories = categories;

            setTimeout(() => {
                state.showContent = true;
            }, 200);
        },
        // ---------- main

        // ---------- delete
        closeDeleteSnackbar: (state) => {
            state.deleteSnackbar = false;
        },
        showDeleteSnackbar: (state, item) => {
            state.products = item.products;
            state.sub_categories = item.sub_categories;
            state.deleteIndex = item.id;
            state.deleteSnackbar = true;
        },

        showBlockDeleteSnackbar: (state) => {
            state.blockDeleteSnackbar = true;
        },

        fillBlockDeleteSnackbar: (state) => {
            if(state.products.length && !state.sub_categories.length) { 
                state.blockDeleteReport = `<p class = "block-delete-header"> you cant delete this category because you used it in the below products </p>`;
                state.products.forEach((element) => {
                    state.blockDeleteReport += ` <p class = "block-delete-paragraph"> ${element.name}</p>   `;
                });
            }

            if (state.sub_categories.length && !state.products.length){ 
                state.blockDeleteReport = `<p class = "block-delete-header"> you cant delete this category because you used it in the below sub categories </p>`;
                state.sub_categories.forEach((element) => {
                    state.blockDeleteReport += ` <p class = "block-delete-paragraph"> ${element.name}</p>   `;
                });
            }

            
            if (state.sub_categories.length && state.products.length){ 
                state.blockDeleteReport = `<p class = "block-delete-header"> you cant delete this category because you used it in the below sub categories </p>`;
                state.sub_categories.forEach((element) => {
                    state.blockDeleteReport += ` <p class = "block-delete-paragraph"> ${element.name}</p>   `;
                });

                state.blockDeleteReport += `<p class = "block-delete-header"> and the below products </p>`;
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

        setDialogValues: (state, dataObject) => {
            if (dataObject.variableType == "name") {
                state.editedItem.name = dataObject.e;
            }else { 
                state.editedItem.arabic_name = dataObject.e; 
            }
        },

        closeData: (state) => {
            state.dialog = false;
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

            setTimeout(() => {
                state.dialog = true;
            }, 100);
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
        async fetch({ state, commit }) {
            const Data = await axios.get("/categories/getData").catch((error) => {
                toasts.methods.fireErrorToast();
            });

            commit("assignApiData", Data.data.categories);
            commit("closeLoader", null, { root: true });
        },

        async delete({ state, dispatch, commit }) {
            if (state.products.length || state.sub_categories.length) {
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
            categoryData.append("image", state.image.file);
            categoryData.append("name", state.editedItem.name);
            categoryData.append("arabic_name", state.editedItem.arabic_name);
            categoryData.append("id", state.editedItem.id);

            if (state.editedIndex == -1) {
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

        async updateStatus({ dispatch }, item) {
            const Data = await axios
                .get(`/category/updateStatus/${item.id}`)
                .catch((error) => {
                    toasts.methods.fireErrorToast();
                });

            const DATAFETCHED = await dispatch("fetch");
            toasts.methods.fireSuccessToast("Status updated successfully");
        },


        

        manageSubCategories({ state, commit }, item) {
            commit("subCategories/manageSubCategories", item, { root: true });
            state.subCategoriesEditIndex = item.id;
        },
    },
};
