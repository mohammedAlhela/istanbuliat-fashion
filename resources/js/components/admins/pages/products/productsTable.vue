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
                            label="Name"
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
                            :value="minPrice"
                            @input="fillfilterValues('minPrice', $event)"
                            class="pa-4 pb-0"
                            type="text"
                            label="Min Price"
                        ></v-text-field>

                        <v-text-field
                            :value="maxPrice"
                            @input="fillfilterValues('maxPrice', $event)"
                            class="pa-4 pt-0"
                            type="text"
                            label="Max Price"
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
                <v-menu offset-y :close-on-content-click="false">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn class="no-focus" icon v-bind="attrs" v-on="on">
                            <v-icon small :color="category.id ? 'primary' : ''">
                                mdi-filter
                            </v-icon>
                        </v-btn>
                    </template>
                    <div style="background-color: white; width: 280px">
                        <v-autocomplete
                            :items="categories"
                            item-text="name"
                            item-value="id"
                            return-object
                            :value="category"
                            @input="fillfilterValues('category', $event)"
                            label="Category Name"
                            class="pa-4"
                        ></v-autocomplete>

                        <v-btn
                            @click="resetCategoryFilter()"
                            small
                            text
                            color="primary"
                            class="ml-2 mb-2"
                            >Clean</v-btn
                        >
                    </div>
                </v-menu>
            </template>

            <template v-slot:header.status="{ header }">
                {{ header.text }}

                <span v-if="statusIsFiltered">
                    <v-btn class="no-focus" icon @click="closeStatusFilter()">
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
                                        updateStatus(
                                            item.id
                                         
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
                minPrice: "minPrice",
                maxPrice: "maxPrice",
                headers: "headers",
                category: "category",
                statusIsFiltered: "statusIsFiltered",
                status: "status",
                categories: "categories",
            }
        ),

        ...mapGetters("products", ["filteredProducts"]),
    },

    methods: {
        ...mapActions("products", {
            manageVariations: "manageVariations",
            manageSizeGuides: "manageSizeGuides",

            updateStatus: "updateStatus",
        }),

        ...mapMutations("products", [
            "editItem",
            "showDeleteSnackbar",
            "closeStatusFilter",
            "resetCategoryFilter",
            "filterStatus",
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



        getStatusItem: (item) => {
            let activeClass = "";

            return item.status
                ? `<span class = 'hovered-paragraph ${activeClass}'> Active </span>`
                : `<span class = 'hovered-paragraph ${activeClass}'> Non Active </span>`;
        },
    },
};
</script>
