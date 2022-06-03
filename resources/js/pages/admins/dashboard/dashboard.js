import { mapState, mapActions } from 'vuex'
import informationsCards from '../../../components/admins/pages/dashboard/informationsCards.vue'
import dataCharts from '../../../components/admins/pages/dashboard/dataCharts.vue'
import ordersAndSubscribers from '../../../components/admins/pages/dashboard/ordersAndSubscribers.vue'
export default {
  name: 'AdminsDashboard',

  components: {
    informationsCards,
    dataCharts,
    ordersAndSubscribers,
  },

  created () {
    this.$store.commit("openLoader");
 },
 mounted() {
  this.products.length ?this.dataIsFetched(): this.fetch();
},

  computed: {
    ...mapState(
      'dashboard',

      ['products', 'subscribers', 'admins' , 'showContent' , 'customers']
    ),

  },



  methods: {
    ...mapActions('dashboard', {
      fetch: 'fetch',

    }),

    dataIsFetched () {
        this.$store.commit("closeLoader");
     }

  },




  
}
