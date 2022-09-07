<template>
  <div class="balance-card brd-radius" :style="{ backgroundColor: bgColor }">
    <figure
      class="flex flex-center brd-rounded"
      :style="{ backgroundColor: accentColor }"
    >
      <img :src="imageSource" alt="Stock icon" class="user-avatar" />
    </figure>
    <div class="flex flex-column pl-2">
      <small class="txt-primary fs-s pb-1">
        {{ stockName }}
      </small>
      <p class="fw-bold w-100">{{ numberWithCommas(stockPrice) }}$</p>
    </div>
  </div>
</template>

<script>
import { numberWithCommas } from "@utils/helpers.js";

export default {
  name: "DetailsBarBalanceCard",
  props: {
    stockName: {
      type: String,
      required: true,
      default: "",
    },
    stockPrice: {
      type: [String, Number],
      required: true,
      default: 0,
    },
    bgColor: {
      type: String,
      default: "#e8f7f1",
    },
    accentColor: {
      type: String,
      default: "#3fd8a2",
    },
    imageSrc: {
      type: [String, null],
      required: true,
    },
  },
  methods: {
    numberWithCommas,
  },

  computed: {
    imageSource: function () {
      return this.imageSrc ? `/storage/${this.imageSrc}` : "/images/star.png";
    },
  },
};
</script>

<style lang="scss" scoped>
.balance-card {
  padding: 0.7rem;
  margin: 1rem 0;
  display: flex;
  align-items: center;

  figure {
    padding: 0.7rem;

    img {
      max-width: 20px;
    }
  }
}
</style>