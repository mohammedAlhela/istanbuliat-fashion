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

        <v-card-text>
          <v-form class="form" @submit.prevent="saveData()" enctype="multipart/form-data" lazy-validation
            ref="subCategoriesSaveDialog">
            <v-row class="">
              <!-- send images form -->
              <v-col cols="12 mb-3">
                <span class="image-paragraph">
                  Recomended image
                  dimensions are 600 width and 800 height <v-icon class = "validation-icon"> mdi-star</v-icon>
                </span>

                <div class="upload-image-container">
                  <div class="variation-image-container">
                    <img class="image" :src="getImage" />
                  </div>

                  <div class="upload-container">

                    <label for="subCategoriesSaveDialog" class="custom-file-upload">
                      <v-icon class="icon"> mdi-pencil </v-icon>
                    </label>
                    <input class="d-none" id="subCategoriesSaveDialog" name="variation-image" type="file"
                      @change="imageSelected" />
                    <span class="d-inline-block ml-2">
                      <span v-html="getImageParagraph"> </span>
                    </span>


                    <div class="clear-button" @click="clearImage()" v-if="showClearImage">
                      <v-btn icon color="#645e5e">
                        <v-icon>mdi-cached</v-icon>
                      </v-btn><span class="paragraph"> clear</span>
                    </div>

                  </div>

                  <div class="clearing"></div>
                </div>
              </v-col>
              <!-- send images form -->




              <v-col cols="12"  class="py-0" v-if = "editedIndex > -1">
                <div class="input-header"><span> Category </span></div>
                <v-autocomplete  :items="categories" item-text="name"
                  item-value="id" solo dense return-object :value="editedItem.category"
                  @input="fillDialogValues('category', $event)"></v-autocomplete>
              </v-col>


              <v-col cols="12"  class="py-0">
                <div class="input-header">
                  <span class=""> Name </span>  <v-icon class = "validation-icon"> mdi-star</v-icon>
                </div>

                <v-text-field  required :rules="errors.name" solo dense
                  :value="editedItem.name" @input="fillDialogValues('name', $event)"></v-text-field>
              </v-col>

              <v-col cols="12"  class="py-0">
                <div class="input-header">
                  <span class=""> Arabic names </span>  <v-icon class = "validation-icon"> mdi-star</v-icon>
                </div>

                <v-text-field required solo dense :rules="errors.arabic_name"
                  :value="editedItem.arabic_name" @input="fillDialogValues('arabicName', $event)"></v-text-field>
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
import { mapState, mapGetters, mapActions, mapMutations } from 'vuex'
export default {

  props : ['categories'],
  name: 'SubCategoriesSaveDialog',
  computed: {
    ...mapState('subCategories', [
      'saveDialog',
      'errors',
      'editedItem',
      'image',
      'buttonLoading' , , "editedIndex"
    ]),


    ...mapGetters('subCategories', ['formTitle', 'getImage', 'getImageParagraph', 'showClearImage' ]),
  },

  methods: {
    ...mapActions('subCategories', {
      saveAction: 'save',
    }),

    ...mapMutations('subCategories', [
      'closeData',
      'setDialogValues',
      'imageSelected',
      'clearImage'
    ]),

    saveData() {
      this.$refs.subCategoriesSaveDialog.validate()
      this.saveAction()
    },

    fillDialogValues(type, value) {
      let dataObject = {
        variableType: type,
        e: value,
      }
      this.setDialogValues(dataObject)
    },
  },
}
</script>
