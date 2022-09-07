<template>
  <div class="container-lg ma bg-white brd-radius table-holder box-shadow">
    <p class="secondary-title mt-0">
      <span>{{ titlePr ? titlePr : "Recent" }}</span>
      <span class="pl-1">{{ titleSec ? titleSec : "Transactions" }}</span>
    </p>

    <table id="base-table" class="mt-4">
      <slot name="header"></slot>
      <slot name="content"></slot>
    </table>
  </div>
</template>

<script>
export default {
  name: "BaseTable",
  props: {
    titlePr: {
      type: String,
      required: false,
    },
    titleSec: {
      type: String,
      required: false,
    },
  },
};
</script>

<style lang="scss" scoped>
.table-holder {
  box-sizing: border-box;
  padding: 1.5rem;

  @media (max-width: 769px) {
    overflow: auto;
    max-width: 100%;
  }
}
</style>