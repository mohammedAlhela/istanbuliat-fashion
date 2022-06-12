import toasts from "../../../mixins/toasts";
export default {
    namespaced: true,

    state() {
        return {
            products: [],
            admins : [],
            subscribes : [],
            customers : [],
            showContent: false,
        };
    },


    mutations: {
        assignApiData: (state, dataObject) => {
            state.products = dataObject.products;
            state.customers = dataObject.customers;
            
            state.admins = dataObject.admins;
            state.subscribes = dataObject.subscribes;
           
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
