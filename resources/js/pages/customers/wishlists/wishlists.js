import { mapState, mapActions } from 'vuex'
export default {
    name: 'CustomerWishlists',


    mounted () {
        // this.$user && !this.wishlists.length
            this.fetch()
           
    },
    methods: {
        ...mapActions(
            'wishlists',

            ['fetch', 'delete']
        ),

        // filteredArray (arrayData) {
        //     const ids = arrayData.map(o => o.id)
        //     const filtered = arrayData.filter(
        //         ({ id }, index) => !ids.includes(id, index + 1)
        //     )

        //     return filtered
        // }
    },

    computed: {
        ...mapState(
            'wishlists',

            ['wishlists', 'showContent']
        )
    }
}
