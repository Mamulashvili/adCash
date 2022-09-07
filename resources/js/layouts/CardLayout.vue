<template>
  <div
    :class="[
      'card',
      'flex',
      'brd-radius',
      'box-shadow',
      'flex-column',
      additionalStyle,
    ]"
  >
    <slot name="header"></slot>
    <slot></slot>
    <slot name="footer"></slot>
  </div>
</template>

<script>
export default {
  name: "CardLayout",
  props: ["additionalStyle"],
};
</script>

<style lang="scss" scoped>
.card {
  padding: 1.5rem;
  max-width: 47%;
  background-color: #fff;
  box-sizing: border-box;

  @media (max-width: 769px) {
    max-width: 100%;
    margin-bottom: 1rem;
  }
}
</style>