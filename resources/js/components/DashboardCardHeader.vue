<template>
  <div class="flex flex-space-between flex-align-center">
    <figure>
      <img :src="`/images/${iconName}.png`" alt="Icon" />
    </figure>
    <small class="txt-accent fw-100">{{ headerText }}</small>
  </div>
</template>

<script>
export default {
  name: "DashboardCardHeader",
  props: ["iconName", "headerText"],
};
</script>

<style lang="scss" scoped>
img {
  max-width: 50px;
}
</style>