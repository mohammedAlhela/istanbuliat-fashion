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
                    text: " Title",
                    align: "start",
                    sortable: true,
                    value: "title",
                },

                {
                    text: "Link",
                    align: "start",
                    sortable: true,
                    value: "link",
                },

                {
                    text: "Status",
                    align: "start",
                    sortable: true,
                    value: "status",
                },

                { text: "Actions", value: "actions", sortable: false },
            ],
            sliders: [],
            loading: true,
            showContent: false,
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
                title: "",
                link: "",

            },
            defaultItem: {
                id: "",
                title: "",
                link: "",

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
                ? "Add new slider"
                : "Update slider data";
        },

        getSmallImage: (state) => {
            return (
                state.smallImage.preview ||
                state.editedItem.small_image ||
                "/images/sliders/small/slider.jpg"
            );
        },

        getBigImage: (state) => {
            return (
                state.bigImage.preview ||
                state.editedItem.big_image ||
                "/images/sliders/big/slider.jpg"
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

        closeLoader: (state) => {
            state.loading = false;
        },

        assignApiData: (state, sliders) => {
            state.sliders = sliders;
            setTimeout(() => {
                state.showContent = true;
            }, 500);
        },

        updateSliderStatus: (state, objectData) => {
            state.sliders[objectData.index].status = objectData.newStatus;
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

        removeDeletedSlider: (state) => {
            state.sliders = state.sliders.filter((slider) => {
                return slider.id != state.deleteIndex;
            });

            state.deleteIndex = -1;
            toasts.methods.fireSuccessToast("Record deleted successfully");
        },
        // ---------- delete

        // ---------- dialog data --------------------------------

        setDialogValues: (state, dataObject) => {
            if (dataObject.variableType === "title") {
                state.editedItem.title = dataObject.e;
            } else if (dataObject.variableType === "link") {
                state.editedItem.link = dataObject.e;
            }
        },

        closeData: (state) => {
            state.dialog = false;
            state.buttonLoading = false;
            state.errors = {};
   

          
            setTimeout(() => {
                state.editedItem = Object.assign({}, state.defaultItem);
                state.bigImage = Object.assign({}, state.defaultBigImage);
                state.smallImage = Object.assign({}, state.defaultSmallImage);
                state.editedIndex = -1;
            }, 500);
        },

        editItem: (state, item) => {
            state.editedIndex = item.id;
            state.editedItem = Object.assign({}, item);
            setTimeout(() => {
                state.dialog = true;
            }, 200);
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
        async fetch({ commit }) {
            const Data = await axios
                .get("/sliders")
                .catch((error) => {
                    toasts.methods.fireErrorToast();
                });

            commit("closeLoader", null, { root: true });
            commit("assignApiData", Data.data.sliders);
        },

        async delete({ state, dispatch, commit }) {
            commit("closeDeleteSnackbar");
            const Data = await axios
                .delete(`/slider/${state.deleteIndex}`)
                .catch((error) => {
                    toasts.methods.fireErrorToast();
                });

            const DATAFETCHED = await dispatch("fetch");
            toasts.methods.fireSuccessToast("Record deleted successfully");
        },

        async save({ state, commit, dispatch }) {
            commit("intializeSave");
            let sliderData = new FormData();
            sliderData.append("big_image", state.bigImage.file);
            sliderData.append("small_image", state.smallImage.file);
            sliderData.append("title", state.editedItem.title);
            sliderData.append(
                "link",  state.editedItem.link

            );
            sliderData.append("id", state.editedItem.id);
            if (state.editedIndex === -1) {
                const Data = await axios
                    .post(`/slider/store`, sliderData)
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
                        `/slider/update/${state.editedIndex}`,
                        sliderData
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

        async updateStatus({  dispatch }, item) {
            const Data = await axios
                .get(`/slider/updateStatus/${item.id}`)
                .catch((error) => {
                    toasts.methods.fireErrorToast();
                });

            const DATAFETCHED = await dispatch("fetch");
            toasts.methods.fireSuccessToast("Status updated successfully");
        },
    },
};
