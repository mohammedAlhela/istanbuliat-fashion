<template>
    <div class="overflow-products-table">
        <v-data-table
            :headers="headers"
            :items="filteredProducts"
            :items-per-page="10"
            item-key="item.id"
            mobile-breakpoint="10"
            class="datatable"
        >
            <template v-slot:header.name="{ header }">
                {{ header.text }}
                <v-menu offset-y :close-on-content-click="false">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn class="no-focus" icon v-bind="attrs" v-on="on">
                            <v-icon small :color="name ? 'primary' : ''">
                                mdi-filter
                            </v-icon>
                        </v-btn>
                    </template>
                    <div style="background-color: white; width: 280px">
                        <v-text-field
                            :value="name"
                            @input="fillfilterValues('name', $event)"
                            class="pa-4"
                            type="text"
                            label="Enter the search term"
                        ></v-text-field>
                        <v-btn
                            @click="resetNameFilter()"
                            small
                            text
                            color="primary"
                            class="ml-2 mb-2"
                            >Clean</v-btn
                        >
                    </div>
                </v-menu>
            </template>

            <template v-slot:header.price="{ header }">
                {{ header.text }}
                <v-menu offset-y :close-on-content-click="false">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn class="no-focus" icon v-bind="attrs" v-on="on">
                            <v-icon small :color="name ? 'primary' : ''">
                                mdi-filter
                            </v-icon>
                        </v-btn>
                    </template>
                    <div style="background-color: white; width: 280px">
                        <v-text-field
                            :value="price"
                            @input="fillfilterValues('price', $event)"
                            class="pa-4"
                            type="text"
                            label="Enter the search term"
                        ></v-text-field>
                        <v-btn
                            @click="resetPriceFilter()"
                            small
                            text
                            color="primary"
                            class="ml-2 mb-2"
                            >Clean</v-btn
                        >
                    </div>
                </v-menu>
            </template>

            <template v-slot:header.category="{ header }">
                {{ header.text }}

                <span v-if="category.id">
                    <v-btn class="no-focus" icon @click="resetCategoryFilter()">
                        <v-icon>mdi-cached</v-icon>
                    </v-btn>
                </span>
            </template>

            <template v-slot:header.status="{ header }">
                {{ header.text }}

                <span v-if="statusIsFiltered">
                    <v-btn class="no-focus" icon @click="closeStatusFilter()">
                        <v-icon>mdi-cached</v-icon>
                    </v-btn>
                </span>
            </template>

            <template v-slot:header.trend="{ header }">
                {{ header.text }}

                <span v-if="trendIsFiltered">
                    <v-btn class="no-focus" icon @click="closeTrendFilter()">
                        <v-icon>mdi-cached</v-icon>
                    </v-btn>
                </span>
            </template>

            <template v-slot:header.featured="{ header }">
                {{ header.text }}

                <span v-if="featuredIsFiltered">
                    <v-btn class="no-focus" icon @click="closeFeaturedFilter()">
                        <v-icon>mdi-cached</v-icon>
                    </v-btn>
                </span>
            </template>

            <template v-slot:item.image="{ item }">
                <td class="p-2 pl-5">
                    <img :src="item.image" alt="no image" class="image" />
                    <br />
                </td>
            </template>

            <template v-slot:item.name="{ item }">
                <td class="p-2">
                    <span class="sku" style="font-size: 12px; color: darkgrey">
                        {{ item.sku }}
                    </span>
                    <br />
                    {{ item.name }} <br />

                    <span class="items-snackbar-span mt-1">
                        {{ item.variations.length }} Variations</span
                    >

                </td>
            </template>

            <template v-slot:item.category="{ item }">
                <td class="p-2">
                    <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                            <span v-bind="attrs" v-on="on">
                                <span
                                    class="light-snackbar-span"
                                    @click="addActiveCategory(item)"
                                >
                                    {{ item.category.name }}
                                </span>
                            </span>
                        </template>
                        <span> Product category </span>
                    </v-tooltip>
                </td>
            </template>

            <template v-slot:item.price="{ item }">
                <td>
                    <span v-if="item.discount_price"
                        >AED {{ item.selling_price }} =>
                        {{ item.price }}
                    </span>
                    <span v-else>AED {{ item.price }} </span>
                </td>
            </template>

            <template v-slot:item.trend="{ item }">
                <td class="p-2">
                    <span
                        @click="filterTrend(item)"
                        v-html="getTrendItem(item)"
                    ></span>

                    <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                            <span v-bind="attrs" v-on="on">
                                <v-icon
                                    @click="
                                        localUpdateStatusOrFeaturedOrTrend(
                                            item,
                                            'updateTrend'
                                        )
                                    "
                                    class="ml-2 icon"
                                >
                                    mdi-swap-horizontal-bold
                                </v-icon>
                            </span>
                        </template>
                        <span> Change Trend Status </span>
                    </v-tooltip>
                </td>
            </template>

            <template v-slot:item.featured="{ item }">
                <td class="p-2">
                    <span
                        @click="filterFeatured(item)"
                        v-html="getFeaturedItem(item)"
                    ></span>

                    <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                            <span v-bind="attrs" v-on="on">
                                <v-icon
                                    @click="
                                        localUpdateStatusOrFeaturedOrTrend(
                                            item,
                                            'updateFeatured'
                                        )
                                    "
                                    class="ml-2 icon"
                                >
                                    mdi-swap-horizontal-bold
                                </v-icon>
                            </span>
                        </template>
                        <span> Change Featured Status </span>
                    </v-tooltip>
                </td>
            </template>

            <template v-slot:item.status="{ item }">
                <td class="p-2">
                    <span
                        @click="filterStatus(item)"
                        v-html="getStatusItem(item)"
                    ></span>

                    <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                            <span v-bind="attrs" v-on="on">
                                <v-icon
                                    @click="
                                        localUpdateStatusOrFeaturedOrTrend(
                                            item,
                                            'updateStatus'
                                        )
                                    "
                                    class="ml-2 icon"
                                >
                                    mdi-swap-horizontal-bold
                                </v-icon>
                            </span>
                        </template>
                        <span> Change Availability Status </span>
                    </v-tooltip>
                </td>
            </template>

            <template v-slot:item.actions="{ item }">
                <!-- actions -->
                <td class="paragraph">
                    <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                            <span v-bind="attrs" v-on="on">
                                <v-icon
                                    @click="editItem(item)"
                                    class="mr-2 icon"
                                >
                                    mdi-pencil
                                </v-icon>
                            </span>
                        </template>
                        <span> edit product </span>
                    </v-tooltip>

                    <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                            <span v-bind="attrs" v-on="on">
                                <v-icon
                                    @click="showDeleteSnackbar(item)"
                                    class="mr-2 icon"
                                >
                                    mdi-delete
                                </v-icon>
                            </span>
                        </template>
                        <span> delete product </span>
                    </v-tooltip>

                    <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                            <span v-bind="attrs" v-on="on">
                                <v-icon
                                    @click="manageVariations(item)"
                                    class="mr-2 icon variation-icon"
                                >
                                    mdi-file-multiple
                                </v-icon>
                            </span>
                        </template>
                        <span> Manage product variations </span>
                    </v-tooltip>


                                   <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                            <span v-bind="attrs" v-on="on">
                                <v-icon
                                    @click="manageSizeGuides(item)"
                                    class="mr-2 icon variation-icon"
                                >
                                    mdi-ruler-square-compass
                                </v-icon>
                            </span>
                        </template>
                        <span> Manage product size guide </span>
                    </v-tooltip>


                    <!-- actions -->
                </td>
            </template>
        </v-data-table>
    </div>
</template>

<script>
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
export default {
    name: "ProductsTable",
    computed: {
        ...mapState(
            "products",

            {
                name: "name",
                price: "price",
                headers: "headers",

                tag: "tag",
                category: "category",

                statusIsFiltered: "statusIsFiltered",
                featuredIsFiltered: "featuredIsFiltered",
                trendIsFiltered: "trendIsFiltered",
                status: "status",
                featured: "featured",
            }
        ),

        ...mapGetters("products", ["filteredProducts"]),
    },

    methods: {
        ...mapActions("products", {
            manageVariations: "manageVariations",
    manageSizeGuides: "manageSizeGuides",
            
            updateStatusOrFeaturedOrTrend: "updateStatusOrFeaturedOrTrend",
        }),

        ...mapMutations("products", [
            "editItem",
            "showDeleteSnackbar",
            "addActiveCategory",
            "closeStatusFilter",
            "closeFeaturedFilter",
            "closeTrendFilter",

            "resetCategoryFilter",
            "filterFeatured",
            "filterStatus",
            "filterTrend",
            "setFilterValues",
            "resetNameFilter",
            "resetPriceFilter",
            "addActiveTag",
            "resetTagFilter",
        ]),

        fillfilterValues(type, value) {
            let dataObject = {
                variableType: type,
                e: value,
            };
            this.setFilterValues(dataObject);
        },

        localUpdateStatusOrFeaturedOrTrend(item, type) {
            if (type === "updateFeatured") {
                item.updateFeatured = true;
                item.updateStatus = false;
                item.updateTrend = false;
            } else if (type == "updateStatus") {
                item.updateStatus = true;

                item.updateFeatured = false;

                item.updateTrend = false;
            } else {
                item.updateTrend = true;

                item.updateStatus = false;

                item.updateFeatured = false;
            }

            this.updateStatusOrFeaturedOrTrend(item);
        },

        getFeaturedItem(item) {
            let activeClass = "";
            return item.featured
                ? `<span class = 'hovered-paragraph ${activeClass}'> Featured </span>  `
                : `<span class = 'hovered-paragraph'> Sale </span>  `;
        },

        getStatusItem: (item) => {
            let activeClass = "";

            return item.status
                ? `<span class = 'hovered-paragraph ${activeClass}'> Active </span>`
                : `<span class = 'hovered-paragraph ${activeClass}'> Non Active </span>`;
        },

        getTrendItem: (item) => {
            let activeClass = "";

            return item.trend
                ? `<span class = 'hovered-paragraph ${activeClass}'> Trend </span>`
                : `<span class = 'hovered-paragraph ${activeClass}'> Non Trend </span>`;
        },
    },
};
</script>
