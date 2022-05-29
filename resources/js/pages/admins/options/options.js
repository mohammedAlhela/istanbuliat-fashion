import colors from '../../../components/admins/pages/options/colors.vue'
import sizes from '../../../components/admins/pages/options/sizes.vue'

export default {
    components: {
        colors,
        sizes
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
            this.closeLoader()
        } else {
            this.closeLoader()
        }
    },

    methods: {
        closeLoader () {
            this.$store.commit('closeLoader')
            setTimeout(() => {
                this.showContent = true
            }, 300)
        }
    }
}
