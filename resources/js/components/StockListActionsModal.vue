<template>
  <base-button
    additionalClass="relative mt-0 mb-0"
    @click="() => toggleModalVisibility()"
  >
    <span>More</span>
    <base-actions-modal
      tabindex="0"
      additionalStyle="modal"
      v-if="modalVisibility"
    >
      <ul>
        <li @click="handleAction('edit')">
          <span>Edit stock</span>
        </li>
        <li @click="handleAction('delete')">
          <span class="txt-danger">Delete</span>
        </li>
      </ul>
    </base-actions-modal>
  </base-button>
</template>

<script>
import BaseButton from "@components/BaseButton";
import BaseActionsModal from "@components/BaseActionsModal";

export default {
  name: "StockListActionsModal",
  components: {
    BaseButton,
    BaseActionsModal,
  },
  emits: ["stockAction"],
  props: {
    stockId: {
      type: Number,
      required: true,
    },
  },

  data() {
    return {
      modalVisibility: false,
    };
  },

  methods: {
    toggleModalVisibility: function () {
      this.modalVisibility = !this.modalVisibility;
    },

    handleAction: function (actionType) {
      this.$emit("stockAction", {
        stockId: this.stockId,
        actionType,
      });
    },
  },
};
</script>

<style lang="scss" scoped>
ul li {
  text-align: left;
  margin: 0.6rem 0;
}

.modal {
  min-width: 150px;
  font-size: 15px;
}

.btn:hover {
  background-color: initial !important;
  color: initial !important;
}

.btn-active {
  background-color: #737080;
  border-color: #737080;
  color: #fff;
}
</style>