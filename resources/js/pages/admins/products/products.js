import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
import productsTable from "../../../components/admins/pages/products/productsTable.vue";
import productsHeader from "../../../components/admins/pages/products/productsHeader.vue";
import productsSaveDialog from "../../../components/admins/pages/products/productsSaveDialog.vue";
import variationsMainDialog from "../../../components/admins/pages/products/variationsMainDialog.vue";
import sizeGuidesMainDialog from "../../../components/admins/pages/products/sizeGuidesMainDialog";
import productColorsMainDialog from "../../../components/admins/pages/products/productColorsMainDialog";

export default {
    components: {
        productsTable,
        productsHeader,
        productsSaveDialog,
        variationsMainDialog,
        sizeGuidesMainDialog ,
        productColorsMainDialog
        
    },
    name: "Adminsproducts",

    mounted() {
        this.products.length ? console.log("data fetched") : this.fetch();
    },

    computed: {
        ...mapState("products", {
            products: "products",
            showContent: "showContent",
            deleteSnackbar: "deleteSnackbar",
            colors: "colors",
            sizes: "sizes",
            tags: "tagsRecords",
            editedIndex: "editedIndex",
            categories: "categories",
        }),

        ...mapGetters("products", ["filteredProducts", "datatableIndex"]),
    },

    methods: {
        ...mapActions("products", {
            fetch: "fetch",
            destroy: "delete",
        }),

        ...mapMutations("products", ["openSaveDialog", "closeDeleteSnackbar" ,]),
    },
};
