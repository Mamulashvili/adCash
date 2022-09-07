<template>
  <base-banner
    src="banner-sddstock"
    title="Add Stock"
    subtitle="Try to add new stock"
    description="A stock, also known as equity, is a security that represents the ownership of a fraction of the issuing corporation."
    :additionalStyleImageObject="imageStyle"
    :route="{ name: 'Stocks list' }"
    routeText="View stock list"
    alt="Stock list"
  />
  <div class="mt-4">
    <form-stock-add />
  </div>
</template>

<script>
import BaseBanner from "@components/BaseBanner.vue";
import FormStockAdd from "@components/FormStockAdd.vue";

export default {
  name: "StockAdd",
  components: {
    BaseBanner,
    FormStockAdd,
  },

  computed: {
    imageStyle() {
      return {
        "max-width": "35%", // No overflow for banner
        right: "-90px",
      };
    },
  },
};
</script>
