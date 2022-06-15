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
          class="form"
          @submit.prevent="saveAction()"
        >
          <v-row>
            <v-col cols="12" class="py-0">
              <div class="input-header">
                <span> Name  </span>
              </div>
              <v-text-field
                disabled
                solo
                dense
                :value="editedItem.name"
                class="textfield"
              ></v-text-field>
            </v-col>

                    <v-col cols="12" class="py-0">
              <div class="input-header">
                <span> Arabic name  </span>
              </div>
              <v-text-field
               @input="fillDialogValues('name', $event)"
                solo
                dense
                :value="editedItem.arabic_name"
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
  name: 'TagsSaveDialog',
  computed: {
    ...mapState('tags', [
      'dialog',
      'editedItem',
      'buttonLoading',
    ]),

    ...mapGetters('tags', ['formTitle']),
  },

  methods: {
    ...mapActions('tags', {
      saveAction: 'save',
    }),

    ...mapMutations('tags', ['closeData', 'setDialogValues']),


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
