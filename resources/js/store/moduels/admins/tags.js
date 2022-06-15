import toasts from "../../../mixins/toasts";
export default {
    namespaced: true,

    state() {
        return {
            dialog : false, 
            tags: [],

            editedIndex: -1,

            editedItem: {
                id: "",
                arabic_name: "",
            },
            defaultItem: {
                id: "",
                arabic_name: "",
            },

      buttonLoading : false, 

            // ---------- dialog data
        };
    },

    mutations: {
        assignApiData: (state, tags) => {
            state.tags = tags;
        },

        setDialogValues: (state, dataObject) => {
            state.editedItem.arabic_name = dataObject.e;
        },

        closeData: (state) => {
            state.dialog = false;
            state.buttonLoading = false;
            state.editedItem = Object.assign({}, state.defaultItem);
            setTimeout(() => {
                state.editedIndex = -1;
            }, 100);
        },

        editItem: (state, item) => {
            state.editedIndex = item.id;
            state.editedItem = Object.assign({}, item);
            state.dialog = true;
        },

        intializeSave: (state) => {
            state.buttonLoading = true;
        },

        openSaveDialog: (state) => {
            state.dialog = true;
        },
    },

    getters : { 
        formTitle: (state) => {
            return 'add tag arabic name'
        },
    },

    actions: {
        async fetch({ state, commit }) {
            const Data = await axios.get("/tags/getData").catch((error) => {
                toasts.methods.fireErrorToast();
            });

            commit("assignApiData", Data.data.tags);
        },

        async save({ state, commit, dispatch }) {
            commit("intializeSave");

            const Data = await axios.post(
                `/tag/update/${state.editedIndex}`,
                state.editedItem
            );

            if (Data) {
                const DATAFETCHED = await dispatch("fetch");
                commit("closeData");
                toasts.methods.fireSuccessToast("Record updated successfully");
            }
        },
    },
};
