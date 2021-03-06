import { mapState, mapActions, mapMutations } from "vuex";
import usersTable from "../../../components/admins/pages/users/usersTable.vue";
import usersHeader from "../../../components/admins/pages/users/usersHeader.vue";
import usersSaveDialog from "../../../components/admins/pages/users/usersSaveDialog.vue";
export default {

    components: {
        usersTable,
        usersHeader,
        usersSaveDialog,
    },
    name: "admins",


    created () {
       this.$store.commit("openLoader");
    },

    mounted() {
        this.admins.length ?this.dataIsFetched(): this.fetch();
    },

    computed: {
        ...mapState(
            "admins",

            ["headers", "admins", "deleteSnackbar" , "showContent"]
        ),

    },

    methods: {
        ...mapActions("admins", {
            fetch: "fetch",
            destroy: "delete",
            updateStatus: 'updateStatus',
        }),

        ...mapMutations("admins", [
            "openSaveDialog",
            "editItem",
            "showDeleteSnackbar",
            "closeDeleteSnackbar",
            "setSearchValue",
        ]),

        dataIsFetched () {
           console.log("data fetched");
           this.$store.commit("closeLoader");
        }
    },
};
