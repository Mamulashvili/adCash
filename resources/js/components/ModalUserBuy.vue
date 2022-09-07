<template>
  <div v-if="showUser" class="w-100">
    <p class="title fw-bold block mb-2">
      Buy new stock for user
      <span class="txt-accent">{{
        `${showUser.fname} ${showUser.lname}`
      }}</span>
    </p>

    <p class="w-100 mt-3 mb-3 secondary-title">
      <span>Balance:</span>
      <span>
        <b>{{ showUser.deposit }}$</b>
      </span>
    </p>
  </div>

  <div v-if="stocks" class="w-100 mt-2 flex flex-space-between">
    <div class="half">
      <label for="stocksList" class="form-control-label">Stocks list</label>
      <select class="form-control w-100" id="stocksList" @change="chooseStock">
        <option selected disabled :value="null">Please select</option>
        <option v-for="stock in stocks" :key="stock.is" :value="stock.id">
          {{ stock.name }}
        </option>
      </select>
      <div class="mt-3">
        <label class="form-control-label">Selected stock price</label>
        <span>
          {{ selectedStock ? `${selectedStock.price} $` : "Not selected" }}
        </span>
      </div>
    </div>
    <div class="half">
      <base-input
        v-model.trim="amount"
        additionalClassInput="w-100"
        label="Amount"
        id="amount"
        type="number"
      />
      <div class="mt-3">
        <label class="form-control-label">Total price</label>
        <span>
          {{
            selectedStock ? `${selectedStock.price * amount} $` : "Not selected"
          }}
        </span>
      </div>
    </div>
  </div>

  <div v-if="errors" class="w-100 mt-3">
    <small
      v-for="(error, index) in errors"
      :key="index"
      class="txt-danger fs-s mt-1 mb-1 block"
    >
      {{
        error?.[0]
          .replace("id", "")
          .replace("The purchase price field is required", " ")
      }}
    </small>
  </div>

  <div v-if="purchasePriceError" class="w-100 mt-2">
    <small class="txt-danger fs-s mt-1 mb-1 block">
      Purchase failed. User doesn't have enough balance.
    </small>
  </div>

  <div class="flex flex-justify-end w-100 mt-2">
    <base-button @handleClick="buyStock"> Buy stock </base-button>
  </div>

  <success-modal
    v-if="showSuccessModal"
    title="Congrats!"
    :content="`You purchased new stock`"
  />
</template>

<script>
import { userShowMixin } from "../mixins/userShowMixin";
import { HTTP } from "@utils/HTTP";

import FormAddSuccessModal from "@components/FormAddSuccessModal";
import BaseInput from "@components/BaseInput.vue";
import BaseButton from "@components/BaseButton";

export default {
  name: "ModalUserBuy",
  mixins: [userShowMixin],
  emits: ["closeModal"],
  components: {
    BaseInput,
    BaseButton,
    SuccessModal: FormAddSuccessModal,
  },

  created() {
    this.loadStocks();
  },

  data() {
    return {
      amount: 1,
      stocks: null,
      selectedStock: null,

      errors: [],
      showSuccessModal: false,
      purchasePriceError: false,
    };
  },
  methods: {
    loadStocks: function () {
      HTTP.get(`/stock`)
        .then(({ status, data }) => {
          console.log(data);
          if (status === 200) this.stocks = data;
        })
        .catch((error) => {
          console.log(error);
          alert("Something went wrong 😔");
        });
    },

    chooseStock: function (e) {
      const selected = e.target.value;
      this.selectedStock = this.stocks.find(({ id }) => id == selected);
    },

    buyStock: function () {
      const formData = {
        userId: this.showUser.id,
        stockId: this.selectedStock?.id || null,
        purchasePrice: this.selectedStock?.price || null,
        amount: this.amount,
      };

      HTTP.post(`/transactions`, formData)
        .then(({ data }) => {
          this.errors = [];
          if (data === "error") return (this.purchasePriceError = true);
          this.showSuccessModal = true;
        })
        .catch(({ response }) => {
          console.log(response);
          this.purchasePriceError = false;
          if (response.status == 422) this.errors = response.data.errors;
          else alert("Something went wrong 😔");
        });
    },
  },
};
</script>

<style lang="scss" scoped>
.half {
  width: 49%;
  @media (max-width: 769px) {
    width: 100%;
  }
}

.icon {
  width: 55px;
}
</style>