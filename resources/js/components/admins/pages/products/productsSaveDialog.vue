<template>
  <div>
    <v-dialog persistent fullscreen v-model="dialog" transition="dialog-bottom-transition">
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
            ref="productSaveDialog">
            <v-row>
              <v-col cols="12 mb-5">
                <div class="header">The product preview image</div>

                <span class="image-paragraph">
                  Recomended image
                  dimensions are 600 width and 800 height <v-icon class = "validation-icon"> mdi-star</v-icon>
                </span>

                <div class="upload-image-container">
                  <div class="product-image-container">
                    <img :src="getImage" class="image" />
                  </div>
                  <div class="upload-container">

                    <label for="productSaveDialogImage" class="custom-file-upload">
                      <v-icon class="icon"> mdi-pencil </v-icon>
                    </label>
                    <input class="d-none" id="productSaveDialogImage" name="preview-image" type="file"
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

              <v-col cols="12" md="6" class="py-0">
                <div class="input-header"><span> Category </span>  <v-icon class = "validation-icon"> mdi-star</v-icon> </div> 
                <v-autocomplete required :rules="errors.category_id" :items="categories" item-text="name"
                  item-value="id" solo dense return-object :value="editedItem.category"
                  @input="fillDialogValues('category', $event)"></v-autocomplete>
              </v-col>

                   <v-col cols="12" md="6" class="py-0">
                <div class="input-header"><span> Sub Category </span></div>
                <v-autocomplete  :items="getRelatedSubCategories" item-text="name"
                  item-value="id" solo dense return-object :value="editedItem.sub_category"
                  @input="fillDialogValues('subCategory', $event)"></v-autocomplete>
              </v-col>

  
              <v-col cols="12" md="6" class="py-0" v-if="!editedItem.id > 0">
                <div class="input-header"><span> Colors </span> <v-icon class = "validation-icon"> mdi-star</v-icon></div>
                <v-autocomplete required :rules="errors.colorsNamesString" :items="colors" item-text="name"
                  item-value="id" solo dense return-object @input="fillDialogValues('colorsNamesString', $event)"
                  multiple>
                </v-autocomplete>
              </v-col>

              <v-col cols="12" md="6" class="py-0" v-if="!editedItem.id > 0">
                <div class="input-header"><span> Sizes </span> <v-icon class = "validation-icon"> mdi-star</v-icon></div>
                <v-autocomplete required :rules="errors.sizesNamesString" :items="sizes" item-text="name"
                  item-value="id" solo dense return-object @input="fillDialogValues('sizesNamesString', $event)"
                  multiple>
                </v-autocomplete>
              </v-col>

              <v-col cols="12" md="6" class="py-0">
                <div class="input-header"><span> Tags </span></div>
                <v-combobox multiple :value="editedItem.tagsNamesArray"
                  @input="fillDialogValues('tagsNamesArray', $event)" solo dense append-icon chips deletable-chips>
                </v-combobox>
              </v-col>

      

              <v-col cols="12" md="6" class="py-0">
                <div class="input-header"><span> Name </span> <v-icon class = "validation-icon"> mdi-star</v-icon></div>
                <v-text-field required :rules="errors.name" solo dense :value="editedItem.name"
                  @input="fillDialogValues('name', $event)"></v-text-field>
              </v-col>

              
              <v-col cols="12" md="6" class="py-0">
                <div class="input-header"><span> Arabic name </span> <v-icon class = "validation-icon"> mdi-star</v-icon></div>
                <v-text-field required :rules="errors.arabic_name" solo dense :value="editedItem.arabic_name"
                  @input="fillDialogValues('arabicName', $event)"></v-text-field>
              </v-col>

              <v-col cols="12" md="6" class="py-0">
                <div class="input-header"><span> Selling Price </span> <v-icon class = "validation-icon"> mdi-star</v-icon></div>
                <v-text-field required :rules="errors.selling_price" solo dense type="number"
                  prepend-inner-icon="mdi-currency-usd" :value="editedItem.selling_price"
                  @input="fillDialogValues('selling_price', $event)"></v-text-field>
              </v-col>

              <v-col cols="12" md="6" class="py-0">
                <div class="input-header"><span> Discount Price </span></div>
                <v-text-field required :rules="errors.discount_price" solo dense type="number"
                  prepend-inner-icon="mdi-currency-usd" :value="editedItem.discount_price == 0 ? '' : editedItem.discount_price"
                  @input="fillDialogValues('discount_price', $event)"></v-text-field>
              </v-col>



              <v-col cols="12" md="6" class="py-0">
                <div class="input-header"><span> SKU </span> <v-icon class = "validation-icon"> mdi-star</v-icon></div>
                <v-text-field required :rules="errors.sku" solo dense type="text" :value="editedItem.sku"
                  @input="fillDialogValues('sku', $event)"></v-text-field>
              </v-col>




              <v-col cols="12" class="py-0">
                <div class="input-header"><span> Description </span></div>

                <v-textarea required :rules="errors.description" solo dense :value="editedItem.description"
                  @input="fillDialogValues('description', $event)"></v-textarea>
              </v-col>

                <v-col cols="12" class="py-0">
                <div class="input-header"><span>Arabic description </span></div>

                <v-textarea required :rules="errors.arabic_description" solo dense :value="editedItem.arabic_description"
                  @input="fillDialogValues('arabicDescription', $event)"></v-textarea>
              </v-col>

              <v-col cols="12" md="6" class="py-0">
                <div class="input-header"><span> Materials Contents </span></div>
                <v-combobox multiple :value="editedItem.contents" @input="fillDialogValues('contents', $event)" solo
                  dense append-icon chips deletable-chips>
                </v-combobox>
              </v-col>


              <v-col cols="12" md="6" class="py-0">
                <div class="input-header"><span> Wash care </span></div>
                <v-text-field required solo dense type="text" :value="editedItem.wash_care"
                  @input="fillDialogValues('wash_care', $event)"></v-text-field>
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
        'subCategories',
    ]),

    ...mapGetters('products', [
      'formTitle',
      'getImage',
      'getImageParagraph',
      'getSizesIdsFromArray',
      'getColorsIdsFromArray',
      'showClearImage' ,
      'getRelatedSubCategories'
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
      'clearImage'
    ]),

    saveData() {
      this.$refs.productSaveDialog.validate()
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
