<template>
  <div class="mt-4 mb-4">
    <p class="fw-bold">{{ contentName }}</p>
    <small class="fw-s block mt-2">
      {{ contentDesc }}
    </small>
  </div>
</template>

<script>
export default {
  name: "DashboardCardContent",
  props: ["contentName", "contentDesc"],
};
</script>

<style lang="scss" scoped>
img {
  max-width: 50px;
}
small {
  line-height: 120%;
  color: #9299a4;
}
p {
  color: #5e697b;
}
</style>