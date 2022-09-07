<template>
  <dashboard-banner-wrapper />
  <dashboard-cards />

  <div class="mt-4" v-if="data">
    <base-table>
      <template #header>
        <tr>
          <th>User</th>
          <th>Stock</th>
          <th>Amount</th>
          <th>Price</th>
          <th>Total</th>
        </tr>
      </template>
      <template #content>
        <tr v-for="item in data" :key="item.id">
          <td>@{{ item.username }}</td>
          <td>{{ item.name }}</td>
          <td>{{ item.amount }}</td>
          <td>{{ item.purchasePrice }} $</td>
          <td>{{ item.purchasePrice * item.amount }}$</td>
        </tr>
      </template>
    </base-table>
  </div>
</template>

<script>
import DashboardBannerWrapper from "@components/DashboardBannerWrapper";
import DashboardCards from "@components/DashboardCards.vue";
import BaseTable from "@components/BaseTable.vue";
import { HTTP } from "@utils/HTTP";

export default {
  name: "Dashboard",
  components: {
    DashboardBannerWrapper,
    DashboardCards,
    BaseTable,
  },

  data() {
    return {
      data: null,
    };
  },
  created() {
    this.getRecentTransactions();
  },
  methods: {
    getRecentTransactions: function () {
      HTTP.get(`/transactions`)
        .then(({ data }) => {
          console.log(data);
          this.data = data;
        })
        .catch((e) => {
          alert("Something went wrong 😔");
          console.log(e);
        });
    },
  },
};
</script>
