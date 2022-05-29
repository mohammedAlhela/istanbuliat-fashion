<template>
    <div class="sizes-container">
        <v-card>
            <v-card-title>
                <div class="row">
                    <div class="col-8">
                        <v-tooltip top>
                            <template v-slot:activator="{ on, attrs }">
                                <span v-bind="attrs" v-on="on" class="main-header">
                                    {{ sizes.length }} Sizes
                                </span>
                            </template>
                            <span> Sizes number </span>
                        </v-tooltip>

                        <span>
                            <v-chip class="ma-2 p-2" small label color="#f0f8ff">
                                <a href="/sizes/export" class="t">
                                    <span class=""> Export Excel </span>
                                </a>
                            </v-chip>
                        </span>

                        <v-chip class="p-2" small label color="#f0f8ff">
                            <a href="" class="" @click.prevent="showImportForm()">
                                <span class=""> Import Excel </span>
                            </a>
                        </v-chip>

                        <v-expand-transition>
                            <div v-if="importForm">
                                <v-form class="form" @submit.prevent="importData()" enctype="multipart/form-data"
                                    lazy-validation ref="importDataForm">
                                    <div class="upload-file-container">
                                        <div class="upload-container">
                                            <v-form enctype="multipart/form-data" ref="big-image-form">
                                                <label for="big-image-upload" class="custom-file-upload">
                                                    <v-icon class="icon">
                                                        mdi-pencil
                                                    </v-icon>
                                                </label>
                                                <input class="d-none" id="big-image-upload" name="file" type="file"
                                                    @change="fileSelected" />

                                                <span class="d-inline-block ml-2">
                                                    <span v-html="
                                                        getFileParagraph
                                                    ">
                                                    </span>
                                                </span>
                                            </v-form>
                                        </div>
                                        <div class="clearing"></div>
                                    </div>

                                    <v-btn type="submit" color="primary" class="ma-2 white--text import-button">
                                        Upload
                                    </v-btn>
                                </v-form>
                            </div>
                        </v-expand-transition>
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
                                <span> Add new size </span>
                            </v-tooltip>
                        </span>
                    </div>
                </div>
            </v-card-title>
            <v-card-text>
                <v-row v-if="sizes.length">
                    <v-col cols="12" xl="6" v-for="(item, index) in sizes" :key="index">
                        <v-card>
                            <v-card-title class="small-card-header-title">

                                <v-tooltip top>
                                    <template v-slot:activator="{ on, attrs }">


                                        <span class="header" v-bind="attrs" v-on="on">
                                            {{ item.name }} ({{ item.products.length }})
                                        </span>

                                    </template>
                                    <span class="d-inline-block w-100 py-2" v-if="item.products.length">
                                        <span class="tooltip-report-header"> This SIze Used In the Below Products
                                        </span>

                                        <div class=" m-1" v-for="(product, key) in item.products" :key="key">
                                            {{ product.name }}
                                        </div>
                                    </span>

                                    
                                            <span v-else>
                                               No products using this size
                                            </span>

                                </v-tooltip>
                            </v-card-title>
                            <v-card-actions class="justify-content-end p-3">
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
                    <v-col cols="12"> No items added yet </v-col>
                </v-row>
            </v-card-text>
        </v-card>

        <delete-data-snackbar :deleteSnackbar="deleteSnackbar" @closing="closeDeleteSnackbar()" @deleteData="destroy()"
            :useDefault="!sizes.length" customParagraph="are you sure you want to delete the size ?">
        </delete-data-snackbar>

        <delete-data-snackbar :deleteSnackbar="blockDeleteSnackbar" @closing="closeBlockDeleteSnackbar()"
            :useDefault="!sizes.length" :customParagraph="blockDeleteReport" type="blockDelete"></delete-data-snackbar>

        <sizes-save-dialog />
    </div>
</template>

<script>
import sizesSaveDialog from "./sizesSaveDialog.vue";
import { mapState, mapActions, mapMutations, mapGetters } from "vuex";
export default {
    components: {
        sizesSaveDialog,
    },
    name: "sizes",
    layout: "adminsPages",

    data() {
        return {
            importForm: false,
        };
    },

    computed: {
        ...mapState(
            "sizes",

            ["sizes", "deleteSnackbar", "blockDeleteSnackbar", "blockDeleteReport"]
        ),

        ...mapGetters(
            "sizes",

            ["getFileParagraph"]
        ),
    },

    methods: {
        ...mapActions("sizes", {
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

        ...mapMutations("sizes", [
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
