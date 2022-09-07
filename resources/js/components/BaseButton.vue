<template>
  <button
    :class="['btn', additionalClass]"
    :style="additionalStyle"
    @click="(e) => handleClick(e)"
  >
    <slot></slot>
  </button>
</template>

<script>
export default {
  name: "BaseButton",
  emits: ["handleClick"],
  props: {
    additionalClass: {
      type: String,
      required: false,
    },
    additionalStyle: {
      type: String,
      required: false,
    },
  },
  methods: {
    handleClick(e) {
      this.$emit("handleClick", e);
    },
  },
};
</script>

<style lang="scss" scoped>
.btn {
  cursor: pointer;
  color: #737080;
  transition: 0.2s ease;

  &:hover {
    background-color: #737080;
    border-color: #737080;
    color: #fff;
  }
}
</style>