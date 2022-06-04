<template>
  <div class="row">
    <div class="col-12 col-md-6  left-header-section">
      <v-tooltip top>
        <template v-slot:activator="{ on, attrs }">
          <span v-bind="attrs" v-on="on" class="main-header">
            {{ filteredCategories.length }} Categories
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

    <div class="col-12 col-md-6 right-header-section">
      <v-text-field class="search-input" solo dense :value="search" rounded append-icon="mdi-magnify" label="search"
        @input="$emit('setSearchValue', $event)">
      </v-text-field>

      <span class="ml-3">
        <v-tooltip top>
          <template v-slot:activator="{ on, attrs }">
            <v-btn class="no-focus add-button" color="success" fab v-bind="attrs" v-on="on" x-small dark
              @click="$emit('openSaveDialog')">
              <v-icon> mdi-plus </v-icon>
            </v-btn>
          </template>
          <span> Add new Category </span>
        </v-tooltip>
      </span>

    </div>
  </div>


</template>

<script>
export default {
  name: 'CategorysHeader',
  props: {
    filteredCategories: {
      required: true,
      type: Array,
    },

    search : { 
      type : String ,
      required : true 

    }
  },
}
</script>
