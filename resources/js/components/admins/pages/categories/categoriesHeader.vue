<template>
  <div class="row">
    <div class=" col-6  ">
      <v-tooltip top>
        <template v-slot:activator="{ on, attrs }">
          <span v-bind="attrs" v-on="on" class="main-header">
            {{ categories.length }} Categories
          </span>
        </template>
        <span> Categories number </span>
      </v-tooltip>

      <v-chip class="ma-2 p-2" small label color="#ebebeb">
        <a href="/categories/excel/export" class="t">
          Export Excel
        </a>
      </v-chip>
    </div>

    <div class=" col-6 text-right">
      <span class="ml-3">
        <v-tooltip top>
          <template v-slot:activator="{ on, attrs }">
            <v-btn class="no-focus add-button" color="success" fab v-bind="attrs" v-on="on" x-small dark
              @click="$emit('openSaveDialog')">
              <v-icon> mdi-plus </v-icon>
            </v-btn>
          </template>
          <span> Add new record </span>
        </v-tooltip>
      </span>

    </div>
  </div>


</template>

<script>
export default {
  name: 'CategorysHeader',
  props: {
    categories: {
      required: true,
      type: Array,
    },
  },
}
</script>
