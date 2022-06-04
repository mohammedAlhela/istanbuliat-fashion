import toasts from "../../../mixins/toasts";
export default {
    namespaced: true,

    state() {
        return {
            // ---------- main
            headers: [
                {
                    text: "Name",
                    sortable: true,
                    value: "name",
                },
                {
                    text: "Last Seen",
                    value: "last_seen",
                    sortable: true,
                },

                {
                    text: " Email",
                    value: "email",
                    sortable: true,
                },

                {
                    text: "Status",
                    value: "status",
                    sortable: true,
                },

                { text: "Actions", value: "actions", sortable: false },
            ],
            search: "",
            admins: [],
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

                name: "",
                email: "",
                password: "",
            },
            defaultItem: {
                id: "",

                name: "",
                email: "",
                password: "",
            },
            passwordType: "",
            // ---------- dialog data
        };
    },

    getters: {
        returnStateKeys: (state) => {
            return Reflect.ownKeys(state);
        },

        formTitle: (state) => {
            return state.editedIndex === -1
                ? "Add new admin"
                : "Update admin data";
        },

        filteredAdmins: (state, getters) => {
            var adminsFork = state.admins;

            let conditions = [];

            if (state.search) {
                conditions.push(getters.filterData);
            }

            if (conditions.length > 0) {
                return adminsFork.filter((admin) => {
                    return conditions.every((condition) => {
                        return condition(admin);
                    });
                });
            }

            return adminsFork;
        },



        datatableIndex: (state) => {
            if (state.editedIndex > -1) {
                return state.admins.findIndex(function (admin) {
                    return admin.id == state.editedIndex;
                });
            }
            return 0;
        },
    },

    mutations: {
        // ---------- main
        assignApiData: (state, admins) => {
            state.admins = admins;
            setTimeout(() => {
                state.showContent = true;
            }, 500);
        },
        setSearchValue: (state, e) => {
            state.search = e;
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

        // ---------- dialog data

        setDialogValues: (state, dataObject) => {
            if (dataObject.variableType === "name") {
                state.editedItem.name = dataObject.e;
            } else if (dataObject.variableType === "email") {
                state.editedItem.email = dataObject.e;
            } else if (dataObject.variableType === "password") {
                state.editedItem.password = dataObject.e;
            }
        },

        toggleType: (state) => {
            state.passwordType == "password"
                ? (state.passwordType = "text")
                : (state.passwordType = "password");
        },

        closeData: (state) => {
            state.dialog = false;
            state.buttonLoading = false;
            state.errors = {};
            state.editedItem = Object.assign({}, state.defaultItem);

            setTimeout(() => {
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

        // ---------- dialog data
    },

    actions: {
        async fetch({ commit }) {
            const Data = await axios.get("/admins").catch((error) => {
                toasts.methods.fireErrorToast();
            });

            commit("closeLoader", null, { root: true });
            commit("assignApiData", Data.data.admins);
        },

        async delete({ state, dispatch, commit }) {
            commit("closeDeleteSnackbar");
            const Data = await axios
                .delete(`/admin/${state.deleteIndex}`)
                .catch((error) => {
                    toasts.methods.fireErrorToast();
                });

            const DATAFETCHED = await dispatch("fetch");

            toasts.methods.fireSuccessToast("Record deleted successfully");
        },

        async save({ state, commit, dispatch }) {
            commit("intializeSave");

            if (state.editedIndex === -1) {
                const Data = await axios
                    .post(`/admin/store`, state.editedItem)
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
                        `/admin/update/${state.editedIndex}`,
                        state.editedItem
                    )
                    .catch((error) => {
                        commit("fillDialogErrors", error.response.data.errors);
                    });

                if (Data) {
                    const DATAFETCHED = await dispatch("fetch");
                    commit("closeData");
                    toasts.methods.methods.fireSuccessToast(
                        "Record updated Successfully"
                    );
                }
            }
        },

        async updateStatus({ dispatch }, item) {
            const Data = await axios
                .get(`/admin/updateStatus/${item.id}`)
                .catch((error) => {
                    toasts.methods.fireErrorToast();
                });

            const DATAFETCHED = await dispatch("fetch");
            toasts.methods.fireSuccessToast("Status updated successfully");
        },
    },
};
