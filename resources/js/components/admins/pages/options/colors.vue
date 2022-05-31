<template>
    <div class="colors-container">
        <v-card>
            <v-card-title>
                <div class="row">
                    <div class="col-8">
                        <v-tooltip top>
                            <template v-slot:activator="{ on, attrs }">
                                <span v-bind="attrs" v-on="on" class="main-header">
                                    {{ colors.length }} Colors
                                </span>
                            </template>
                            <span> Colors number </span>
                        </v-tooltip>

                        <span>
                            <v-chip class="ma-2 p-2" small label color="#ebebeb">
                                <a href="/colors/export" class="t">
                                    <span class=""> Export Excel </span>
                                </a>
                            </v-chip>
                        </span>
                    </div>

                    <div class="col-4 text-right pr-5">
                        <span class="ml-3">
                            <v-tooltip top>
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn class="no-focus add-button" color="success" fab v-bind="attrs" v-on="on"
                                        x-small dark @click="openSaveDialog()">
                                        <v-icon> mdi-plus </v-icon>
                                    </v-btn>
                                </template>
                                <span> Add new color </span>
                            </v-tooltip>
                        </span>
                    </div>
                </div>
            </v-card-title>
            <v-card-text>
                <v-row v-if="colors.length">
                    <v-col cols="12" xl="6" v-for="(item, index) in colors" :key="index">
                        <v-card>
                            <v-card-title class="small-card-header-title">
                                <div class="row">
                                    <div class="col-6">
                                        <v-tooltip top >
                                            <template v-slot:activator="{ on, attrs }">


                                                <span class="header" v-bind="attrs" v-on="on">
                                                    {{ item.name }} ({{ item.products.length }})
                                                </span>

                                            </template>
                                            <span class="d-inline-block w-100 py-2" v-if="item.products.length">
                                            <span class = "tooltip-report-header"> This Color Used In the Below Products  </span>
                                    
                                                <div class=" m-1" v-for="(product, key) in item.products" :key="key">

                                                    {{ product.name }}
                                                </div>
                                            </span>

                                            <span v-else>
                                               No products using this color
                                            </span>
                                        </v-tooltip>


                                    </div>
                                    <div class="col-6 justify-content-end align-items-center d-flex">
                                        <v-sheet style = "cursor: pointer;" :rounded="rounded" height="20" width="60" :color="item.hex" @click="editItem(item)"></v-sheet>
                                    </div>
                                </div>
                            </v-card-title>
                            <v-card-actions class="p-3 justify-content-end">
                                <v-tooltip top>
                                    <template v-slot:activator="{ on, attrs }">
                                        <span v-bind="attrs" v-on="on">
                                            <v-icon @click="editItem(item)" class="mr-2 icon">
                                                mdi-pencil
                                            </v-icon>
                                        </span>
                                    </template>
                                    <span> edit data </span>
                                </v-tooltip>

                                <v-tooltip top>
                                    <template v-slot:activator="{ on, attrs }">
                                        <span v-bind="attrs" v-on="on">
                                            <v-icon @click="
                                                showDeleteSnackbar(item)
                                            " class="mr-2 icon">
                                                mdi-delete
                                            </v-icon>
                                        </span>
                                    </template>
                                    <span> delete data </span>
                                </v-tooltip>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>

                <v-row v-else>
                    <v-col cols="12 header"> No items added yet </v-col>
                </v-row>
            </v-card-text>
        </v-card>

        <delete-data-snackbar :deleteSnackbar="deleteSnackbar" @closing="closeDeleteSnackbar()" @deleteData="destroy()"
            :useDefault="!colors.length" customParagraph="are you sure you want to delete the color ?">
        </delete-data-snackbar>

        <delete-data-snackbar :deleteSnackbar="blockDeleteSnackbar" @closing="closeBlockDeleteSnackbar()"
            :useDefault="!colors.length" :customParagraph="blockDeleteReport" type = "blockDelete"></delete-data-snackbar>


        <colors-save-dialog />
    </div>
</template>

<script>
import colorsSaveDialog from "./colorsSaveDialog.vue";
import { mapGetters, mapState, mapActions, mapMutations } from "vuex";
export default {
    components: {
        colorsSaveDialog,
    },
    name: "colors",
    layout: "adminsPages",

    data() {
        return {
            rounded: true,
            importForm: false
        };
    },

    computed: {
        ...mapState(
            "colors",

            ["colors", "deleteSnackbar", "errors" , "blockDeleteSnackbar" , "blockDeleteReport"]
        ),

        ...mapGetters(
            "sizes",

            ["getFileParagraph"]
        ),
    },

    methods: {
        ...mapActions("colors", {
            destroy: "delete",
            importAction: "importAction",
        }),


        showImportForm() {
            this.importForm = !this.importForm;
        },

        importData() {
            this.$refs.importDataForm.validate();
            this.importAction();
        },

        ...mapMutations("colors", [
            "openSaveDialog",
            "editItem",
            "showDeleteSnackbar",
            "closeDeleteSnackbar",
            "closeBlockDeleteSnackbar",
            "fileSelected",
        ]),
    },
};
</script>
