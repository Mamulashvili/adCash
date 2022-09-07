<template>
  <div class="details-bar-wrapper">
    <details-bar-user-info />
    <div class="details-wrapper">
      <details-bar-balance />
      <details-bar-recent-users />
    </div>
  </div>
</template>

<script>
import DetailsBarUserInfo from "./DetailsBarUserInfo";
import DetailsBarBalance from "./DetailsBarBalance";
import DetailsBarRecentUsers from "./DetailsBarRecentUsers";

export default {
  name: "DetailsBar",
  components: {
    DetailsBarUserInfo,
    DetailsBarBalance,
    DetailsBarRecentUsers,
  },
};
</script>

<style lang="scss" scoped>
.details-bar-wrapper {
  .details-wrapper {
    padding: 1.5rem;
  }

  @media (max-width: 769px) {
    max-width: 90%;
    margin: 2rem auto;
    background-color: #fff;
    border-radius: 7px;
  }
}
</style>