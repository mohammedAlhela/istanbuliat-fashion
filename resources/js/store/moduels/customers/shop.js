import toasts from '../../../mixins/toasts'
export default {
    namespaced: true,

    state () {
        return {
            products: [],
            totalProductsNumber: 0,

            sizes: [],
            colors: [],
            categories: [],
            showContent: false,

            filter: {
                name: '',

                offers: false,
                colors: [],
                sizes: [],

                category: {
                    id: '',
                    name: ''
                },

                defaultCategory: {
                    id: '',
                    name: ''
                },

                minPrice: 20,
                maxPrice: 100,

                exactMinPrice: '',
                exactMaxPrice: '',

                resetSize: '',
                resetColor: ''
            },

            // pagination
            myPage: 1,
            myPageSize: 12,
            paginatedProducts: []
        }
    },

    mutations: {
        // go to product

        productDetails: (state, slug) => {
            window.location.replace(`/product/${slug}`)
        },

        filterCategoryFromOutside: (state, category) => {
            window.location.replace(`/shop?category=${category.name}`)
        },
        // go to product

        assignApiData: (state, response) => {
            state.products = response.products
            state.totalProductsNumber = response.products.length
            state.categories = response.categories

            state.sizes = response.sizes
            state.colors = response.colors
            state.products.forEach(item => {
                item.created_at = new Date(item.created_at)
            })

            setTimeout(() => {
                state.showContent = true
            }, 200)
        },

        assignPriceData: (state, priceRange) => {
            state.filter.minPrice = priceRange[0]
            state.filter.maxPrice = priceRange[1]
        },

        filterCategoriesFromCategoryName: (state, name) => {
            let category
            let ItemIndex = state.categories.findIndex(cat => {
                return cat.name === name
            })

            category = state.categories[ItemIndex]

            state.filter.category = Object.assign({}, category)

            let index

            index = state.categories.findIndex(item => {
                return item.id === category.id
            })

            state.filter.openedCategoryIndex = index
        },

        filterProductsFromProductName: (state, name) => {
            state.filter.name = name
        },

        resetFilter: state => {
            state.filter.openedCategoryIndex = null
            state.filter.name = ''
            state.filter.offers = false
            state.filter.category = Object.assign(
                {},
                state.filter.defaultCategory
            )

            state.filter.colors = []
            state.filter.sizes = []

            state.filter.exactMaxPrice = ''
            state.filter.exactMinPrice = ''
        },

        resetCategoriesFilter: state => {
            state.filter.category = Object.assign(
                {},
                state.filter.defaultCategory
            )
        },

        resetPricesFilter: state => {
            state.filter.exactMaxPrice = ''
            state.filter.exactMinPrice = ''
        },

        resetSizesFilter: state => {
            state.filter.sizes = []
            state.filter.resetSize = ''
        },

        resetColorsFilter: state => {
            state.filter.colors = []
            state.filter.resetColor = ''
        },

        addActiveCategory: (state, category) => {
            if (category.id != state.filter.category.id) {
                console.log('add active')

                state.filter.category = Object.assign({}, category)

                let index

                index = state.categories.findIndex(item => {
                    return item.id === category.id
                })
            } else {
                console.log('remove active')

                state.filter.category = Object.assign({}, state.defaultCategory)
            }
        },

        filterCategoriesFromCategoryName: (state, name) => {
            let category
            let ItemIndex = state.categories.findIndex(cat => {
                return cat.name === name
            })

            category = state.categories[ItemIndex]

            state.filter.category = Object.assign({}, category)

            let index

            index = state.categories.findIndex(item => {
                return item.id === category.id
            })
        },

        addActiveSize: (state, size) => {
            let index = state.filter.sizes.indexOf(size)

            if (index === -1) {
                state.filter.sizes.push(size)
            } else {
                state.filter.sizes.splice(index, 1)
            }
        },

        addActiveColor: (state, color) => {
            let index = state.filter.colors.indexOf(color)

            if (index === -1) {
                state.filter.colors.push(color)
            } else {
                state.filter.colors.splice(index, 1)
            }
        },

        sortProducts: (state, type) => {
            if (type == 'Price Low To Height') {
                state.products = state.products.slice().sort(function (a, b) {
                    return a.exact_price - b.exact_price
                })
            } else if (type == 'Price Height To Low') {
                state.products = state.products.slice().sort(function (a, b) {
                    return b.exact_price - a.exact_price
                })
            } else if (type == 'Best Selling') {
                state.products = state.products.slice().sort(function (a, b) {
                    return b.orders_number - a.orders_number
                })
            } else if (type == 'New Arrivals') {
                state.products = state.products.slice().sort(function (a, b) {
                    return b.created_at - a.created_at
                })
            }
        },

        applyPriceFilter: state => {
            state.filter.exactMaxPrice = state.filter.maxPrice
            state.filter.exactMinPrice = state.filter.minPrice
        },

        applyOffersFilter: (state, data) => {
            state.filter.offers = data
        }
    },

    getters: {
        canResetAll: state => {
            let filter = state.filter
            return (
                filter.category.id ||
                filter.sizes.length ||
                filter.colors.length ||
                filter.name ||
                filter.offers ||
                filter.exactMaxPrice ||
                filter.exactMinPrice
            )
        },

        canResetCategoriesFilter: state => {
            return state.filter.category.id
        },

        canResetSizesFilter: state => {
            return state.filter.sizes.length
        },

        canResetColorsFilter: state => {
            return state.filter.colors.length
        },

        canResetPricesFilter: state => {
            return state.filter.exactMaxPrice || state.filter.exactMinPrice
        },

        filteredProducts: (state, getters) => {
            let conditions = []

            if (state.filter.name) {
                conditions.push(getters.filterName)
            }

            if (state.filter.category.id) {
                conditions.push(getters.filterCategory)
            }

            if (state.filter.offers) {
                conditions.push(getters.filterOffers)
            }

            if (state.filter.sizes.length) {
                conditions.push(getters.filterSize)
            }

            if (state.filter.colors.length) {
                conditions.push(getters.filterColor)
            }

            if (state.filter.exactMinPrice && state.filter.exactMaxPrice) {
                conditions.push(getters.filterRangePrice)
            }

            if (conditions.length > 0) {
                return state.products.filter(product => {
                    return conditions.every(condition => {
                        return condition(product)
                    })
                })
            }

            return state.products
        },

        filterName: state => item => {
            return item.slug
                .toLowerCase()
                .includes(state.filter.name.toLowerCase())
        },

        filterOffers: state => item => {
            if (state.filter.offers === 'all') {
                return item.discount_price > 0
            } else {
                return (
                    ((item.selling_price - item.discount_price) * 100) /
                        item.selling_price <=
                    state.filter.offers
                )
            }
        },

        filterCategory: state => item => {
            return (item.category_id + '')
                .toString()
                .includes(state.filter.category.id)
        },

        filterSize: state => item => {
            let productSizes = item.relatedSizes
            let activeSizes = state.filter.sizes
            let productIsExist = 0

            productSizes.forEach(item => {
                activeSizes.forEach(activeSize => {
                    item.name === activeSize.name ? (productIsExist = true) : ''
                })
            })

            console.log(productIsExist)

            return productIsExist
        },

        filterColor: state => item => {
            let productColors = item.relatedColors
            let activeColors = state.filter.colors
            let productIsExist = 0

            productColors.forEach(item => {
                activeColors.forEach(activeColor => {
                    item.name === activeColor.name
                        ? (productIsExist = true)
                        : ''
                })
            })

            console.log(productIsExist)

            return productIsExist
        },

        isCategoryActive: state => category => {
            return state.filter.category.id === category.id
        },

        isSizeActive: state => sizeObject => {
            let resultTruth = false

            state.filter.sizes.findIndex(function (size) {
                size.id == sizeObject.id ? (resultTruth = true) : ''
            })

            return resultTruth
        },

        isColorActive: state => colorObject => {
            let resultTruth = false

            state.filter.colors.findIndex(function (color) {
                color.id == colorObject.id ? (resultTruth = true) : ''
            })

            return resultTruth
        },

        filterRangePrice: state => item => {
            return (
                item.exact_price + '' >= parseInt(state.filter.exactMinPrice) &&
                item.exact_price + '' <= parseInt(state.filter.exactMaxPrice)
            )
        },

        // pagination
        pages: (state, getters) => {
            if (
                state.myPageSize == null ||
                getters.filteredProducts.length === 0
            ) {
                return 0
            }
            return Math.ceil(getters.filteredProducts.length / state.myPageSize)
        }
    },

    actions: {
        async fetch ({ state, commit, dispatch }) {
            try {
                const DATA = await axios.get('/shop/getData').then(response => {
                    commit('assignApiData', response.data)
                    dispatch('initPage')
                    dispatch('updatePage', state.myPage)
                    commit('closeLoader', null, { root: true })
                })
            } catch (error) {
                toasts.methods.fireErrorToast()
            }
        },

        initPage ({ state, getters }) {
            state.paginatedProducts = getters.filteredProducts.slice(
                0,
                state.myPageSize
            )
        },

        updatePage ({ state, getters }, index) {
            let myStart = (index - 1) * state.myPageSize
            let myEnd = index * state.myPageSize
            state.paginatedProducts = getters.filteredProducts.slice(
                myStart,
                myEnd
            )
            state.myPage = index
        }
    }
}
