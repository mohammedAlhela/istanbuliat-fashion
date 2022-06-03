<template>
  <div>
    <a class="dashboard-cards"  href = "/admins/users" >
      <div class="row p-4">
        <div class="col-6 dashboard-card-number py-0">{{ admins.length }}</div>
        <div class="col-6 text-right py-0">
          <v-icon :color="informationsCards[0].color" class="dashboard-card-icon">
            {{ informationsCards[0].icon }}
          </v-icon>
        </div>
        <div class="col-12 dashboard-paragraph">
          {{ informationsCards[0].paragraph }}
        </div>
      </div>
      <div class="dashboard-card-bottom-slider" :class="informationsCards[0].color"></div>
    </a>



        <a class="dashboard-cards"  href = "/admins/customers" >
      <div class="row p-4">
        <div class="col-6 dashboard-card-number py-0">{{ customers.length }}</div>
        <div class="col-6 text-right py-0">
          <v-icon :color="informationsCards[1].color" class="dashboard-card-icon">
            {{ informationsCards[1].icon }}
          </v-icon>
        </div>
        <div class="col-12 dashboard-paragraph">
          {{ informationsCards[1].paragraph }}
        </div>
      </div>
      <div class="dashboard-card-bottom-slider" :class="informationsCards[1].color"></div>
    </a>



        <a class="dashboard-cards"  href = "/admins/orders" >
      <div class="row p-4">
        <div class="col-6 dashboard-card-number py-0">{{ 0 }}</div>
        <div class="col-6 text-right py-0">
          <v-icon :color="informationsCards[2].color" class="dashboard-card-icon">
            {{ informationsCards[2].icon }}
          </v-icon>
        </div>
        <div class="col-12 dashboard-paragraph">
          {{ informationsCards[2].paragraph }}
        </div>
      </div>
      <div class="dashboard-card-bottom-slider" :class="informationsCards[2].color"></div>
    </a>



        <a class="dashboard-cards" @click="routing(informationsCards[3].url)" href = "/admins/products" >
      <div class="row p-4">
        <div class="col-6 dashboard-card-number py-0">{{ products.length }}</div>
        <div class="col-6 text-right py-0">
          <v-icon :color="informationsCards[3].color" class="dashboard-card-icon">
            {{ informationsCards[3].icon }}
          </v-icon>
        </div>
        <div class="col-12 dashboard-paragraph">
          {{ informationsCards[3].paragraph }}
        </div>
      </div>
      <div class="dashboard-card-bottom-slider" :class="informationsCards[3].color"></div>
    </a>

  </div>
</template>

<script>
export default {
  name: 'Informationsards',
  props : ['admins' , 'products' , 'customers'],
  data() {
    return {
      informationsCards: [
        {
          number: 0,
          paragraph: 'Admins',
          icon: 'mdi-account-multiple',
          color: 'lime lighten-1',
          url: 'admins-users',
        },
        {
          number: 2,
          paragraph: 'Customers',
          icon: 'mdi-account-group',
          color: 'cyan accent-3',
          url: 'admins-customers',
        },

        {
          number: 8,
          paragraph: 'Orders',
          icon: 'mdi-calendar-multiple-check',
          color: 'warning',
          url: 'admins-orders',
        },

        {
          number: 3,
          paragraph: 'Products',
          icon: 'mdi-folder-multiple-image',
          color: 'indigo lighten-2',
          url: 'admins-products',
        },
      ],
    }
  },
}
</script>
