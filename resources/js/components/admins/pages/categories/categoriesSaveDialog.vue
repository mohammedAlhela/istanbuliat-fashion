<template>
    <div>
        <v-dialog persistent fullscreen v-model="dialog" transition="dialog-bottom-transition">
            <v-card flat>
                <v-toolbar dark color="primary">
                    <v-btn icon @click="closeData()" class="no-focus">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title>
                        {{ formTitle }}
                    </v-toolbar-title>
                </v-toolbar>

                <v-card-text>
                    <v-form class="form" @submit.prevent="saveData()" enctype="multipart/form-data" lazy-validation
                        ref="form">
                        <v-row>
                            <v-col cols="12 mt-5">
                                <span class="image-paragraph">
                                    Maximum allowed file size is 1000 KB.
                                    Recomended image dimensions are 800 width
                                    and 1200 height
                                </span>

                                <div class="upload-image-container">
                                    <div class="small-image-container category-image-container">
                                        <img :src="getImage" class="small-image slider-image" />
                                    </div>

                                    <div class="upload-container">
                                    
                                            <label for="big-image-upload" class="custom-file-upload">
                                                <v-icon class="icon">
                                                    mdi-pencil
                                                </v-icon>
                                            </label>
                                            <input class="d-none" id="big-image-upload" name="big_image" type="file"
                                                @change="imageSelected" />

                                            <span class="d-inline-block ml-2">
                                                <span v-html="getImageParagraph">
                                                </span>
                                            </span>
                                        
                                    </div>
                                    <div class="clearing"></div>
                                </div>
                            </v-col>

                            <v-col cols="12" class="py-0 pt-3">
                                <div class="input-header">
                                    <span> Name </span>
                                </div>

                                <v-text-field required :rules="errors.name" solo dense :value="editedItem.name"
                                    @input="fillDialogValues('name', $event)"></v-text-field>
                            </v-col>

                            <v-col cols="12" class="py-0 ">
                                <div class="input-header">
                                    <span> Description </span>
                                </div>
                                <v-textarea required :rules="errors.description" solo dense
                                    :value="editedItem.description" @input="
                                        fillDialogValues('description', $event)
                                    "></v-textarea>
                            </v-col>

                            <!-- actions button  -->
                            <v-col cols="12" class="buttons-holder">
                                <v-btn type="submit" :loading="buttonLoading" color="primary" class="ma-2 white--text">
                                    Save Data
                                </v-btn>
                            </v-col>
                            <!-- actions button  -->
                        </v-row>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
export default {
    name: "CategorysSaveDialog",
    computed: {
        ...mapState(
            "categories",

            ["dialog", "errors", "editedItem", "buttonLoading"]
        ),

        ...mapGetters("categories", [
            "formTitle",
            "getImageParagraph",
            "getImage",
        ]),
    },

    methods: {
        ...mapActions("categories", {
            saveAction: "save",
        }),

        ...mapMutations("categories", [
            "closeData",
            "setDialogValues",
            "imageSelected",
        ]),

        saveData() {
            this.$refs.form.validate();
            this.saveAction();
        },

        fillDialogValues(type, value) {
            let dataObject = {
                variableType: type,
                e: value,
            };
            this.setDialogValues(dataObject);
        },
    },
};
</script>
