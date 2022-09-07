<template>
  <div class="main-wrapper flex">
    <aside class="left-side">
      <nav-bar />
    </aside>
    <main class="content-wrapper bg-secondary">
      <slot> </slot>
    </main>
    <aside class="right-side">
      <details-bar />
    </aside>
  </div>
</template>

<script>
import NavBar from "@components/NavBar.vue";
import DetailsBar from "@components/DetailsBar";

export default {
  name: "PageLayout",
  components: {
    NavBar,
    DetailsBar,
  },
};
</script>

<style lang="scss" scoped>
.main-wrapper {
  .left-side,
  .right-side {
    width: 20%;
  }

  .content-wrapper {
    width: 60%;
  }
}

@media (max-width: 769px) {
  .left-side,
  .right-side,
  .content-wrapper {
    width: 100% !important;
  }

  .right-side {
    background-color: #f3f6f8;
  }

  .main-wrapper {
    flex-direction: column;
  }
}
</style>