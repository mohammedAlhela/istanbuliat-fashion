import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);
// admins pagess
import admins from "./moduels/admins/users";
import dashboard from "./moduels/admins/dashboard";
import sliders from "./moduels/admins/sliders";
import categories from "./moduels/admins/categories";
import subCategories from "./moduels/admins/subCategories";
import colors from "./moduels/admins/colors";
import sizes from "./moduels/admins/sizes";
import tags from "./moduels/admins/tags";
import products from "./moduels/admins/products";
import variations from "./moduels/admins/variations";
import productColorImages from "./moduels/admins/productColorImages";
import sizeGuides from "./moduels/admins/sizeGuides";
import productColors from "./moduels/admins/productColors";

// admins pagess

export default new Vuex.Store({
    modules: {
        // admins pagess
        admins,
        sliders,
        categories,
        colors,
        sizes,
        products,
        variations,
        productColorImages,
        sizeGuides,
        dashboard,
        subCategories,
        tags,
        productColors,
        // admins pagess
    },

    state() {
        return {
            loading: true,
        };
    },

    mutations: {
        closeLoader: (state) => {
            state.loading = false;
        },

        openLoader: (state) => {
            state.loading = true;
        },
    },
});
