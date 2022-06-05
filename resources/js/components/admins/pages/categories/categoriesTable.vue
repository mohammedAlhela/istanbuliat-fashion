<template>
  <v-data-table :headers="headers" :items="filteredCategories" :items-per-page="15" item-key="item.id" mobile-breakpoint="1300"
    class="datatable">



    <template v-slot:item.name="{ item }">
      <td class="p-2">
        {{ item.name }} <br />

        <span class="items-snackbar-span mt-1">
          {{ item.products.length }} Products</span>


      </td>
    </template>

    <template v-slot:item.image="{ item }">
      <td class="p-3">
        <img :src="item.image" alt="no image" class="widen-image " />
      </td>
    </template>

    <template v-slot:item.description="{ item }">
      <td class="p-2">
        <div class="description">
          {{ item.description }}
        </div>
      </td>
    </template>

            <template v-slot:item.status="{ item }">
      <td>
      <v-chip small :color="item.status == 'active' ? 'success' : 'error'"> {{ item.status }} </v-chip>
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


        <!-- actions -->
      </td>
    </template>
  </v-data-table>
</template>

<script>
export default {
  name: 'CategoriesTable',
  props: {
    filteredCategories: {
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
