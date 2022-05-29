<template>
  <div>
    <v-dialog
      persistent
      fullscreen
      v-model="dialog"
      transition="dialog-bottom-transition"
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
            ref="saveDataForm"
          >
            <v-row>
              <v-col cols="12">
                <div class="header">The product preview image</div>

                <span class="image-paragraph">
                  Maximum allowed file size is 1000 KB. Recomended image
                  dimensions are 600 width and 800 height
                </span>

                <div class="upload-image-container">
                  <div class="product-image-container">
                    <img :src="getImage" class="image" />
                  </div>

                  <div class="upload-container">
                    <v-form enctype="multipart/form-data" ref="saveDataForm">
                      <label for="preview-image" class="custom-file-upload">
                        <v-icon class="icon"> mdi-pencil </v-icon>
                      </label>
                      <input
                        class="d-none"
                        id="preview-image"
                        name="preview-image"
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

              <v-col cols="12" md="6" class="py-0 pt-3">
                <div class="input-header"><span> Category </span></div>
                <v-autocomplete
                  required
                  :rules="errors.category_id"
                    :items="categories"
                  item-text="name"
                  item-value="id"
                  solo
                  dense
                  return-object
                  :value="editedItem.category"
                  @input="fillDialogValues('category', $event)"

                ></v-autocomplete>
              </v-col>



              <v-col cols="12" md="6" class="py-0"  v-if = "!editedItem.id > 0">
                <div class="input-header"><span> Colors </span></div>
                <v-autocomplete
                  required
                  :rules="errors.colorsNamesArray"
                  :items="colors"
                  item-text="name"
                  item-value="id"
                  solo
                  dense
                  return-object
                  :value="editedItem.sizes"
                  @input="fillDialogValues('colorsNamesArray', $event)"
                  multiple
                ></v-autocomplete>
              </v-col>

              <v-col cols="12" md="6" class="py-0"       v-if = "!editedItem.id > 0" >
                <div class="input-header"><span> Sizes </span></div>
                <v-autocomplete

                  required
                  :rules="errors.sizesNamesArray"
                  :items="sizes"
                  item-text="name"
                  item-value="id"
                  solo
                  dense
                  return-object
                  :value="editedItem.sizes"
                  @input="fillDialogValues('sizesNamesArray', $event)"
                  multiple
                ></v-autocomplete>
              </v-col>


              <v-col cols="12" md="6" class="py-0">
                <div class="input-header"><span> Tags </span></div>
                <v-combobox
                  :rules="errors.tagsNamesArray"
                  multiple
                  :value="editedItem.tagsNamesArray"
                  @input="fillDialogValues('tagsNamesArray', $event)"
                  solo
                  dense
                  append-icon
                  chips
                  deletable-chips
                >
                </v-combobox>
              </v-col>

              <v-col cols="12" md="6" class="py-0">
                <div class="input-header"><span> Name </span></div>
                <v-text-field
                  required
                  :rules="errors.name"
                  solo
                  dense
                  :value="editedItem.name"
                  @input="fillDialogValues('name', $event)"
                ></v-text-field>
              </v-col>

              <v-col cols="12" md="6" class="py-0">
                <div class="input-header"><span> Selling Price </span></div>
                <v-text-field
                  required
                  :rules="errors.selling_price"
                  solo
                  dense
                  type="number"
                  prepend-inner-icon="mdi-currency-usd"
                  :value="editedItem.selling_price"
                  @input="fillDialogValues('selling_price', $event)"
                ></v-text-field>
              </v-col>

              <v-col cols="12" md="6" class="py-0">
                <div class="input-header"><span> Discount Price </span></div>
                <v-text-field
                  required
                  :rules="errors.discount_price"
                  solo
                  dense
                  type="number"
                  prepend-inner-icon="mdi-currency-usd"
                  :value="editedItem.discount_price"
                  @input="fillDialogValues('discount_price', $event)"
                ></v-text-field>
              </v-col>

                <v-col cols="12" md="6" class="py-0">
                <div class="input-header"><span> SKU </span></div>
                <v-text-field
                  required
                  :rules="errors.sku"
                  solo
                  dense
                  type="text"
                  :value="editedItem.sku"
                  @input="fillDialogValues('sku', $event)"
                ></v-text-field>
              </v-col>

              <v-col cols="12" class="py-0">
                <div class="input-header"><span> Long description </span></div>

                <v-textarea
                  required
                  :rules="errors.long_description"
                  solo
                  dense
                  :value="editedItem.long_description"
                  @input="fillDialogValues('longDescription', $event)"
                ></v-textarea>
              </v-col>

              <v-col cols="12" class="py-0">
                <div class="input-header"><span> Short description </span></div>

                <v-textarea
                  required
                  :rules="errors.short_description"
                  solo
                  dense
                  :value="editedItem.short_description"
                  @input="fillDialogValues('shortDescription', $event)"
                ></v-textarea>
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
import { mapState, mapGetters, mapActions, mapMutations } from 'vuex'
export default {
  name: 'ProductsSaveDialog',
  computed: {
    ...mapState('products', [
      'dialog',
      'errors',
      'editedItem',
      'editedIndex',
      'image',
      'buttonLoading',
      'colors',
      'sizes',

      'categories',
    ]),

    ...mapGetters('products', [
      'formTitle',
      'getImage',
      'getImageParagraph',
      'getSizesIdsFromArray',
      'getColorsIdsFromArray',
    ]),
  },

  methods: {
    ...mapActions('products', {
      saveAction: 'save',
    }),

    ...mapMutations('products', [
      'closeData',
      'setDialogValues',
      'imageSelected',
    ]),

    saveData() {
      this.$refs.saveDataForm.validate()
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
