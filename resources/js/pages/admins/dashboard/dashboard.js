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

data () {
    return {
     showContent : false ,
    }
},


created () {
    this.$store.commit("openLoader");
 },




  mounted () {
    setTimeout(() => {
        this.$store.commit("closeLoader");
        this.showContent = true;
    }, 1500)


  }
}
