<template>
  <v-dialog persistent max-width="400px" v-model="dialog">
    <v-card flat>
      <v-card-title class="small-dialog-header">
        <span class="main-header">
          {{ formTitle }}
        </span>
      </v-card-title>

      <v-card-text>
        <v-form
          class="form mt-5"
        @submit.prevent="saveData()"
          enctype="multipart/form-data"
          lazy-validation
          ref="form"
        >
          <v-row>
            <v-col cols="12" class="py-0">
              <div class="input-header">
                <span> Name  </span> <v-icon class = "validation-icon"> mdi-star</v-icon>
              </div>
              <v-text-field
                required
                :rules="errors.name"
                solo
                dense
                :value="editedItem.name"
                @input="fillDialogValues('name', $event)"
                class="textfield"
              ></v-text-field>
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
  name: 'SizesSaveDialog',
  computed: {
    ...mapState('sizes', [
      'dialog',
      'errors',
      'editedItem',
      'buttonLoading',
    ]),

    ...mapGetters('sizes', ['formTitle']),
  },

  methods: {
    ...mapActions('sizes', {
      saveAction: 'save',
    }),

    ...mapMutations('sizes', ['closeData', 'setDialogValues']),

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
