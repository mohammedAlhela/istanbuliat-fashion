<template>
    <div>
        <v-dialog persistent width="1000px" v-model="saveDialog">
            <v-card flat>
                <v-toolbar dark color="blue">
                    <v-btn icon @click="closeData()" class="no-focus">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title>
                        {{ formTitle }}
                    </v-toolbar-title>
                </v-toolbar>
                <v-card-text class = "pt-5">
                    <v-form
                        class="form"
                        @submit.prevent="saveData()"
                        lazy-validation
                        ref = "sizeGuideSaveDialog"
                    >
                        <v-row class="">
                            <v-col cols="12" md="6" class="py-0">
                                <div class="input-header">
                                    <span class=""> Size </span>  <v-icon class = "validation-icon"> mdi-star</v-icon>
                                </div>
                                <v-autocomplete
                                    required
                                    :rules="errors.size_name"
                                    :items="sizes"
                                    solo
                                    return
                                    return-object
                                    item-text="name"
                                    item-value="id"
                                    dense
                                    :value="editedItem.size"
                                    @input="fillDialogValues('size', $event)"
                                ></v-autocomplete>
                            </v-col>

                            <v-col cols="12" md="6" class="py-0">
                                <div class="input-header">
                                    <span class=""> shoulder </span>
                                </div>
                                <v-text-field
                                    required
                                    :rules="errors.shoulder"
                                    solo
                                    dense
                                    :value="editedItem.shoulder"
                                    @input="
                                        fillDialogValues('shoulder', $event)
                                    "
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12" md="6" class="py-0">
                                <div class="input-header">
                                    <span class=""> bust </span>
                                </div>
                                <v-text-field
                                    required
                                    :rules="errors.bust"
                                    solo
                                    dense
                                    :value="editedItem.bust"
                                    @input="fillDialogValues('bust', $event)"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12" md="6" class="py-0">
                                <div class="input-header">
                                    <span class=""> wist </span>
                                </div>
                                <v-text-field
                                    required
                                    :rules="errors.wist"
                                    solo
                                    dense
                                    :value="editedItem.wist"
                                    @input="fillDialogValues('wist', $event)"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12" md="6" class="py-0">
                                <div class="input-header">
                                    <span class=""> hip </span>
                                </div>
                                <v-text-field
                                    required
                                    :rules="errors.hip"
                                    solo
                                    dense
                                    :value="editedItem.hip"
                                    @input="fillDialogValues('hip', $event)"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12" md="6" class="py-0">
                                <div class="input-header">
                                    <span class=""> length </span>
                                </div>
                                <v-text-field
                                    required
                                    :rules="errors.length"
                                    solo
                                    dense
                                    :value="editedItem.length"
                                    @input="fillDialogValues('length', $event)"
                                ></v-text-field>
                            </v-col>

                            <!-- actions button  -->
                            <v-col cols="12" class="buttons-holder">
                                <v-btn
                                    type="submit"
                                    :loading="buttonLoading"
                                    color="primary"
                                    class="ma-2 white--text"
                                >
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
    name: "SizeGuidesSaveDialog",
    props: ["sizes"],

    computed: {
        ...mapState("sizeGuides", [
            "saveDialog",
            "errors",
            "editedItem",
            "buttonLoading",
        ]),


        ...mapGetters("sizeGuides", ["formTitle"]),
    },

    methods: {
        ...mapActions("sizeGuides", {
            saveAction: "save",
        }),

        ...mapMutations("sizeGuides", ["closeData", "setDialogValues"]),

        saveData() {
              this.$refs.sizeGuideSaveDialog.validate()
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
