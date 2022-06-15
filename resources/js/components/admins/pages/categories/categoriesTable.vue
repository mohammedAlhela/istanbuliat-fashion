<template>
  <v-data-table :headers="headers" :items="categories" :items-per-page="15" item-key="item.id" mobile-breakpoint="1000"
    class="datatable">



    <template v-slot:item.name="{ item }">
      <td class="p-2">
        {{ item.name }}
        <br />




        <v-chip class=" mt-3" style="color : rgb(152, 151, 151)" small label color="#ebebeb">
          {{ item.products.length }} Products
        </v-chip>


        <br />


        <v-chip style="color : rgb(152, 151, 151)" class=" mt-3" small label color="#ebebeb">
          {{ item.sub_categories.length }} Sub ategories
        </v-chip>



      </td>
    </template>

    <template v-slot:item.image="{ item }">
      <td class="p-3">
        <img :src="item.image" alt="no image" class="widen-image " />
      </td>
    </template>


    <template v-slot:item.status="{ item }">
      <td>
        <v-chip small :color="item.status ? 'success' : 'error'"> {{ item.status ? 'active' : 'draft' }} </v-chip>
      </td>
    </template>


    <template v-slot:item.actions="{ item }">
      <!-- actions -->
      <td>
        <v-tooltip top>
          <template v-slot:activator="{ on, attrs }">
            <span v-bind="attrs" v-on="on">
              <v-icon @click="$emit('editItem', item)" class="mr-2 icon">
                mdi-pencil
              </v-icon>
            </span>
          </template>
          <span> edit data </span>
        </v-tooltip>


        <v-tooltip top>
          <template v-slot:activator="{ on, attrs }">
            <span v-bind="attrs" v-on="on">
              <v-icon @click="$emit('updateStatus', item)" class="mr-2 icon">
                mdi-swap-horizontal-bold
              </v-icon>
            </span>
          </template>
          <span> Change status </span>
        </v-tooltip>



        <v-tooltip top>
          <template v-slot:activator="{ on, attrs }">
            <span v-bind="attrs" v-on="on">
              <v-icon @click="$emit('showDeleteSnackbar', item)" class="mr-2 icon">
                mdi-delete
              </v-icon>
            </span>
          </template>
          <span> delete data </span>
        </v-tooltip>

        <v-tooltip top>
          <template v-slot:activator="{ on, attrs }">
            <span v-bind="attrs" v-on="on">
              <v-icon @click="$emit('manageSubCategories', item)" class="mr-2 icon variation-icon">
                mdi-file-multiple
              </v-icon>
            </span>
          </template>
          <span> Manage Sub Categories </span>
        </v-tooltip>


        <!-- actions -->
      </td>
    </template>
  </v-data-table>
</template>

<script>
export default {
  name: 'CategoriesTable',
  props: {
    categories: {
      required: true,
      type: Array,
    },

    headers: {
      required: true,
      type: Array,
    },
  },
}
</script>
