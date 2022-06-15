
import { mapState, mapActions, mapGetters ,  mapMutations } from 'vuex'
import categoriesTable from '../../../components/admins/pages/categories/categoriesTable.vue'
import categoriesHeader from '../../../components/admins/pages/categories/categoriesHeader.vue'
import categoriesSaveDialog from '../../../components/admins/pages/categories/categoriesSaveDialog.vue'
import SubCategoriesMainDialog from '../../../components/admins/pages/categories/SubCategoriesMainDialog.vue'
export default {
  components: {
    categoriesTable,
    categoriesHeader,
    categoriesSaveDialog,
    SubCategoriesMainDialog
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

      ['headers', 'categories', 'deleteSnackbar', 'showContent' , "blockDeleteSnackbar" , "blockDeleteReport"  , 'categories' , 'subCategoriesEditIndex']
    ),


    ...mapGetters(
      'categories',

      ['datatableIndex']
    ),

  },

  methods: {
    ...mapActions('categories', {
      fetch: 'fetch',
      destroy: 'delete',
      updateStatus: 'updateStatus',
      manageSubCategories: 'manageSubCategories',
      

    }),

    ...mapMutations('categories', [
      'openSaveDialog',
      'editItem',
      'showDeleteSnackbar',
      "closeBlockDeleteSnackbar",
      'closeDeleteSnackbar',
    ]),

    dataIsFetched () {
        this.$store.commit("closeLoader");
     }

  },
}
