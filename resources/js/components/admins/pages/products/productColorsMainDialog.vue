<template>
    <div>
        <v-dialog persistent v-if="editedIndex > -1" v-model="dialog" fullscreen transition="dialog-bottom-transition">

            <v-card class="variations-dialog-container size-guides-section" flat>

                <v-toolbar dark color="blue">
                    <v-btn icon @click="closeDialogAction()" class="no-focus">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title>
                        manage product images
                    </v-toolbar-title>

                    <v-spacer> </v-spacer>

                </v-toolbar>
                <v-card-text v-if="getUniqueColors(products[datatableIndex]
                .colors)">

                    <v-card class="variation-card " v-for="(color, index) in getUniqueColors(products[datatableIndex]
                    .colors)" :key="index">
                        <v-card-text class="p-0" >
                            <div class="informations-holder">
                                <div class="header size-card-header ">
                                    Color :
                                    <span class="paragraph">
                                        {{ color.name }}
                                    </span>
                                </div>

                                <div class="p-2 pt-0">
                                    <v-chip @click="manageProductColorImages(color)" class="ma-2" small label
                                        color="#ebebeb">
                                        <span class=""> Manage Images {{ color.images.length }} </span>
                                    </v-chip>
                                </div>
                            </div>


                            <div class="clearing"></div>
                        </v-card-text>
                    </v-card>
                </v-card-text>

                <v-card-text v-else class="mt-5">
                    <span class="header"> No colors inside this product </span>
                </v-card-text>

      

             <product-color-images-main-dialog :images = "getColorImagesForDialog" :productColorEditIndex = "productColorEditIndex" >

                </product-color-images-main-dialog> 

                <div class="clearing"></div>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
import { mapState, mapActions, mapGetters } from "vuex";
 import productColorImagesMainDialog from "./productColorImagesMainDialog.vue";
export default {
    components: {
         productColorImagesMainDialog,
    },

    props: ["datatableIndex", "products", "editedIndex"],
    name: "productColorsMainDialog",

    computed: {
        ...mapState(
            "productColors",

            ["dialog" , "productColorEditIndex"]
        ),

        ...mapGetters(
            "productColors",

            ["getUniqueColors" , "getColorImagesForDialog"]
        ),


    },

    methods: {
        ...mapActions("productColors", {
            closeDialogAction: 'closeDialogAction',

            manageProductColorImages: 'manageProductColorImages'
        }),

    },
};
</script>
