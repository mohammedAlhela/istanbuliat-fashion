
import { mapState, mapGetters, mapActions, mapMutations } from 'vuex'
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

      ['headers', 'categories', 'deleteSnackbar', 'showContent' , "blockDeleteSnackbar" , "blockDeleteReport"]
    ),

  },

  methods: {
    ...mapActions('categories', {
      fetch: 'fetch',
      destroy: 'delete',
      updateType: 'updateType',

    }),

    ...mapMutations('categories', [
      'openSaveDialog',
      'editItem',
      'showDeleteSnackbar',
      "closeBlockDeleteSnackbar",
      'closeDeleteSnackbar',
    ]),

    dataIsFetched () {
        console.log("data fetched");
        this.$store.commit("closeLoader");
     }

  },
}
