<template>
    <div>
        <v-dialog persistent   v-if="editedIndex > -1" v-model="dialog" fullscreen transition="dialog-bottom-transition">

            <v-card class="variations-dialog-container size-guides-section" flat>

                <v-toolbar dark color="blue">
                    <v-btn icon @click="closeDialogAction()" class="no-focus">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title>
                        manage Sizes : (<span v-for="(size, index) in  getUniqueSizes(products[datatableIndex]
                        .sizes) " :key="index">
                            {{ size.name }}
                            <span v-if="getUniqueSizes(products[datatableIndex]
                            .sizes).length - index != 1">
                                ,</span> </span>)
                    </v-toolbar-title>

                    <v-spacer> </v-spacer>

                    <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn v-show="products[datatableIndex].size_guides.length < getUniqueSizes(products[datatableIndex]
                            .sizes).length" color="success" class="no-focus elevation-1" fab v-bind="attrs" v-on="on"
                                x-small dark @click="openSaveDialog()">
                                <v-icon> mdi-plus </v-icon>
                            </v-btn>
                        </template>
                        <span> Add new record </span>
                    </v-tooltip>
                </v-toolbar>

                <v-card-text v-if="products[datatableIndex].size_guides.length">

                    <v-card class="variation-card " v-for="(sizeGuide, index) in products[datatableIndex]
                    .size_guides" :key="index">
                        <v-card-text class="p-0">
                            <div class="informations-holder">
                                <div class="header size-card-header">
                                    Size :
                                    <span class="paragraph">
                                        {{ sizeGuide.size.name }}
                                    </span>
                                </div>

                                <div class="p-3 pt-0">
                                    <div class="header">
                                        bust :
                                        <span class="paragraph">
                                            {{ sizeGuide.bust }} cm
                                        </span>
                                    </div>

                                    <div class="header">
                                        shoulder :
                                        <span class="paragraph">
                                            {{ sizeGuide.shoulder }} cm
                                        </span>
                                    </div>

                                    <div class="header">
                                        wist :
                                        <span class="paragraph">
                                            {{ sizeGuide.wist }} cm
                                        </span>
                                    </div>

                                    <div class="header">
                                        hip :
                                        <span class="paragraph">
                                            {{ sizeGuide.hip }} cm
                                        </span>
                                    </div>

                                    <div class="header">
                                        length :
                                        <span class="paragraph">
                                            {{ sizeGuide.length }} cm
                                        </span>
                                    </div>

                                    <hr />

                                    <div class="text-right">
                                        <v-icon class="icon" @click="showDeleteSnackbar(sizeGuide)">
                                            mdi-delete
                                        </v-icon>

                                        <v-icon class="icon" @click="editItem(sizeGuide)">
                                            mdi-pencil
                                        </v-icon>
                                    </div>
                                </div>



                            </div>

                            <div class="clearing"></div>
                        </v-card-text>
                    </v-card>
                </v-card-text>

                <v-card-text v-else class="mt-5">
                    <span class="header"> No size guides added yet </span>
                </v-card-text>

                <delete-data-snackbar :deleteSnackbar="deleteSnackbar" @closing="closeDeleteSnackbar()"
                    @deleteData="destroy()" :useDefault="!products[datatableIndex].size_guides.length"
                    customParagraph="are you sure you want to delete the size guide ?"></delete-data-snackbar>

                <size-guides-save-dialog :sizes="getUniqueSizes(products[datatableIndex]
                .sizes)">
                </size-guides-save-dialog>

                <div class="clearing"></div>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
import { mapState, mapActions, mapMutations, mapGetters } from "vuex";
import sizeGuidesSaveDialog from "./sizeGuidesSaveDialog.vue";
export default {
    components: {
        sizeGuidesSaveDialog,
    },

    props: ["datatableIndex", "products", "editedIndex"],
    name: "SizeGuidesMainDialog",

    computed: {
        ...mapState(
            "sizeGuides",

            ["dialog", "deleteSnackbar"]
        ),

        ...mapGetters(
            "sizeGuides",

            ["getUniqueSizes"]
        ),


    },

    methods: {
        ...mapActions("sizeGuides", {
            destroy: "delete",
            closeDialogAction: 'closeDialogAction',
        }),

        ...mapMutations("sizeGuides", [
            "openSaveDialog",
            "editItem",
            "showDeleteSnackbar",
            "closeDeleteSnackbar",

        ]),
    },
};
</script>
