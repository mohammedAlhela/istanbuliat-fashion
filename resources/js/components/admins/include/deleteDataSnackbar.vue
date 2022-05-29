<template>
  <div>
    <transition name="fade">
      <div class="delete-snackbar" v-show="deleteSnackbar">
        <span v-if = 'useDefault' > do you want to delete this ? {{ user }} </span>
        <span v-else v-html="customParagraph">    </span>

        <div class = 'mt-2'>
       <v-btn
        v-if = "!type"
          class="confirm-button"
          text
          v-bind="attrs"
          @click="deleteData()"
        >
          Delete
        </v-btn>

        <v-btn
          class="cancel-button"
          text
          v-bind="attrs"
          @click="closeDialog()"
        >
          Cancel
        </v-btn>
        </div> 

      </div>
    </transition>
  </div>
</template>

<script>
export default {
  props: ["deleteSnackbar", "user" , 'useDefault' , 'customParagraph' , 'type'],
  data: () => ({
    attrs: null,
  }),

  methods: {
    closeDialog() {
      this.$emit("closing");
    },

    deleteData() {
      this.$emit("deleteData");
    },
  },
};
</script>


