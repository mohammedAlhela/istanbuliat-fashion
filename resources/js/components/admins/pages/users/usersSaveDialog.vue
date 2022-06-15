<template>
  <div>
    <v-dialog persistent max-width="700px" v-model="dialog">
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
                  <span>Username </span>  <v-icon class = "validation-icon"> mdi-star</v-icon>
                </div>

                <v-text-field
                  required
                  :rules="errors.username"
                  solo
                  dense
                  :value="editedItem.username"
                  @input="fillDialogValues('username', $event)"
                ></v-text-field>
              </v-col>

              <v-col cols="12" class="py-0">
                <div class="input-header">
                  <span>Eamil Address </span><v-icon class = "validation-icon"> mdi-star</v-icon>
                </div>
                <v-text-field
                  required
                  :rules="errors.email"
                  solo
                  dense
                  :value="editedItem.email"
                  @input="fillDialogValues('email', $event)"
                ></v-text-field>
              </v-col>

              <v-col cols="12" class="py-0">
                <div class="input-header">
                  <span> Password </span>
                </div>
                <v-text-field
                  required
                  :rules="errors.password"
                  autocomplete="new-password"
                  :type="passwordType"
                  solo
                  dense
                  :value="editedItem.password"
                  @input="fillDialogValues('password', $event)"
                  append-icon="mdi-eye"
                  @click:append="toggleType()"
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
  </div>
</template>

<script>
import { mapState, mapGetters, mapActions, mapMutations } from 'vuex'
export default {
  name: 'UsersSaveDialog',
  computed: {
    ...mapState(
      'admins',

      [
        'dialog',
        'errors',
        'editedItem',
        'editedIndex',
        'passwordType',
        'buttonLoading',
      ]
    ),

    ...mapGetters('admins', ['formTitle']),
  },

  methods: {
    ...mapActions('admins', {
      saveAction: 'save',
    }),

    ...mapMutations('admins', [
      'toggleType',
      'closeData',
      'setDialogValues',
    ]),

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
