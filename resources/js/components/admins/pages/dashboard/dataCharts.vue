<template>
  <div class="data-charts">
    <div class="row charts-container">
      <div class="col-12 col-lg-6">
        <apexchart
          type="area"
          height="350"
          :options="salesOptions"
          :series="sales"
        ></apexchart>
      </div>
      <div class="col-12 col-lg-6">
        <apexchart
          type="bar"
          height="350"
          :options="ordersOptions"
          :series="orders"
        ></apexchart>
      </div>
    </div>

    <div class="clearing"></div>
  </div>
</template>

<script>
export default {
  name: 'DataCharts',
  data() {
    return {
      sales: [
        {
          name: 'series1',
          data: [31, 40, 28, 51, 42, 109, 100],
        },
      ],

      orders: [
        {
          name: 'series1',
          data: [31, 40, 28, 51, 42, 109, 100],
        },
      ],

      salesOptions: {
        chart: {
          height: 350,
          type: 'area',
        },

        title: {
          text: 'Sales last Week',
          align: 'center',
          style: {
            fontSize: '14px',
          },
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: 'smooth',
        },
        xaxis: {
          type: 'datetime',
          categories: [
            '2018-09-19T00:00:00.000Z',
            '2018-09-19T01:30:00.000Z',
            '2018-09-19T02:30:00.000Z',
            '2018-09-19T03:30:00.000Z',
            '2018-09-19T04:30:00.000Z',
            '2018-09-19T05:30:00.000Z',
            '2018-09-19T06:30:00.000Z',
          ],
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy HH:mm',
          },
        },
      },

      ordersOptions: {
        chart: {
          height: 350,
          type: 'bar',
        },

        title: {
          text: 'Orders last Week',
          align: 'center',
          style: {
            fontSize: '14px',
          },
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: 'smooth',
        },
        xaxis: {
          type: 'datetime',
          categories: [
            '2018-09-19T00:00:00.000Z',
            '2018-09-19T01:30:00.000Z',
            '2018-09-19T02:30:00.000Z',
            '2018-09-19T03:30:00.000Z',
            '2018-09-19T04:30:00.000Z',
            '2018-09-19T05:30:00.000Z',
            '2018-09-19T06:30:00.000Z',
          ],
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy HH:mm',
          },
        },
      },
    }
  },
}
</script>
