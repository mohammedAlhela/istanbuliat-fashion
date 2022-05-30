<template>
  <div>
    <v-dialog
      v-if="editedIndex > -1"
      v-model="dialog"
      fullscreen
      transition="dialog-bottom-transition"
    >
      <v-card class="variations-dialog-container" flat>
        <v-toolbar dark color="blue">
          <v-btn icon @click="closeDialog()" class="no-focus">
            <v-icon>mdi-close</v-icon>
          </v-btn>
          <v-toolbar-title> Manage Variation Images</v-toolbar-title>

          <v-spacer> </v-spacer>

          <v-tooltip top>
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                color="success"
                class="no-focus elevation-1"
                fab
                v-bind="attrs"
                v-on="on"
                x-small
                dark
                @click="openSaveDialog()"
              >
                <v-icon> mdi-plus </v-icon>
              </v-btn>
            </template>
            <span> Add new Image </span>
          </v-tooltip>
        </v-toolbar>

        <v-card-text v-if="variations[datatableIndex].images.length">
          <v-card
            class="variation-card"
            v-for="(variationImage, index) in variations[datatableIndex].images"
            :key="index"
          >
            <v-card-text>
              <img
                class="image"
                :src="variationImage.image"
                alt=""
              />
   <hr>
                       <div class="text-right" style ="margin:20px 0px 0px 20px">
                  <v-icon class="icon" @click="showDeleteSnackbar(variationImage)">
                    mdi-delete
                  </v-icon>

                  <v-icon class="icon" @click="editItem(variationImage)">
                    mdi-pencil
                  </v-icon>

        
                </div>


              <div class="clearing"></div>
            </v-card-text>
          </v-card>
        </v-card-text>
        <v-card-text v-else class="mt-5">
          <span class="header"> No Images added yet </span>
        </v-card-text>



        <delete-data-snackbar
          :deleteSnackbar="deleteSnackbar"
          @closing="closeDeleteSnackbar()"
          @deleteData="destroy()"
          :useDefault="!variations[datatableIndex].images.length"
          customParagraph="are you sure you want to delete the variation image ?"
        ></delete-data-snackbar> 

       <variations-images-save-dialog ></variations-images-save-dialog> 

        <div class="clearing"></div>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import { mapState, mapActions, mapMutations } from 'vuex'
 import variationsImagesSaveDialog from './variationsImagesSaveDialog.vue'
export default {
  components: {
      variationsImagesSaveDialog,
  },

  props: ['datatableIndex', 'variations', 'editedIndex'],
  name: 'VariationsImagesMainDialog',

  computed: {
    ...mapState(
      'variationsImages',

      ['dialog', 'deleteSnackbar']
    ),
  },

  methods: {
    ...mapActions('variationsImages', {
      destroy: 'delete',
    }),

    ...mapMutations('variationsImages', [
      'openSaveDialog',
      'editItem',
      'showDeleteSnackbar',
      'closeDeleteSnackbar',
      'closeDialog',
    ]),
  },
}
</script>
