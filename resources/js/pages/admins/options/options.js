import colors from '../../../components/admins/pages/options/colors.vue'
import sizes from '../../../components/admins/pages/options/sizes.vue'
import tags from '../../../components/admins/pages/options/tags.vue'
export default {
    components: {
        colors,
        sizes ,
        tags
     
    },
    name: 'ProductsOptions',

    created () {
        this.$store.commit('openLoader')
    },

    data () {
        return {
            showContent: false
        }
    },

    async mounted () {
        if (!this.$store.state.colors.colors.length) {
            const COLORS = await this.$store.dispatch('colors/fetch')
            const SIZES = await this.$store.dispatch('sizes/fetch')
             const TAGS = await this.$store.dispatch('tags/fetch')
            this.closeLoader()
        } else {
            this.closeLoader()
        }
    },

    methods: {
        closeLoader () {
            this.$store.commit('closeLoader')
                this.showContent = true
        }
    }
}
