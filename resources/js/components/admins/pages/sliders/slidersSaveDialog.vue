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
                            <v-col cols="12">
                                <span class="image-paragraph"> (big screen image)

                                    Recomended image dimensions are 1920 width ,
                                    and 845 height <v-icon class="validation-icon"> mdi-star</v-icon>
                                </span>

                                <div class="upload-image-container">
                                    <div class="big-slider-image-container">
                                        <img :src="getBigImage" class="image" />
                                    </div>

                                    <div class="upload-container">

                                        <label for="big-image-upload" class="custom-file-upload">
                                            <v-icon class="icon">
                                                mdi-pencil
                                            </v-icon>
                                        </label>
                                        <input class="d-none" id="big-image-upload" name="big_image" type="file"
                                            @change="bigImageSelected" />



                                        <span class="d-inline-block ml-2">
                                            <span v-html="getBigImageParagraph">
                                            </span>
                                        </span>


                                        <div class="clear-button" @click="clearImage('big')"
                                            v-if="showClearImage('big')">
                                            <v-btn icon color="#645e5e">
                                                <v-icon>mdi-cached</v-icon>
                                            </v-btn><span class="paragraph"> clear</span>
                                        </div>




                                    </div>
                                    <div class="clearing"></div>
                                </div>
                            </v-col>

                            <v-col cols="12" class="mt-3">
                                <span class="image-paragraph">(small screen image)

                                    Recomended image dimensions are 800 width
                                    and 1200 height <v-icon class="validation-icon"> mdi-star</v-icon>
                                </span>

                                <div class="upload-image-container">
                                    <div class="small-slider-image-container">
                                        <img :src="getSmallImage" class="image" />
                                    </div>

                                    <div class="upload-container">
                                        <v-form enctype="multipart/form-data" ref="small-image-form">
                                            <label for="small-image-upload" class="custom-file-upload">
                                                <v-icon class="icon">
                                                    mdi-pencil
                                                </v-icon>
                                            </label>
                                            <input class="d-none" id="small-image-upload" name="image" type="file"
                                                @change="smallImageSelected" />

                                            <span class="d-inline-block ml-2">
                                                <span v-html="getSmallImageParagraph">
                                                </span>
                                            </span>



                                            <div class="clear-button" @click="clearImage('small')"
                                                v-if="showClearImage('small')">
                                                <v-btn icon color="#645e5e">
                                                    <v-icon>mdi-cached</v-icon>
                                                </v-btn><span class="paragraph"> clear</span>
                                            </div>
                                        </v-form>
                                    </div>
                                    <div class="clearing"></div>
                                </div>
                            </v-col>


                            <v-col cols="12" class="py-0 pt-3">
                                <div class="input-header">
                                    <span> Title </span>
                                    <v-icon class="validation-icon"> mdi-star</v-icon>
                                </div>

                                <v-text-field required :rules="errors.title" solo dense :value="editedItem.title"
                                    @input="fillDialogValues('title', $event)"></v-text-field>
                            </v-col>

                            <v-col cols="12" class="py-0">
                                <div class="input-header">
                                    <span> Arabic Title </span>
                                    <v-icon class="validation-icon"> mdi-star</v-icon>
                                </div>
                                <v-text-field required :rules="errors.arabic_title" solo dense
                                    :value="editedItem.arabic_title" @input="fillDialogValues('arabicTitle', $event)">
                                </v-text-field>
                            </v-col>

                            <!-- actions button  -->
                            <v-col cols="12" class="button-holder">
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
    name: "SlidersSaveDialog",
    computed: {
        ...mapState(
            "sliders",

            ["dialog", "errors", "editedItem", "buttonLoading"]
        ),

        ...mapGetters("sliders", [
            "formTitle",

            "getSmallImageParagraph",
            "getBigImageParagraph",
            "getBigImage",
            "getSmallImage",
            'showClearImage'
        ]),
    },

    methods: {
        ...mapActions("sliders", {
            saveAction: "save",
        }),

        ...mapMutations("sliders", [
            "closeData",
            "setDialogValues",
            "smallImageSelected",
            "bigImageSelected",
            'clearImage'
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
