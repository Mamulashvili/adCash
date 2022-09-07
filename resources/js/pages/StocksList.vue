<template>
  <base-banner
    src="banner-stocklist"
    title="Stock list"
    subtitle="See all active stocks"
    description="A stock, also known as equity, is a security that represents the ownership of a fraction of the issuing corporation."
    :additionalStyleImageObject="imageStyle"
    :route="{ name: 'Add stock' }"
    routeText="Add new stock"
    alt="Stock list"
  />
  <div class="mt-4">
    <base-table title-pr="Stock" title-sec="list">
      <template #header>
        <tr>
          <th>Company</th>
          <th>Price</th>
          <th>Created</th>
          <th>Actions</th>
        </tr>
      </template>
      <template #content>
        <tr v-for="item in data" :key="item.id">
          <td>{{ item.name }}</td>
          <td>{{ item.price }} $</td>
          <td>{{ item.created_at }}</td>
          <td>
            <stock-list-actions-modal
              :stock-id="item.id"
              @stockAction="handleStockAction"
            />
          </td>
        </tr>
      </template>
    </base-table>
  </div>
  <base-modal
    v-if="showModal"
    m-width="70%"
    m-height="300px"
    @closeModal="closeModal"
  >
    <template #content>
      <component
        :is="modalComponent"
        @closeModal="closeModal"
        :stock-id="selectedStockId"
      />
    </template>
  </base-modal>
</template>

<script>
import { defineAsyncComponent } from "vue";

import BaseBanner from "@components/BaseBanner.vue";
import BaseTable from "@components/BaseTable.vue";
import BaseButton from "@components/BaseButton.vue";
import StockListActionsModal from "@components/StockListActionsModal.vue";
import ModalLayout from "@layouts/ModalLayout.vue";

import { HTTP } from "@utils/HTTP";
import { capitalizeFirstLetter } from "@utils/helpers";

export default {
  name: "StockList",
  components: {
    BaseBanner,
    BaseTable,
    BaseButton,
    StockListActionsModal,
    BaseModal: ModalLayout,
  },

  data() {
    return {
      data: null,
      showModal: false,
      selectedStockId: null,
      componentToDisplay: null,
    };
  },

  created() {
    this.getStocks();
  },

  methods: {
    getStocks: function () {
      HTTP.get(`/stock`)
        .then(({ data }) => {
          console.log("All stocks - ", data);
          this.data = data;
        })
        .catch((e) => {
          alert("Something went wrong 😔");
          console.log(e);
        });
    },

    closeModal: function () {
      this.showModal = false;
    },

    handleStockAction: function ({ actionType, stockId }) {
      this.showModal = true;
      this.selectedStockId = stockId;
      this.componentToDisplay = capitalizeFirstLetter(actionType);
    },
  },

  computed: {
    imageStyle() {
      return {
        "max-width": "25%", // No overflow for banner
      };
    },
    modalComponent() {
      console.log(this.componentToDisplay);
      return defineAsyncComponent(() =>
        import(`@components/ModalStock${this.componentToDisplay}.vue`)
      );
    },
  },
};
</script>