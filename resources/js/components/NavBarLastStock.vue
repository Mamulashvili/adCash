<template>
  <div v-if="data" class="box-shadow brd-radius flex flex-column wrapper">
    <p class="heading fs-medium mb-3">Latest updates</p>
    <small class="desc fs-s">
      Stay up to date! <br />
      Meet the latest stock on the market!
    </small>
    <base-link
      additionalStyle="pb-1 fs-medium text-center"
      :text="data?.name"
      filled
      :route="{ name: 'Stocks list' }"
    />
  </div>
</template>

<script>
import BaseLink from "./BaseLink.vue";
import { HTTP } from "@utils/HTTP";

export default {
  name: "NavBarLastStock",
  components: { BaseLink },

  created() {
    this.loadRecentStock();
  },

  data() {
    return {
      data: null,
    };
  },

  methods: {
    loadRecentStock: function () {
      HTTP.get(`/stock/recentStock`)
        .then(({ data }) => {
          console.log("Reent stock - ", data);
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

<style lang="scss" scoped>
.wrapper {
  width: calc(20% - 3rem);
  position: fixed;
  bottom: 3rem;
  box-sizing: border-box;
  padding: 1.7rem 1rem;

  .desc {
    line-height: 130%;
  }

  @media (max-width: 769px) {
    display: none;
  }

  p.heading {
    color: #737080;
  }

  small {
    color: #9299a4;
  }
}
</style>