<template>
  <div v-if="showStock" class="wrapper flex flex-center flex-column">
    <p class="title fw-bold block mb-2">
      Edit Stock
      <span class="fw-bold txt-accent">'{{ showStock?.name }}'</span>
    </p>
  </div>
  <div class="w-100">
    <base-input
      v-model.trim="stockPrice"
      additionalClassWrapper="mb-3"
      additionalClassInput="w-100"
      label="Stock price"
      type="number"
      id="st_price"
      rules="required"
    />
    <base-input
      v-model.trim="stockAccentColor"
      additionalClassWrapper="mb-3"
      additionalClassInput="w-100 p-0"
      label="Accent color"
      type="color"
      id="st_accent_c"
    />
    <base-input
      v-model.trim="stockBgColor"
      additionalClassWrapper="mb-3"
      additionalClassInput="w-100 p-0"
      label="Background color"
      type="color"
      id="st_bg_c"
    />
  </div>
  <div v-if="errors && !successRequest" class="w-100">
    <small
      v-for="(error, index) in errors"
      :key="index"
      class="txt-danger fs-s mt-1 mb-1 block"
    >
      {{ error?.[0] }}
    </small>
  </div>
  <div v-if="successRequest" class="w-100">
    <small class="fs-s mt-1 mb-1 block txt-accent">
      Stock updated successfully
    </small>
  </div>
  <div class="flex flex-justify-end w-100">
    <base-button @handleClick="updateStock"> Update </base-button>
  </div>
</template>

<script>
import { HTTP } from "@utils/HTTP";
import { stockShowMixin } from "../mixins/stockShowMixin";
import BaseButton from "@components/BaseButton.vue";
import BaseInput from "@components/BaseInput.vue";

export default {
  name: "ModalStockEdit",
  mixins: [stockShowMixin],
  emits: ["closeModal"],
  components: {
    BaseButton,
    BaseInput,
  },

  data() {
    return {
      stockPrice: 0,
      stockAccentColor: "",
      stockBgColor: "",
      errors: [],
      initialUpdate: true,
      successRequest: false,
    };
  },

  updated() {
    if (this.initialUpdate) {
      this.stockPrice = this.showStock?.price || 0;
      this.stockAccentColor = this.showStock?.accentColor || "";
      this.stockBgColor = this.showStock?.bgColor || "";
      this.initialUpdate = false;
    }
  },

  methods: {
    updateStock: function () {
      const formData = {
        id: this.stockId,
        price: this.stockPrice,
        accentColor: this.stockAccentColor,
        bgColor: this.stockBgColor,
      };

      HTTP.put(`/stock`, formData)
        .then((resp) => {
          if (resp.status === 200) return (this.successRequest = true);
          this.successRequest = false;
        })
        .catch((error) => {
          this.successRequest = false;
          const hasErrorsToDisplay = error?.response?.data?.errors || null;
          if (!hasErrorsToDisplay) return alert("Something went wrong 😔");

          this.errors = Object.values(error?.response?.data?.errors);
        });
    },
  },
};
</script>

<style lang="scss" scoped>
.wrapper {
  .title {
    font-size: 1.3rem;
    color: #5e697b;
  }

  .desc {
    color: #585973;
    line-height: 125%;
  }
}
.half-input {
  width: 45%;

  @media (max-width: 769px) {
    width: 100%;
  }
}
</style>