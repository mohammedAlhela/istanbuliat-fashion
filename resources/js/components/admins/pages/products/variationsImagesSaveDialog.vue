<template>
  <div>
    <v-dialog
      persistent
      width="1000px"
      v-model="saveDialog"
    >
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
          <v-form
            class="form"
            @submit.prevent="saveData()"
            enctype="multipart/form-data"
            lazy-validation
            ref="variationImageSaveDialog"
          >
            <v-row class="">
              <!-- send images form -->
              <v-col cols="12 mb-3">
                <span class="image-paragraph">
                  Maximum allowed file size is 1000 KB. Recomended image
                  dimensions are 900 width and 600 height
                </span>

                <div class="upload-image-container">
                  <div class="variation-image-container">
                    <img class="image" :src="getImage" />
                  </div>

                  <div class="upload-container">
                    <v-form
                      enctype="multipart/form-data"
                      ref="variationImageSaveDialogSon"
                    >
                      <label for="variation-image" class="custom-file-upload">
                        <v-icon class="icon"> mdi-pencil </v-icon>
                      </label>
                      <input
                        class="d-none"
                        id="variation-image"
                        name="variation-image"
                        type="file"
                        @change="imageSelected"
                      />
                      <span class="d-inline-block ml-2">
                        <span v-html="getImageParagraph"> </span>
                      </span>
                    </v-form>
                  </div>

                  <div class="clearing"></div>
                </div>
              </v-col>
              <!-- send images form -->


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
import { mapState, mapGetters, mapActions, mapMutations } from 'vuex'
export default {
  name: 'VariationsImagesSaveDialog',
  computed: {
    ...mapState('variationsImages', [
      'saveDialog',
      'errors',
      'editedItem',
      'image',
      'buttonLoading',
    ]),




    ...mapGetters('variationsImages', ['formTitle', 'getImage', 'getImageParagraph']),
  },

  methods: {
    ...mapActions('variationsImages', {
      saveAction: 'save',
    }),

    ...mapMutations('variationsImages', [
      'closeData',
      'imageSelected',
    ]),

    saveData() {
      this.$refs.variationImageSaveDialogSon.validate()
      this.saveAction()
    },

  },
}
</script>
