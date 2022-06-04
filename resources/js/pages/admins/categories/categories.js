
import { mapState, mapActions, mapMutations  , mapGetters} from 'vuex'
import categoriesTable from '../../../components/admins/pages/categories/categoriesTable.vue'
import categoriesHeader from '../../../components/admins/pages/categories/categoriesHeader.vue'
import categoriesSaveDialog from '../../../components/admins/pages/categories/categoriesSaveDialog.vue'
export default {
  components: {
    categoriesTable,
    categoriesHeader,
    categoriesSaveDialog,
  },
  name: 'AdminsCategories',

  created () {
    this.$store.commit("openLoader");
 },
  mounted() {
    this.categories.length ?this.dataIsFetched(): this.fetch();
  },

  computed: {
    ...mapState(
      'categories',

      ['headers', 'categories', 'deleteSnackbar', 'showContent' , "blockDeleteSnackbar" , "blockDeleteReport" , "search"]
    ),

    ...mapGetters("categories", ["filteredCategories"]),

  },

  methods: {
    ...mapActions('categories', {
      fetch: 'fetch',
      destroy: 'delete',
      updateStatus: 'updateStatus',

    }),

    ...mapMutations('categories', [
      'openSaveDialog',
      'editItem',
      'showDeleteSnackbar',
      "closeBlockDeleteSnackbar",
      'closeDeleteSnackbar',
      "setSearchValue",
    ]),

    dataIsFetched () {
        console.log("data fetched");
        this.$store.commit("closeLoader");
     }

  },
}
