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
                    text: "Trend",
                    align: "start",
                    sortable: true,
                    value: "trend",
                },

                {
                    text: "Status",
                    align: "start",
                    sortable: true,
                    value: "status",
                },

                {
                    text: "Featured",
                    align: "start",
                    sortable: true,
                    value: "featured",
                },

                { text: "Actions", value: "actions", sortable: false },
            ],
            showContent: false,
            products: [],
            colors: [],
            sizes: [],
            variations: [],

            categories: [],

            tagsRecords: [],
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
                tagsNamesArray: [], // push new tags to api
                sizesNamesArray: [], // push new sizes to api
                colorsNamesArray: [], // push new colors to api
                id: "",
                selling_price: "",
                discount_price: "",
                sku: "",
                category: {
                    id: "",
                    name: "",
                },

                name: "",

                short_description: "",

                long_description: "",
                wash_care: "",
                contents: [],
            },
            defaultItem: {
                tagsNamesArray: [], // push new tags to api
                sizesNamesArray: [], // push new sizes to api
                colorsNamesArray: [], // push new colors to api

                id: "",
                selling_price: "",
                discount_price: "",
                sku: "",
                category: {
                    id: "",
                    name: "",
                },
                name: "",
                selling_price: "",
                discount_price: "",

                short_description: "",

                long_description: "",
                wash_care : "",
                contents: [],
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
            featured: "",
            trend: "",
            statusIsFiltered: "",
            featuredIsFiltered: "",
            trendIsFiltered: "",
            name: "",
            price: "",

            tag: {
                id: "",
                name: "",
            },
            defaultTag: {
                id: "",
                name: "",
            },

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
                dynamicData = "/images/products/product.jpg";
            }

            return dynamicData;
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

        datatableIndex: (state) => {
            if (state.editedIndex > -1) {
                return state.products.findIndex(function (product) {
                    return product.id == state.editedIndex;
                });
            }
            return 0;
        },

        // -------------- filter

        filteredProducts: (state, getters) => {
            let conditions = [];

            if (state.name) {
                conditions.push(getters.filterName);
            }

            if (state.price) {
                conditions.push(getters.filterPrice);
            }

            if (state.featuredIsFiltered) {
                conditions.push(getters.filterFeatured);
            }

            if (state.trendIsFiltered) {
                conditions.push(getters.filterTrend);
            }

            if (state.statusIsFiltered) {
                conditions.push(getters.filterStatus);
            }

            if (state.category.id) {
                conditions.push(getters.filterCategory);
            }

            if (state.tag.name) {
                conditions.push(getters.filterTag);
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

        filterTag: (state) => (item) => {
            return item.tagsNamesString
                .toLowerCase()
                .includes(state.tag.name.toLowerCase());
        },

        filterFeatured: (state) => (item) => {
            return item.featured == state.featured;
        },

        filterTrend: (state) => (item) => {
            return item.trend == state.trend;
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
            return item.price.toString().includes(state.price);
        },

        getColorsIdsFromArray: (state) => {
            let idsArray = [];
            state.editedItem.colorsNamesArray.forEach((color) => {
                idsArray.push(color.id);
            });

            return idsArray;
        },

        getSizesIdsFromArray: (state) => {
            let idsArray = [];
            state.editedItem.sizesNamesArray.forEach((size) => {
                idsArray.push(size.id);
            });
            return idsArray;
        },

        getColorsNamesFromArray: (state) => {
            let namesArray = [];
            state.editedItem.colorsNamesArray.forEach((color) => {
                namesArray.push(color.name);
            });
            return namesArray;
        },

        getSizesNamesFromArray: (state) => {
            let namesArray = [];
            state.editedItem.sizesNamesArray.forEach((size) => {
                namesArray.push(size.name);
            });

            return namesArray;
        },

        // --------------- filter
    },

    mutations: {
        // ---------- main
        assignOptions: (state, response) => {
            state.categories = response.categories;
            state.colors = response.colors;
            state.sizes = response.sizes;
            state.tags = response.tags;
            state.categories = state.categories.filter((item) => {
                return item.status;
            });
        },

        assignProducts: (state, response) => {
            state.products = response.products;
            (state.tagsRecords = response.tags),
                setTimeout(() => {
                    state.showContent = true;
                }, 500);

        
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

        showBlockDeleteSnackbar: (state) => {
            state.blockDeleteSnackbar = true;
        },

        fillBlockDeleteSnackbar: (state) => {
            state.blockDeleteReport = `<p class = "block-delete-header"> you cant delete this products because it has related variations data </p>`;
        },

        closeBlockDeleteSnackbar: (state) => {
            state.blockDeleteSnackbar = false;
        },

        // ---------- delete

        // ---------- dialog data --------------------------------

        setDialogValues: (state, dataObject) => {
            if (dataObject.variableType == "name") {
                state.editedItem.name = dataObject.e;
            } else if (dataObject.variableType == "longDescription") {
                state.editedItem.long_description = dataObject.e;
            } else if (dataObject.variableType == "shortDescription") {
                state.editedItem.short_description = dataObject.e;
            } else if (dataObject.variableType == "category") {
                state.editedItem.category = dataObject.e;
            } else if (dataObject.variableType == "tagsNamesArray") {
                state.editedItem.tagsNamesArray = dataObject.e;
            } else if (dataObject.variableType == "contents") {
                state.editedItem.contents = dataObject.e;
            }
             else if (dataObject.variableType == "colorsNamesArray") {
                state.editedItem.colorsNamesArray = dataObject.e;
            } else if (dataObject.variableType == "sizesNamesArray") {
                state.editedItem.sizesNamesArray = dataObject.e;
            } else if (dataObject.variableType == "selling_price") {
                state.editedItem.selling_price = dataObject.e;
            } else if (dataObject.variableType == "discount_price") {
                state.editedItem.discount_price = dataObject.e;
            } else if (dataObject.variableType == "sku") {
                state.editedItem.sku = dataObject.e;
            } else if (dataObject.variableType == "wash_care") {
                state.editedItem.wash_care = dataObject.e;
            }




        },

        setFilterValues: (state, dataObject) => {
            if (dataObject.variableType == "name") {
                state.name = dataObject.e;
            } else if (dataObject.variableType == "category") {
                state.category = dataObject.e;
            } else if (dataObject.variableType == "price") {
                state.price = dataObject.e;
            }
        },

        resetNameFilter(state) {
            state.name = "";
        },

        resetPriceFilter(state) {
            state.price = "";
        },

        addActiveCategory: (state, item) => {
            state.category = Object.assign({}, item.category);
        },

        addActiveTag: (state, item) => {
            state.tag = Object.assign({}, item);
        },

        filterFeatured: (state, item) => {
            state.featured = item.featured;
            state.featuredIsFiltered = "filtered";
        },

        filterTrend: (state, item) => {
            state.trend = item.trend;
            state.trendIsFiltered = "filtered";
        },

        filterStatus: (state, item) => {
            state.status = item.status;
            state.statusIsFiltered = "filtered";
        },

        closeStatusFilter: (state) => {
            (state.status = ""), (state.statusIsFiltered = "");
        },

        closeFeaturedFilter: (state) => {
            state.featured = "";
            state.featuredIsFiltered = "";
        },

        closeTrendFilter: (state) => {
            state.trend = "";
            state.trendIsFiltered = "";
        },

        resetCategoryFilter: (state) => {
            state.category = Object.assign({}, state.defaultCategory);
        },

        resetTagFilter: (state) => {
            state.tag = Object.assign({}, state.defaultTag);
        },

        closeData: (state) => {
            state.dialog = false;
            state.buttonLoading = false;
            state.errors = {};
 
            setTimeout(() => {
                state.editedItem = Object.assign({}, state.defaultItem);
                state.image = Object.assign({}, state.defaultImage);
                state.editedIndex = -1;
            }, 500);
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

        // ---------- dialog data ---------------------------
    },

    actions: {
        async fetchOptions({ commit }) {
            const Colors = await axios.get("/colors");
            const Sizes = await axios.get("/sizes");

            const Categories = await axios.get("/categories");

            let DATA = {
                colors: Colors.data.colors,
                sizes: Sizes.data.sizes,

                categories: Categories.data.categories,
            };

            console.log(DATA);

            commit("assignOptions", DATA);
        },

        async fetchProducts({ state, commit }) {
            const DATA = await axios.get("/products").catch((error) => {
                toasts.methods.fireErrorToast();
            });
            if (DATA.data) {
                console.log(DATA.data.products);
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
            if (state.variations.length) {
                commit("fillBlockDeleteSnackbar");
                commit("closeDeleteSnackbar");
                commit("showBlockDeleteSnackbar");
            } else {
                commit("closeDeleteSnackbar");
                const Data = await axios
                    .delete(`/product/${state.deleteIndex}`)
                    .catch((error) => {
                        toasts.methods.fireErrorToast();
                    });

                if (Data) {
                    const DATAFETCHED = await dispatch("fetch");
                    toasts.methods.fireSuccessToast(
                        "Record deleted successfully"
                    );
                }
            }
        },

        async save({ state, commit, getters, dispatch }) {
            let productData = new FormData();
            productData.append("category_id", state.editedItem.category.id);
            productData.append("image", state.image.file);
            productData.append("name", state.editedItem.name);
            productData.append("selling_price", state.editedItem.selling_price);
            productData.append(
                "discount_price",
                state.editedItem.discount_price
                    ? state.editedItem.discount_price
                    : 0
            );
            productData.append("sku", state.editedItem.sku);
            productData.append(
                "long_description",
                state.editedItem.long_description
            );
            productData.append(
                "tagsNamesArray",
                state.editedItem.tagsNamesArray
            );

            productData.append(
                "contents",
                state.editedItem.contents
            );
            productData.append(
                "wash_care",
                state.editedItem.wash_care
            );
            productData.append(
                "colorsNamesArray",
                getters.getColorsNamesFromArray
            );
            productData.append(
                "sizesNamesArray",
                getters.getSizesNamesFromArray
            );

            productData.append(
                "short_description",
                state.editedItem.short_description
            );
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

        async updateStatusOrFeaturedOrTrend({ dispatch }, item) {
            let data = new FormData();

            if (item.updateFeatured) {
                data.append("updateFeatured", "update");
            }
            if (item.updateStatus) {
                data.append("updateStatus", "update");
            }
            if (item.updateTrend) {
                data.append("updateTrend", "update");
            }

            const Data = await axios
                .post(`/product/statusOrFeaturedUpdate/${item.id}`, data)
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
        

    },
};
