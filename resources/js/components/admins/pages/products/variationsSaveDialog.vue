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
            class="form mt-5"
            @submit.prevent="saveData()"
            enctype="multipart/form-data"
            lazy-validation
            ref="variationSaveDiloag"
          >
            <v-row class="">

              <v-col cols="12" md="6" class="py-0">
                <div class="input-header">
                  <span class=""> Color </span> <v-icon class = "validation-icon"> mdi-star</v-icon>
                </div>
                <v-autocomplete
                  required
                  :rules="errors.color_id"
                  :items="colors"
                  item-text="name"
                  item-value="id"
                  solo
                  dense
                  return-object
                  :value="editedItem.color"
                  @input="fillDialogValues('color', $event)"
                ></v-autocomplete>
              </v-col>

              <v-col cols="12" md="6" class="py-0">
                <div class="input-header">
                  <span class=""> Size </span> <v-icon class = "validation-icon"> mdi-star</v-icon>
                </div>

                <v-autocomplete
                  required
                  :rules="errors.size_id"
                  :items="sizes"
                  item-text="name"
                  item-value="id"
                  solo
                  dense
                  return-object
                  :value="editedItem.size"
                  @input="fillDialogValues('size', $event)"
                ></v-autocomplete>
              </v-col>

              <v-col cols="12" md="6" class="py-0">
                <div class="input-header">
                  <span class=""> Selling price </span>
                </div>

                <v-text-field
                  prepend-inner-icon="mdi-currency-usd"
                  required
                  :rules="errors.selling_price"
                  solo
                  dense
                  :value="editedItem.selling_price"
                  @input="fillDialogValues('selling_price', $event)"
                ></v-text-field>
              </v-col>

              <v-col cols="12" md="6" class="py-0">
                <div class="input-header">
                  <span class=""> Discount price </span>
                </div>

                <v-text-field
                  prepend-inner-icon="mdi-currency-usd"
                  required
                  solo
                  dense
                  :value="editedItem.discount_price"
                  @input="fillDialogValues('discount_price', $event)"
                ></v-text-field>
              </v-col>

              <v-col cols="12" md="6" class="py-0">
                <div class="input-header">
                  <span class=""> Stock quantity </span>
                </div>

                <v-text-field
                  required
                  :rules="errors.stock_qty"
                  solo
                  dense
                  :value="editedItem.stock_qty"
                  @input="fillDialogValues('stock_qty', $event)"
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
import { mapState, mapGetters, mapActions, mapMutations } from 'vuex'
export default {
  name: 'VariationsSaveDialog',
  computed: {
    ...mapState('variations', [
      'saveDialog',
      'errors',
      'editedItem',
      'buttonLoading',
    ]),


        ...mapState('products', [
      'colors',
      'sizes',
    ]),

    ...mapGetters('variations', ['formTitle']),
  },

  methods: {
    ...mapActions('variations', {
      saveAction: 'save',
    }),

    ...mapMutations('variations', [
      'closeData',
      'setDialogValues',
    ]),

    saveData() {
      this.$refs.variationSaveDiloag.validate()
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
