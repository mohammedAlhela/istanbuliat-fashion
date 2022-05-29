<template>
  <v-dialog persistent max-width="600px" v-model="dialog">
    <v-card flat>
      <v-card-title class="small-dialog-header">
        <span class="main-header">
          {{ formTitle }}
        </span>
      </v-card-title>

      <v-card-text>
        <v-form
          class="form"
          @submit.prevent="saveData()"
          enctype="multipart/form-data"
          lazy-validation
          ref="form"
        >
          <v-row>
            <v-col cols="12" class="py-0">
              <div class="input-header">
                <span> Name </span>
              </div>
              <v-text-field
                required
                :rules="errors.name"
                solo
                dense
                :value="editedItem.name"
                @input="fillDialogValues('name', $event)"
              ></v-text-field>
            </v-col>

            <v-col cols="12" class="py-0">
              <div class="input-header">
                <span> Choose color hex </span>
              </div>

              <v-color-picker
                dot-size="25"
                swatches-max-height="200"
                required
                :rules="errors.hex"
                solo
                dense
                :value="editedItem.hex"
                @input="fillDialogValues('hex', $event)"
              ></v-color-picker>
            </v-col>

            <v-col cols="12">
              <div class="buttons-holder">
                <v-btn
                  type="submit"
                  :loading="buttonLoading"
                  color="primary"
                  class="ma-2 white--text"
                >
                  Save Data
                </v-btn>

                <v-btn @click="closeData()" color="#ebebeb" class="ma-2">
                  Close
                </v-btn>
              </div>
            </v-col>
            <!-- personal informations -->
          </v-row>
        </v-form>
        <br />
        <div class="adjust-tabs-errors"></div>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapState, mapGetters, mapActions, mapMutations } from 'vuex'
export default {
  name: 'ColorsSaveDialog',
  computed: {
    ...mapState('colors', ['dialog', 'errors', 'editedItem', 'buttonLoading']),

    ...mapGetters('colors', ['formTitle']),
  },

  methods: {
    ...mapActions('colors', {
      saveAction: 'save',
    }),

    ...mapMutations('colors', ['closeData', 'setDialogValues']),

    saveData() {
      this.$refs.form.validate()
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
