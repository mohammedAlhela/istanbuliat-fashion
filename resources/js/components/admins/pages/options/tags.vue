<template>
    <div class="tags-container">
        <v-card>
            <v-card-title>
                <div class="row">
                    <div class=" p-3 paragraph" style="max-width:475px">
                        after adding tags from the products page here we add the arabic tags names
                    </div>
                    <div class="col-8">
                        <v-tooltip top>
                            <template v-slot:activator="{ on, attrs }">
                                <span v-bind="attrs" v-on="on" class="main-header">
                                    {{ tags.length }} tags
                                </span>
                            </template>
                            <span> tags number </span>
                        </v-tooltip>

                    </div>

                </div>
            </v-card-title>
            <v-card-text>
                <v-row v-if="tags.length">
                    <v-col cols="6" v-for="(tag, index) in tags" :key="index">
                        <v-card>
                            <v-card-title class="small-card-header-title">

                                <div class="row pt-2 pb-2">
                                    <div class="col-12 p-2 pb-1"> <span class="header">
                                            {{ tag.name }}

                                        </span></div>
                                    <div class="col-12 p-2 pt-0">

                                        <span class="header">
                                            {{ tag.arabic_name }}

                                        </span>

                                    </div>
                                </div>







                            </v-card-title>
                            <v-card-actions class="justify-content-end p-3">
                                <v-tooltip top>
                                    <template v-slot:activator="{ on, attrs }">
                                        <span v-bind="attrs" v-on="on">
                                            <v-icon @click="editItem(tag)" class="mr-2 icon">
                                                mdi-pencil
                                            </v-icon>
                                        </span>
                                    </template>
                                    <span> add arabic name </span>
                                </v-tooltip>

                            </v-card-actions>
                        </v-card>
                    </v-col>





                </v-row>

                <v-row v-else>
                    <v-col cols="12"> No items added yet </v-col>
                </v-row>
            </v-card-text>
        </v-card>


        <tags-save-dialog />
    </div>
</template>

<script>
import { mapState, mapMutations } from "vuex";
import tagsSaveDialog from "./tagsSaveDialog.vue";
export default {
    components: {
        tagsSaveDialog
    },
    name: "tags",
    layout: "adminsPages",



    computed: {
        ...mapState(
            "tags",

            ["tags"]
        ),

    },

    methods: {

        ...mapMutations("tags", [

            "editItem",

        ]),
    },
};
</script>
