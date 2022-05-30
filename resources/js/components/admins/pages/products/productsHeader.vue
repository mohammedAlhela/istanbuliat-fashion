<template>
    <div class="row">
        <div class="col-12 col-md-6 left-header-section">
            <v-tooltip top>
                <template v-slot:activator="{ on, attrs }">
                    <span v-bind="attrs" v-on="on" class="main-header">
                        {{ filteredProducts.length }} Products
                    </span>
                </template>
                <span> Products number </span>
            </v-tooltip>

            
           
                               <v-chip class="ma-2"  small label color="#ebebeb">
                    <a href="/admins/excel/export" >
                        <span class=""> Export Excel </span>
                    </a>
                </v-chip>




        </div>

        <div class="right-header-section col-12 col-md-6">
            <v-tooltip top>
                <template v-slot:activator="{ on, attrs }">
                    <span v-bind="attrs" v-on="on">
                        <span>
                            <v-chip
                                small
                                class="ma-2"
                                dark
                                label
                                color="#707ae7"
                            >
                                <span class="f">
                                    {{ colors.length }} Colors
                                </span>
                            </v-chip>
                        </span>
                    </span>
                </template>
                <span class="d-inline-block w-100" v-if="colors.length">
                    <span
                        class="d-block m-1"
                        v-for="(item, index) in colors"
                        :key="index"
                    >
                        {{ item.name }}
                    </span>
                </span>

                <span v-else> No data </span>
            </v-tooltip>

            <v-tooltip top>
                <template v-slot:activator="{ on, attrs }">
                    <span v-bind="attrs" v-on="on">
                        <span class="">
                            <v-chip
                                small
                                class="ma-2"
                                dark
                                label
                                color="#e3986d"
                            >
                                <span class=""> {{ sizes.length }} Sizes </span>
                            </v-chip>
                        </span>
                    </span>
                </template>
                <span class="d-inline-block w-100" v-if="sizes.length">
                    <span
                        class="d-block mx-1"
                        v-for="(item, index) in sizes"
                        :key="index"
                    >
                        {{ item.name }}
                    </span>
                </span>

                <span v-else> No data </span>
            </v-tooltip>

            <v-tooltip top>
                <template v-slot:activator="{ on, attrs }">
                    <span v-bind="attrs" v-on="on">
                        <span class="">
                            <v-chip
                                small
                                class="ma-2"
                                label
                                dark
                                color="#85dddd"
                            >
                                <span class=""> {{ tags.length }} Tags </span>
                            </v-chip>
                        </span>
                    </span>
                </template>
                <span class="d-inline-block w-100" v-if="tags.length">
                    <span
                        class="d-block mx-1"
                        v-for="(item, index) in tags"
                        :key="index"
                    >
                        {{ item.name }}
                    </span>
                </span>

                <span v-else> No data </span>
            </v-tooltip>

            <span class="ml-3">
                <v-tooltip top>
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            class="no-focus add-button"
                            color="success"
                            fab
                            v-bind="attrs"
                            v-on="on"
                            x-small
                            dark
                            @click="$emit('openSaveDialog')"
                        >
                            <v-icon> mdi-plus </v-icon>
                        </v-btn>
                    </template>
                    <span> Add new product </span>
                </v-tooltip>
            </span>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProductsHeader",
    props: {
        filteredProducts: {
            required: true,
            type: Array,
        },
        tags: {
            required: true,
            type: Array,
        },

        sizes: {
            required: true,
            type: Array,
        },

        colors: {
            required: true,
            type: Array,
        },
    },
};
</script>
