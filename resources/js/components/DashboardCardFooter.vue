<template>
  <span @click="showAlert()" class="txt-accent fw-bold fs-medium">
    Learn more
  </span>
</template>

<script>
export default {
  name: "DashboardCardFooter",
  methods: {
    showAlert: () => {
      alert("Some redirect link 🔗🤷🏻‍♂️");
    },
  },
};
</script>

<style lang="scss" scoped>
img {
  max-width: 50px;
}
span {
  cursor: pointer;
}
</style>