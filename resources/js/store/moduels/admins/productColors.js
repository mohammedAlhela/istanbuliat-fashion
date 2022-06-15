export default {
    namespaced: true,

    state() {
        return {
            dialog: false,
            activeColor : { 
                id : "" , 
                name : "",
                images : []
            },

            activeProduct : { 
                id : "",
                name : ""
            }, 

            productColorEditIndex : -1
        };
    },

    getters: {
        getUniqueColors: (state) => (colors) => {
            let uniqueColors = [];
            let colorsIndexInUniqueArray = -1;

            colors.forEach((color) => {
                colorsIndexInUniqueArray = uniqueColors.findIndex(function (
                    item
                ) {
                    return item.id == color.id;
                });

                if (colorsIndexInUniqueArray == -1) {
                    uniqueColors.push(color);
                }
            });

            return uniqueColors;
        }, 


        getColorImagesForDialog  : (state, getters, rootState, rootGetters) => { 

            if(state.activeColor.id && state.activeProduct.id) { 
     
                let productIndex =    rootState.products.products.findIndex(function (product) {
                    return product.id == state.activeProduct.id;
                });

                let product = rootState.products.products[productIndex]

                let colors = product.colors 

                let colorIndex =  colors.findIndex(function (color) {
                    return color.id == state.activeColor.id;
                });

                let color = colors[colorIndex]


                return color.images
          
            }


            else  { 
    return []
            }
    
      



        }
    },

    mutations: {
        manageProductColors: (state, item) => {

            state.activeProduct = Object.assign({}, item);

            state.dialog = true;
        },
        closeDialog: (state) => {
            state.dialog = false;
        },
    },

    actions: {
        closeDialogAction({ commit }) {
            commit("closeDialog");
            setTimeout(() => {
                commit("products/closeData", null, { root: true });
            }, 200);
        },

        manageProductColorImages({ state, commit }, item) {
            state.productColorEditIndex = item.id;
            state.activeColor = Object.assign({}, item);

            let dataObject = {
         
            };

            dataObject.activeProduct = Object.assign({}, state.activeProduct)


            dataObject.activeColor = Object.assign({}, state.activeColor)


            commit("productColorImages/manageImages", dataObject, {
                root: true,
            });
       
        },
    },
};
