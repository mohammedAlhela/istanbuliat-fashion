<template>
  <v-data-table
    :headers="headers"
    :items="sliders"
    :items-per-page="15"
    item-key="item.id"
    mobile-breakpoint="1000"
    class="datatable"
  >


    <template v-slot:item.image="{ item }">
      <td class="p-3">
        <img
          :src="item.big_image"
          alt="no image"
          class="slider-image"
        />
      </td>
    </template>


    <template v-slot:item.status="{ item }">
      <td>
        <v-chip v-if="item.status == 1" small class="" color="success">
          active
        </v-chip>

        <v-chip v-else small class="" color="error"> draft </v-chip>
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
              <v-icon
                @click="$emit('showDeleteSnackbar', item)"
                class="mr-2 icon"
              >
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
  name: 'SlidersTable',
  props: {
    sliders: {
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
