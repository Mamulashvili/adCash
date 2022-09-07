<template>
  <router-link
    :to="route"
    :class="[
      'link',
      'mt-3',
      'block',
      'brd-radius',
      'inline-block',
      additionalStyle,
      filled && 'filled',
      outlined && 'outlined',
    ]"
  >
    <p :class="textStyle">{{ text }}</p>
  </router-link>
</template>

<script>
export default {
  name: "BaseLink",
  props: {
    route: {
      type: [String, Object],
      required: true,
      default: "/",
    },
    text: {
      type: String,
      required: true,
      default: "Default route link",
    },
    filled: {
      type: Boolean,
      required: false,
    },
    outlined: {
      type: Boolean,
      required: false,
    },
    additionalStyle: {
      type: [Object, String],
      required: false,
    },
    textStyle: {
      type: [Object, String],
      required: false,
    },
  },
};
</script>

<style lang="scss" scoped>
.link {
  // background-color: red;
  text-decoration: none;
  color: inherit;
  border: none;
  padding: 0.8rem 0.7rem;
}

.filled {
  color: #fff !important;
  background-color: #0f6a6b;
}

.outlined {
  border: 1px solid #0f6a6b !important;
}
</style>