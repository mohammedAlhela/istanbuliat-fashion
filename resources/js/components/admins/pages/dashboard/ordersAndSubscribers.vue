<template>

  <div class="row p-4">
    <div class=" col-12 col-lg-8">

      <div class="main-header p-3 mt-5 pt-5">
        Todays Orders
      </div>


      <v-card>


        <v-data-table :headers="ordrsHeaders" :items="orders" :items-per-page="5" item-key="item.id"
          mobile-breakpoint="1200">
          <template v-slot:item.actions="{ item }">
            <!-- actions -->
            <td class="paragraph">
              <v-tooltip top>
                <template v-slot:activator="{ on, attrs }">
                  <span v-bind="attrs" v-on="on">
                    <v-icon class="mr-2 icon pointer"> mdi-delete </v-icon>
                  </span>
                </template>
                <span> delete record </span>
              </v-tooltip>
              <!-- actions -->
            </td>
          </template>
        </v-data-table>

      </v-card>

    </div>
    <div class="col-12 col-lg-4">

      <div class="main-header p-3 mt-5 pt-5">
        Subscribers
      </div>

      <v-card>

        <v-data-table :headers="subscribersHeaders" :items="subscribes" :items-per-page="5" item-key="item.id"
          mobile-breakpoint="1200">
          <template v-slot:item.actions="{ item }">
            <!-- actions -->
            <td class="paragraph">
              <v-tooltip top>
                <template v-slot:activator="{ on, attrs }">
                  <span v-bind="attrs" v-on="on">
                    <v-icon class="mr-2 icon pointer"> mdi-delete </v-icon>
                  </span>
                </template>
                <span> delete record </span>
              </v-tooltip>
              <!-- actions -->
            </td>
          </template>
        </v-data-table>
      </v-card>

    </div>
  </div>

</template>

<script>
export default {
  name: 'ordersAndSubscribers',
  props: ['subscribes']
  ,

  data() {
    return {
      ordrsHeaders: [
        {
          text: ' Customer name',
          value: 'name',
          sortable: true,
          class: 'taber',
        },

        {
          text: ' Customer Email',
          value: 'email',
          sortable: true,
          class: 'taber',
        },

        {
          text: ' Total Amount',
          value: 'amount',
          sortable: true,
          class: 'taber',
        },


        {
          text: ' Date',
          value: 'date',
          sortable: true,
          class: 'taber',
        },

        { text: 'Actions', value: 'actions', sortable: false },
      ],

      subscribersHeaders: [
        {
          text: 'Email',
          value: 'email',
          sortable: true,
          class: 'taber',
        },



        { text: 'Actions', value: 'actions', sortable: false },
      ],

      orders: [
        {
          name: 'mohammed alhelal',
          email: 'mohamd alhelal@gmail.com',
          date: "10:26",
          amount: 320.34


        },

        {
          name: 'mohammed alhelal',
          email: 'mohamd alhelal@gmail.com',
          date: "10:26",
          amount: 320.34


        },


        {
          name: 'mohammed alhelal',
          email: 'mohamd alhelal@gmail.com',
          date: "10:26",
          amount: 320.34


        },



        {
          name: 'mohammed alhelal',
          email: 'mohamd alhelal@gmail.com',
          date: "10:26",
          amount: 320.34


        },


        {
          name: 'alaa alhelal',
          email: 'mohamd alhelal@gmail.com',
          date: "10:26",
          amount: 320.34


        },



      ],

    }
  },
}
</script>

