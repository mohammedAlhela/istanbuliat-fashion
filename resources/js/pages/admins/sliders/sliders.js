
import { mapState, mapGetters, mapActions, mapMutations } from 'vuex'
import slidersTable from '../../../components/admins/pages/sliders/slidersTable.vue'
import slidersHeader from '../../../components/admins/pages/sliders/slidersHeader.vue'
import slidersSaveDialog from '../../../components/admins/pages/sliders/slidersSaveDialog.vue'
export default {
  components: {
    slidersTable,
    slidersHeader,
    slidersSaveDialog,
  },
  name: 'AdminsSliders',


  created () {
    this.$store.commit("openLoader");
 },

  mounted() {
    this.sliders.length ?this.dataIsFetched(): this.fetch();
  },

  computed: {
    ...mapState(
      'sliders',

      ['headers', 'sliders', 'deleteSnackbar' , 'showContent']
    ),

    ...mapGetters('sliders', ['filteredAdmins']),
  },

  methods: {
    ...mapActions('sliders', {
      fetch: 'fetch',
      destroy: 'delete',
      updateStatus: 'updateStatus',
    }),

    ...mapMutations('sliders', [
      'openSaveDialog',
      'editItem',
      'showDeleteSnackbar',
      'closeDeleteSnackbar',
    ]),

    dataIsFetched () {
        console.log("data fetched");
        this.$store.commit("closeLoader");
     }

  },
}
