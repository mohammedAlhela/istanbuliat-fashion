<template>
  <div class="row">
    <div class="col-12 col-md-6 left-header-section">
      <v-tooltip top>
        <template v-slot:activator="{ on, attrs }">
          <span v-bind="attrs" v-on="on" class="main-header">
            {{ sliders.length }} Sliders
          </span>
        </template>
        <span> Sliders number </span>
      </v-tooltip>


    </div>
    <div class="col-12 col-md-6 right-header-section">
      <v-tooltip top>
        <template v-slot:activator="{ on, attrs }">
          <v-btn class="no-focus add-button" color="success" fab v-bind="attrs" v-on="on" x-small dark
            @click="$emit('openSaveDialog')">
            <v-icon> mdi-plus </v-icon>
          </v-btn>
        </template>
        <span> Add new slider </span>
      </v-tooltip>

    </div>


  </div>
</template>

<script>
export default {
  name: 'SlidersHeader',
  props: {
    sliders: {
      required: true,
      type: Array,
    },
  },
}
</script>
