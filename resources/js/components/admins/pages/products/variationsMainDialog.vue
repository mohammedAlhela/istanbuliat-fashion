<template>
  <div>
    <v-dialog persistent v-if="editedIndex > -1" v-model="dialog" fullscreen transition="dialog-bottom-transition">
      <v-card class="variations-dialog-container size-guides-section" flat>
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
            <span> Add new record </span>
          </v-tooltip>
        </v-toolbar>

        <v-card-text v-if="products[datatableIndex].variations.length">



          <v-card class="variation-card " v-for="(variation, index) in products[datatableIndex].variations"
            :key="index">
            <v-card-text class="p-0">
              <div class="informations-holder">
                <div class="header size-card-header">
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
                </div>

 <div class="p-3 pt-0">
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
                  SKU :
                  <span class="paragraph">
                    {{ variation.sku }}
                  </span>
                </div>

                <hr />

                <div class="text-right  pt-0 pb-2">
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

        <div class="clearing"></div>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import { mapState, mapActions, mapMutations, mapGetters } from 'vuex'
import variationsSaveDialog from './variationsSaveDialog.vue'
export default {
  components: {
    variationsSaveDialog,
  },

  props: ['datatableIndex', 'products', 'editedIndex'],
  name: 'VariationsMainDialog',

  computed: {
    ...mapState(
      'variations',

      ['dialog', 'deleteSnackbar', 'variationEditedIndex']
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
      closeDialogAction: 'closeDialogAction',
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
