<template>
  <div class="balance-wrapper">
    <p class="secondary-title mb-1">
      <span class="fw-bold">Most</span>
      <span class="pl-1">valuable</span>
    </p>
    <div class="balance-cards-wrapper">
      <balance-card
        v-for="item in data"
        :key="item.id"
        :stock-name="item.name"
        :stock-price="item.price"
        :bg-color="item.bgColor"
        :accent-color="item.accentColor"
        :imageSrc="item.icon"
      />
    </div>
  </div>
</template>

<script>
import BalanceCard from "./DetailsBarBalanceCard.vue";
import { HTTP } from "@utils/HTTP";

export default {
  name: "DetailsBarBalance",
  components: { BalanceCard },

  created() {
    this.loadMostValuableStocks();
  },

  data() {
    return {
      data: null,
    };
  },

  methods: {
    loadMostValuableStocks: function () {
      HTTP.get(`/stock/mostValuableStocks`)
        .then(({ data }) => {
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