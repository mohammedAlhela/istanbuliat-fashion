<template>
  <div>
    <div
      class="dashboard-cards"
      @click="routing(item.url)"
      v-for="(item, index) in informationsCards"
      :key="index"
    >
      <div class="row p-4">
        <div class="col-6 dashboard-card-number py-0">{{ item.number }}</div>
        <div class="col-6 text-right py-0">
          <v-icon :color="item.color" class="dashboard-card-icon">
            {{ item.icon }}
          </v-icon>
        </div>
        <div class="col-12 dashboard-paragraph">
          {{ item.paragraph }}
        </div>
      </div>
      <div class="dashboard-card-bottom-slider" :class="item.color"></div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Informationsards',
  props: {
    // filteredAdmins: {
    //   required: true,
    //   type: Array,
    // },
  },

  data() {
    return {
      informationsCards: [
        {
          number: 7,
          paragraph: 'Admins',
          icon: 'mdi-account-multiple',
          color: 'lime lighten-1',
          url: 'admins-sections-admins',
        },
        {
          number: 2,
          paragraph: 'Customers',
          icon: 'mdi-account-group',
          color: 'cyan accent-3',
          url: 'users-customers',
        },

        {
          number: 8,
          paragraph: 'Orders',
          icon: 'mdi-calendar-multiple-check',
          color: 'warning',
          url: 'admins-sections-orders',
        },

        {
          number: 3,
          paragraph: 'Sliders',
          icon: 'mdi-folder-multiple-image',
          color: 'indigo lighten-2',
          url: 'admins-sections-sliders',
        },
      ],
    }
  },

  methods: {
    routing(url) {
      this.$router.push({ name: url })
    },
  },
}
</script>
