<template>
  <div>
    <v-dialog v-if="editedIndex > -1" v-model="dialog" fullscreen transition="dialog-bottom-transition">
      <v-card class="variations-dialog-container" flat>
        <v-toolbar dark color="blue">
          <v-btn icon @click="closeDialogAction()" class="no-focus">
            <v-icon>mdi-close</v-icon>
          </v-btn>
          <v-toolbar-title> Manage product variations</v-toolbar-title>

          <v-spacer> </v-spacer>

          <v-tooltip top>
            <template v-slot:activator="{ on, attrs }">
              <v-btn color="success" class="no-focus elevation-1" fab v-bind="attrs" v-on="on" x-small dark
                @click="openSaveDialog()">
                <v-icon> mdi-plus </v-icon>
              </v-btn>
            </template>
            <span> Add new product variation </span>
          </v-tooltip>
        </v-toolbar>

        <v-card-text v-if="products[datatableIndex].variations.length">
          <v-card class="variation-card" v-for="(variation, index) in products[datatableIndex].variations" :key="index">
            <v-card-text>
              <img class="image" :src="variation.image || '/images/products/variations/variation.webp'" />


              <v-chip small class="ma-2 mt-4" label dark color="warning" @click="deleteImage(variation.id)"
                v-if="variation.image">
                Delete Image
              </v-chip>





              <div class="informations-holder">
{{variation.id  }}
                <div class="header">

                  Color :
                  <span class="paragraph">
                    {{ variation.color.name }}
                  </span>
                </div>

                <div class="header">
                  Size :
                  <span class="paragraph">
                    {{ variation.size.name }}
                  </span>
                </div>

                <div class="header">
                  Selling price :
                  <span class="paragraph">
                    ${{ variation.selling_price }}
                  </span>
                </div>

                <div class="header">
                  Discount price :
                  <span class="paragraph">
                    ${{ variation.discount_price }}
                  </span>
                </div>

                <div class="header">
                  Quantitie :
                  <span class="paragraph">
                    {{ variation.stock_qty }} items
                  </span>
                </div>

                <div class="header">
                  Status :
                  <span class="paragraph">
                    {{ variation.status ? 'Available' : 'Out of stock' }}
                  </span>
                </div>

                <div class="header">
                  SKU :
                  <span class="paragraph">
                    {{ variation.sku }}
                  </span>
                </div>

                <hr />

                <div class="text-right row pt-0 pb-2">



                  <div class="text-left col-6">

                    <v-tooltip top>
                      <template v-slot:activator="{ on, attrs }">

                        <v-chip @click="manageImages(variation)"  label color="#e0e0e0" v-bind="attrs" v-on="on">
                          <v-icon class="icon" > mdi-folder-multiple-image </v-icon>
                          <span class="paragraph d-inline-block mx-2"> {{ variation.images.length }} images</span>

                        </v-chip>

                      </template>
                      <span> Manage Variation Additional Images </span>
                    </v-tooltip>
                  </div>



                  <div class="col-6">
                    <v-tooltip top>
                      <template v-slot:activator="{ on, attrs }">
                        <v-icon class="icon mr-2" @click="editItem(variation)" v-bind="attrs" v-on="on">
                          mdi-pencil
                        </v-icon>
                      </template>
                      <span> Update Variation Data </span>
                    </v-tooltip>







                    <v-tooltip top>
                      <template v-slot:activator="{ on, attrs }">
                        <v-icon class="icon" @click="showDeleteSnackbar(variation)" v-bind="attrs" v-on="on">
                          mdi-delete
                        </v-icon>
                      </template>
                      <span> Delete the variation </span>
                    </v-tooltip>

                  </div>

                </div>
              </div>

              <div class="clearing"></div>
            </v-card-text>
          </v-card>
        </v-card-text>
        <v-card-text v-else class="mt-5">
          <span class="header"> No product variations added yet </span>
        </v-card-text>



        <delete-data-snackbar :deleteSnackbar="deleteSnackbar" @closing="closeDeleteSnackbar()" @deleteData="destroy()"
          :useDefault="!products[datatableIndex].variations.length"
          customParagraph="are you sure you want to delete the product variation ? "></delete-data-snackbar>

        <variations-save-dialog>
        </variations-save-dialog>

        <variations-images-main-dialog :datatableIndex="variationsDatatableIndex"
          :variations="products[datatableIndex].variations" :variationEditedIndex="variationEditedIndex">

        </variations-images-main-dialog>

        <div class="clearing"></div>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import { mapState, mapActions, mapMutations, mapGetters } from 'vuex'
import variationsSaveDialog from './variationsSaveDialog.vue'
import VariationsImagesMainDialog from './variationsImagesMainDialog.vue'
export default {
  components: {
    variationsSaveDialog,
    VariationsImagesMainDialog
  },

  props: ['datatableIndex', 'products', 'editedIndex'],
  name: 'VariationsMainDialog',

  computed: {
    ...mapState(
      'variations',

      ['dialog', 'deleteSnackbar' , 'variationEditedIndex']
    ),

    ...mapGetters(
      'variations',

      {
        variationsDatatableIndex: 'datatableIndex',
      
        


      }
    ),

  },

  methods: {
    ...mapActions('variations', {
      destroy: 'delete',
      manageImages: 'manageImages',
      closeDialogAction: 'closeDialogAction',
      deleteImage: 'deleteImage',

    }),

    ...mapMutations('variations', [
      'openSaveDialog',
      'editItem',
      'showDeleteSnackbar',
      'closeDeleteSnackbar',

    ]),
  },
}
</script>
