<template>
  <div   v-if="productColorEditIndex > -1">
    <v-dialog  persistent v-model="dialog"  fullscreen transition="dialog-bottom-transition">
      <v-card class="variations-dialog-container" flat>
        <v-toolbar dark color="blue">
          <v-btn icon @click="closeDialog()" class="no-focus">
            <v-icon>mdi-close</v-icon>
          </v-btn>
          <v-toolbar-title> Manage Images</v-toolbar-title>

          <v-spacer> </v-spacer>

          <v-tooltip top>
            <template v-slot:activator="{ on, attrs }">
              <v-btn color="success" class="no-focus elevation-1" fab v-bind="attrs" v-on="on" x-small dark
                @click="addImage()">
                <v-icon> mdi-plus </v-icon>
              </v-btn>
            </template>
            <span> Add new Image </span>
          </v-tooltip>
        </v-toolbar>
        <v-card-text v-if="images.length">

          <div class="paragraph p-5 pb-0">

          Recomended image
            dimensions are 600 width and 800 height</div>
          <v-card class="variation-card variation-image-card"
            v-for="(image, index) in images" :key="index">
            <v-card-text>



              <v-form class="form" @submit.prevent="saveData()" enctype="multipart/form-data" lazy-validation
                :ref="getRecordRef(image)">
                <v-row class="">
                  <!-- send images form -->
                  <v-col cols="12 pb-0 mb-0">


                    <div class="upload-image-container">
                      <div class="product-image-container">

                        <img class="image" :src="getImage(image)" />
                      </div>

                      <div class="upload-container pt-5">

                        <label :for="getRecordId(image)" class="custom-file-upload">
                          <v-icon class="icon"> mdi-pencil </v-icon>
                        </label>
                        <input class="d-none" :id="getRecordId(image)" name="variation-image" type="file"
                          @change="(event) => localImageSelected(image, event)" />
                        <span class="d-inline-block ml-2">
                          <span v-html="getImageParagraph(image)"> </span>
                        </span>

      

                      </div>

                      <div class="clearing"></div>
                    </div>
                  </v-col>
                  <!-- send images form -->

                  <div class="col-12 p-0">
                    <hr>
                  </div>

                  <!-- actions button  -->
                  <v-col cols="12" class="buttons-holder text-left">
                    <v-btn v-if="editedIndex == image.id"
                      :loading="buttonLoading && image.id == editedIndex" small type="submit" color="primary"
                      class="ma-2 white--text">
                      Save
                    </v-btn>

                    <v-btn @click="showDeleteSnackbar(image)" small color="warning" class="ma-2 white--text">
                      Delete
                    </v-btn>

                  </v-col>
                  <!-- actions button  -->
                </v-row>
              </v-form>


              <div class="clearing"></div>
            </v-card-text>
          </v-card>
        </v-card-text>
        <v-card-text v-else class="mt-5">
          <span class="header"> No Images added yet </span>
        </v-card-text>

        <delete-data-snackbar :deleteSnackbar="deleteSnackbar" @closing="closeDeleteSnackbar()" @deleteData="destroy()"
          :useDefault="!images.length"
          customParagraph="are you sure you want to delete the product image ?"></delete-data-snackbar>

        <div class="clearing"></div>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import { mapState, mapActions, mapMutations, mapGetters } from 'vuex'
export default {

  props: ['images', 'productColorEditIndex'],
  name: 'productColorImagesMainDialog',

  computed: {
    ...mapState(
      'productColorImages',

      ['dialog', 'deleteSnackbar', 'buttonLoading', 'editedIndex']
    ),

    ...mapGetters('productColorImages', ['getImage', 'getImageParagraph' ]),
  },

  methods: {
    ...mapActions('productColorImages', {
      destroy: 'delete',
      saveAction: 'save',
    }),

    ...mapMutations('productColorImages', [
      'editItem',
      'showDeleteSnackbar',
      'closeDeleteSnackbar',
      'imageSelected',
      'initializeAdd',
       'closeDialog'

    ]),


    localImageSelected(item, element) {
      this.editItem(item)
      this.imageSelected(element)
    },

    getRecordId(item) {
      return `ProductColorImageUpdateDataFormImageId${item.id}`
    },

    getRecordRef(item) {
      return `ProductColorImageUpdateDataFormRef${item.id}`
    },

    saveData() {
      this.saveAction()
    },


    addImage () { 
      this.initializeAdd();
      this.saveAction()
    }
  },
}
</script>
