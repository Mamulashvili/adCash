<template>
  <div v-if="showUser" class="wrapper flex flex-start">
    <p class="title fw-bold block mb-2 text-left">
      <span class="txt-accent">
        {{ `${showUser.fname} ${showUser.lname}` }}
      </span>
      's stocks list
    </p>
  </div>

  <div class="mt-4 w-100 table-holder-modal">
    <base-table title-pr="User" title-sec="stocks">
      <template #header>
        <tr>
          <th>Name</th>
          <th>Amount</th>
          <th>Purch. price</th>
          <th>Current price</th>
          <th>Gain/Loss</th>
        </tr>
      </template>
      <template #content>
        <tr v-for="stock in stocks" :key="stock.id">
          <td>{{ stock.name }}</td>
          <td>{{ stock.amount }}</td>
          <td>{{ stock.purchasePrice }}$</td>
          <td>{{ stock.price }}$</td>
          <td>
            {{
              `${calculateGainLoss(
                stock.amount,
                stock.price,
                stock.purchasePrice
              )}$`
            }}
          </td>
        </tr>
      </template>
    </base-table>
  </div>
  <div
    v-if="showUser && stocks"
    class="pt-5 flex flex-align-end flex-column container-lg"
  >
    <p class="fs-med txt-secondary mb-1">Total stocks: {{ stocksCount() }}</p>
    <p class="fs-med txt-secondary mb-1">Total profit: {{ profitCount() }}$</p>
    <p class="fs-med txt-secondary mb-1">Deposit: {{ showUser.deposit }}</p>
  </div>
</template>

<script>
import { userShowMixin } from "../mixins/userShowMixin";
import { calculateGainLoss } from "@utils/helpers.js";
import { HTTP } from "@utils/HTTP";

import BaseTable from "@components/BaseTable.vue";

export default {
  name: "ModalUserView",
  components: { BaseTable },
  mixins: [userShowMixin],
  emits: ["closeModal"],

  data() {
    return {
      stocks: null,
      totalStocks: null,
      totalProfit: null,
    };
  },

  created() {
    this.getStocksData();
  },

  methods: {
    calculateGainLoss,

    getStocksData: function () {
      HTTP.get(`/transactions/user/${this.itemId}`)
        .then(({ data }) => {
          console.log(data);
          this.stocks = data;
        })
        .catch((e) => {
          alert("Something went wrong 😔");
          console.log(e);
        });
    },

    stocksCount: function () {
      return this.stocks.reduce((total, { amount }) => total + amount, 0);
    },

    profitCount: function () {
      return this.stocks.reduce(
        (total, { amount, price, purchasePrice }) =>
          total + this.calculateGainLoss(amount, price, purchasePrice),
        0
      );
    },
  },
};
</script>

<style lang="scss" scoped>
.table-holder-modal {
  height: 65%;
  overflow: auto;
}
</style>