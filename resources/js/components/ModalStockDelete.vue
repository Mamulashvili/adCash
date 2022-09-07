<template>
  <div v-if="showStock" class="wrapper flex flex-center flex-column">
    <p class="title fw-bold block mb-2">Delete Stock?</p>

    <p class="desc fs-default text-center fw-100 txt-primary">
      Are you sure to delete
      <span class="fw-bold txt-accent">'{{ showStock?.name }}'</span>?
      <br />
      You can't undo this action
    </p>
  </div>
  <div class="warning-wrapper">
    <div class="warning-content flex brd-radius">
      <figure>
        <img src="@icons/warning.png" alt="Warning" />
      </figure>
      <div class="ml-2">
        <p class="warning-title mb-2 fw-bold">Warning</p>
        <p class="warning-desc">
          Some users maybe already purchased this stock. <br />
          By deleting item, they will lost money!
        </p>
      </div>
    </div>
    <div class="w-100 flex flex-align-center flex-space-between mt-4">
      <base-button
        @handleClick="$emit('closeModal')"
        additionalClass="warning-btn txt-white"
      >
        Cancel
      </base-button>
      <base-button
        @handleClick="deleteStock"
        additionalClass="warning-btn warning-btn-danger txt-white"
      >
        Delete
      </base-button>
    </div>
  </div>
</template>

<script>
import { HTTP } from "@utils/HTTP";
import { stockShowMixin } from "../mixins/stockShowMixin";
import BaseButton from "@components/BaseButton.vue";

export default {
  name: "ModalStockDelete",
  mixins: [stockShowMixin],
  emits: ["closeModal"],
  components: {
    BaseButton,
  },

  methods: {
    deleteStock: function () {
      HTTP.delete(`/stock/${this.stockId}`)
        .then(({ status }) => status === 200 && location.reload())
        .catch((error) => {
          console.log(error);
          alert("Something went wrong 😔");
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
.warning-wrapper {
  width: 70%;
  margin: auto;
  margin-top: 1.2rem;
  margin-bottom: 1rem;

  .warning-content {
    width: 100%;
    padding: 1rem;
    background-color: #ffe8d9;
    border-left: 5px solid #f9703e;
    box-sizing: border-box;
  }

  figure img {
    max-width: 15px;
  }

  .warning-title {
    color: #841203;
  }

  .warning-desc {
    color: #c93518;
    line-height: 125%;
  }

  .warning-btn {
    width: 45%;
    background-color: #617d98;
    border: none;
    padding: 0.7rem 1.2rem;
  }

  .warning-btn-danger {
    background-color: #e22c38;
  }

  @media (max-width: 769px) {
    width: 100%;
  }
}
</style>