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
                    text: " Full Summary",
                    align: "start",
                    sortable: true,
                    value: "name",
                },

                {
                    text: " Price",
                    align: "start",
                    sortable: true,
                    value: "price",
                },

                {
                    text: "Category",
                    align: "start",
                    sortable: true,
                    value: "category",
                },

                {
                    text: "Status",
                    align: "start",
                    sortable: true,
                    value: "status",
                },

                { text: "Actions", value: "actions", sortable: false },
            ],
            showContent: false,
            products: [],
            colors: [],
            sizes: [],
            variations: [],

            categories: [],

            subCategories: [],

            tagsRecords: [],
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
            editedItem: {
                id: "",

                selling_price: "",

                discount_price: "",

                sku: "",

                category: {
                    id: "",
                    name: "",
                },

                sub_category: {
                    id: "",
                    name: "",
                },

                name: "",

                arabic_name: "",

                description: "",

                arabic_description: "",

                wash_care: "",

                contents: [],

                 tagsNamesArray: [],

                colors: [],
                sizes: [],
            },
            defaultItem: {
                id: "",

                selling_price: "",

                discount_price: "",

                sku: "",

                category: {
                    id: "",
                    name: "",
                },

                sub_category: {
                    id: "",
                    name: "",
                },
                name: "",

                arabic_name: "",

                selling_price: "",

                discount_price: "",

                description: "",

                arabic_description: "",

                wash_care: "",

                contents: [],
                 tagsNamesArray: [],

                colors: [],
                sizes: [],
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
            // ---------- filter data

            status: "",

            statusIsFiltered: "",
            name: "",
            price: "",
            minPrice: "",
            maxPrice: "",
            category: {
                id: "",
                name: "",
            },

            defaultCategory: {
                id: "",
                name: "",
            },

            // ---------- filter data
        };
    },

    getters: {
        formTitle: (state) => {
            return state.editedIndex == -1
                ? "Add new product"
                : "Update product data";
        },

        getImage: (state) => {
            let dynamicData;
            if (state.image.preview) {
                dynamicData = state.image.preview;
            } else if (state.editedItem.image) {
                dynamicData = state.editedItem.image;
            } else {
                dynamicData = "/images/products/product.webp";
            }

            return dynamicData;
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

        datatableIndex: (state) => {
            if (state.editedIndex > -1) {
                return state.products.findIndex(function (product) {
                    return product.id == state.editedIndex;
                });
            }
            return 0;
        },

        getColorsNamesString: (state) => {
            if (state.editedItem.colors.length) {
                let namesArray = [];
                state.editedItem.colors.forEach((color) => {
                    namesArray.push(color.name);
                });

                return namesArray.length ? namesArray.join() : "";
            } else {
                return "";
            }
        },

        getSizesNamesString: (state) => {
            if (state.editedItem.colors.length) {
                let namesArray = [];
                state.editedItem.sizes.forEach((size) => {
                    namesArray.push(size.name);
                });

                return namesArray.length ? namesArray.join() : "";
            } else {
                return "";
            }
        },

        // -------------- filter

        filteredProducts: (state, getters) => {
            let conditions = [];

            if (state.name) {
                conditions.push(getters.filterName);
            }

            if (state.minPrice || state.maxPrice) {
                conditions.push(getters.filterPrice);
            }

            if (state.statusIsFiltered) {
                conditions.push(getters.filterStatus);
            }

            if (state.category.id) {
                conditions.push(getters.filterCategory);
            }

            if (conditions.length > 0) {
                return state.products.filter((product) => {
                    return conditions.every((condition) => {
                        return condition(product);
                    });
                });
            }

            return state.products;
        },

        filterCategory: (state) => (item) => {
            return (item.category_id + "")
                .toString()
                .includes(state.category.id);
        },

        filterStatus: (state) => (item) => {
            return item.status == state.status;
        },

        filterName: (state) => (item) => {
            return (
                item.name.toLowerCase().includes(state.name.toLowerCase()) ||
                item.sku.toLowerCase().includes(state.name.toLowerCase())
            );
        },

        filterPrice: (state) => (item) => {
            if (state.minPrice && state.maxPrice) {
                return (
                    item.price >= state.minPrice && item.price <= state.maxPrice
                );
            } else if (!state.minPrice && state.maxPrice) {
                return item.price <= state.maxPrice;
            } else if (state.minPrice && !state.maxPrice) {
                return item.price >= state.minPrice;
            }
        },

        showClearImage: (state) => {
            return state.image.preview;
        },

        getRelatedSubCategories: (state) => {
            if (state.editedItem.category.id) {
                return state.subCategories.filter((item) => {
                    return item.category_id == state.editedItem.category.id;
                });
            } else {
                return state.subCategories;
            }
        },

        // --------------- filter
    },

    mutations: {
        // ---------- main
        assignOptions: (state, response) => {
            state.categories = response.categories;
            state.subCategories = response.subCategories;

            state.colors = response.colors;
            state.sizes = response.sizes;
        },

        assignProducts: (state, response) => {
            state.products = response.products;



        state.tagsRecords = response.tags;

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
            state.variations = item.variations;
            state.deleteIndex = item.id;
            state.deleteSnackbar = true;
        },
        // ---------- delete

        // ---------- dialog data --------------------------------

        setDialogValues: (state, dataObject) => {
            if (dataObject.variableType == "name") {
                state.editedItem.name = dataObject.e;
            } else if (dataObject.variableType == "description") {
                state.editedItem.description = dataObject.e;
            } else if (dataObject.variableType == "arabicDescription") {
                state.editedItem.arabic_description = dataObject.e;
            } else if (dataObject.variableType == "arabicName") {
                state.editedItem.arabic_name = dataObject.e;
            } else if (dataObject.variableType == "category") {
                state.editedItem.category = dataObject.e;
            } else if (dataObject.variableType == "contents") {
                state.editedItem.contents = dataObject.e;
            } else if (dataObject.variableType == "selling_price") {
                state.editedItem.selling_price = dataObject.e;
            } else if (dataObject.variableType == "discount_price") {
                state.editedItem.discount_price = dataObject.e;
            } else if (dataObject.variableType == "sku") {
                state.editedItem.sku = dataObject.e;
            } else if (dataObject.variableType == "wash_care") {
                state.editedItem.wash_care = dataObject.e;
            } else if (dataObject.variableType == "tagsNamesArray") {
                state.editedItem.tagsNamesArray = dataObject.e;
            } else if (dataObject.variableType == "colorsNamesString") {
                state.editedItem.colors = dataObject.e;
            } else if (dataObject.variableType == "sizesNamesString") {
                state.editedItem.sizes = dataObject.e;
            } else if (dataObject.variableType == "subCategory") {
                state.editedItem.sub_category = dataObject.e;
            }
        },

        setFilterValues: (state, dataObject) => {
            if (dataObject.variableType == "name") {
                state.name = dataObject.e;
            } else if (dataObject.variableType == "category") {
                state.category = Object.assign({}, dataObject.e);
            } else if (dataObject.variableType == "minPrice") {
                state.minPrice = dataObject.e;
            } else if (dataObject.variableType == "maxPrice") {
                state.maxPrice = dataObject.e;
            }
        },

        resetNameFilter(state) {
            state.name = "";
        },

        resetPriceFilter(state) {
            state.minPrice = "";
            state.maxPrice = "";
        },

        addActiveCategory: (state, item) => {
            state.category = Object.assign({}, item.category);
        },

        filterStatus: (state, item) => {
            state.status = item.status;
            state.statusIsFiltered = "filtered";
        },

        closeStatusFilter: (state) => {
            (state.status = ""), (state.statusIsFiltered = "");
        },

        resetCategoryFilter: (state) => {
            state.category = Object.assign({}, state.defaultCategory);
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
        async fetchOptions({ commit }) {
            const DATA = await axios.get("/products/options/getData");

            commit("assignOptions", DATA.data);
        },

        async fetchProducts({ state, commit }) {
            const DATA = await axios.get("/products/getData").catch((error) => {
                toasts.methods.fireErrorToast();
            });
            if (DATA.data) {
                commit("assignProducts", DATA.data);
            }
        },

        async fetch({ state, commit, dispatch }) {
            const OPTIONS = !state.colors.length
                ? await dispatch("fetchOptions")
                : console.log("optionsFetched");
            const PRODUCTS = await dispatch("fetchProducts");
            commit("closeLoader", null, { root: true });
        },

        async delete({ state, dispatch, commit }) {
            commit("closeDeleteSnackbar");
            const Data = await axios
                .delete(`/product/${state.deleteIndex}`)
                .catch((error) => {
                    toasts.methods.fireErrorToast();
                });

            if (Data) {
                const DATAFETCHED = await dispatch("fetch");
                toasts.methods.fireSuccessToast("Record deleted successfully");
            }
        },

        async save({ state, commit, getters, dispatch }) {
            commit("intializeSave");
            let productData = new FormData();
            productData.append("category_id", state.editedItem.category.id);
            productData.append("sub_category_id", state.editedItem.sub_category.id);
            productData.append("image", state.image.file);
            productData.append("name", state.editedItem.name);
            productData.append("arabic_name", state.editedItem.arabic_name);
            productData.append("selling_price", state.editedItem.selling_price);
            productData.append(
                "discount_price",
                state.editedItem.discount_price
                    ? state.editedItem.discount_price
                    : 0
            );
            productData.append("sku", state.editedItem.sku);
            productData.append("description", state.editedItem.description);
            productData.append(
                "arabic_description",
                state.editedItem.arabic_description
            );
            productData.append(
                "tagsNamesString",
                state.editedItem.tagsNamesArray.length
                    ? state.editedItem.tagsNamesArray
                    : ""
            );

   
            productData.append(
                "colorsNamesString",
                getters.getColorsNamesString
            );
            productData.append("sizesNamesString", getters.getSizesNamesString);

            productData.append("contents", state.editedItem.contents);
            productData.append("wash_care", state.editedItem.wash_care);

            productData.append("id", state.editedItem.id);

            if (state.editedIndex == -1) {
                const Data = await axios
                    .post(`/product/store`, productData)
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
                    .post(`/product/update/${state.editedIndex}`, productData)
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

        async updateStatus({ dispatch }, id) {
            const Data = await axios
                .get(`/product/updateStatus/${id}`)
                .catch((error) => {
                    toasts.methods.fireErrorToast();
                });

            if (Data) {
                const DATAFETCHED = await dispatch("fetch");
                toasts.methods.fireSuccessToast("Record updated successfully");
            }
        },

        manageVariations({ state, commit }, item) {
            commit("variations/manageVariations", item, { root: true });
            state.editedIndex = item.id;
        },
        manageSizeGuides({ state, commit }, item) {
            commit("sizeGuides/manageSizeGuides", item, { root: true });
            state.editedIndex = item.id;
        },

        manageProductColors({ state, commit }, item) {
            commit("productColors/manageProductColors", item, { root: true });
            state.editedIndex = item.id;
        },
    },
};
