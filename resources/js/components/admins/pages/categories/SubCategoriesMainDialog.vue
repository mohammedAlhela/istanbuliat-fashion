<template>
  <div>
    <v-dialog persistent v-if="subCategoriesEditIndex > -1" v-model="dialog" fullscreen transition="dialog-bottom-transition">
      <v-card class="variations-dialog-container" flat>
        <v-toolbar dark color="blue">
          <v-btn icon @click="closeDialog()" class="no-focus">
            <v-icon>mdi-close</v-icon>
          </v-btn>
          <v-toolbar-title> Manage Sub Categories </v-toolbar-title>

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

        <v-card-text v-if="categories[datatableIndex].sub_categories.length">
          <v-card class="variation-card" v-for="(subCategory, index) in categories[datatableIndex].sub_categories"
            :key="index">
            <v-card-text>
              <img class="image" :src="subCategory.image" />

              <div class="informations-holder">
                <div class="header">

                  Name :
                  <span class="paragraph">
                    {{ subCategory.name }}
                  </span>
                </div>

                <div class="header">
                  Arabic name :
                  <span class="paragraph">
                    {{ subCategory.arabic_name }}
                  </span>
                </div>

                <div class="header">
                  Status :
                  <span class="paragraph">
                    {{ subCategory.status ? "active" : 'draft' }}
                  </span>
                </div>

                <v-chip class=" mt-3" style="color : rgb(152, 151, 151)" small label color="#ebebeb">
                  {{ subCategory.products.length }} Products
                </v-chip>


                <hr />

                <div class="text-right pt-0 pb-2">



                  <v-tooltip top>
                    <template v-slot:activator="{ on, attrs }">
                      <v-icon class="icon mr-2" @click="editItem(subCategory)" v-bind="attrs" v-on="on">
                        mdi-pencil
                      </v-icon>
                    </template>
                    <span> Update record </span>
                  </v-tooltip>


                  <v-tooltip top>
                    <template v-slot:activator="{ on, attrs }">
                      <span v-bind="attrs" v-on="on">
                        <v-icon @click="updateStatus(subCategory)" class="mr-2 icon">
                          mdi-swap-horizontal-bold
                        </v-icon>
                      </span>
                    </template>
                    <span> Change status </span>
                  </v-tooltip>





                  <v-tooltip top>
                    <template v-slot:activator="{ on, attrs }">
                      <v-icon class="icon" @click="showDeleteSnackbar(subCategory)" v-bind="attrs" v-on="on">
                        mdi-delete
                      </v-icon>
                    </template>
                    <span> Delete record </span>
                  </v-tooltip>



                </div>
              </div>

              <div class="clearing"></div>
            </v-card-text>
          </v-card>
        </v-card-text>
        <v-card-text v-else class="mt-5">
          <span class="header"> No sub categories added yet </span>
        </v-card-text>



        <delete-data-snackbar :deleteSnackbar="deleteSnackbar" @closing="closeDeleteSnackbar()" @deleteData="destroy()"
          :useDefault="!categories[datatableIndex].sub_categories.length"
          customParagraph="are you sure you want to delete the sub category ? "></delete-data-snackbar>


        <delete-data-snackbar :deleteSnackbar="blockDeleteSnackbar" @closing="closeBlockDeleteSnackbar()"
          :useDefault="!categories[datatableIndex].sub_categories.length" :customParagraph="blockDeleteReport"
          type="blockDelete">
        </delete-data-snackbar>


        <sub-categories-save-dialog :categories = "categories">

        </sub-categories-save-dialog>



        <div class="clearing"></div>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import { mapState, mapActions, mapMutations } from 'vuex'
import SubCategoriesSaveDialog from './SubCategoriesSaveDialog.vue'
export default {
  components: {
    SubCategoriesSaveDialog
  },

  props: ['datatableIndex', 'categories', 'subCategoriesEditIndex'],
  name: 'SubCategoriesMainDialog',

  computed: {
    ...mapState(
      'subCategories',

      ['dialog', 'deleteSnackbar', "blockDeleteSnackbar", "blockDeleteReport"]
    ),


  },

  methods: {
    ...mapActions('subCategories', {
      destroy: 'delete',
      updateStatus: 'updateStatus'
    }),

    ...mapMutations('subCategories', [
      'openSaveDialog',
      'editItem',
      'showDeleteSnackbar',
      'closeDeleteSnackbar',
      'closeDialog',
      "closeBlockDeleteSnackbar",

    ]),
  },
}
</script>
