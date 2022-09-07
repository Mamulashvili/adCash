<template>
  <div
    :class="[
      'wrapper',
      'absolute',
      'brd-radius',
      'box-shadow',
      additionalStyle,
    ]"
  >
    <slot></slot>
  </div>
</template>

<script>
export default {
  name: "BaseActionsModal",
  props: {
    additionalStyle: {
      type: String,
      required: false,
      default: "",
    },
  },
};
</script>

<style lang="scss" scoped>
.wrapper {
  background-color: #fff;
  min-width: 50px;
  padding: 0.5rem;
  z-index: 2;
  transition: 0.2s ease;
}
</style>