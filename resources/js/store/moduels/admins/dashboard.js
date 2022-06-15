import toasts from "../../../mixins/toasts";
export default {
    namespaced: true,

    state() {
        return {
            products: [],
            admins : [],
            subscribers : [],
            customers : [],
            showContent: false,
        };
    },


    mutations: {
        assignApiData: (state, dataObject) => {
            state.products = dataObject.products;
            state.customers = dataObject.customers;
            
            state.admins = dataObject.admins;
            state.subscribers = dataObject.subscribers;
           
                state.showContent = true;
     ;
        },
    },

    actions: {
        async fetch({  commit }) {
            const Data = await axios.get("/dashboard/getData").catch((error) => {
                toasts.methods.fireErrorToast();
            });

            commit("assignApiData", Data.data);
            commit("closeLoader", null, { root: true });
        },
    },
};
