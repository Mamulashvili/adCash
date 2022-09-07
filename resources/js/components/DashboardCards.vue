<template>
  <div class="container-lg cards-wrapper flex flex-space-between">
    <dashboard-card
      v-for="card in cardsData"
      :key="card.contentName"
      :additionalStyle="card.additionalStyle"
      :iconName="card.iconName"
      :headerText="card.headerText"
      :contentName="card.contentName"
      :contentDesc="card.contentDesc"
    />
  </div>
</template>

<script>
import DashboardCard from "@components/DashboardCard.vue";
import CardsData from "@utils/dashboardCardsData";

export default {
  name: "DashboardCards",
  components: {
    DashboardCard,
  },

  data() {
    return {
      cardsData: CardsData,
    };
  },
};
</script>

<style lang="scss" scoped>
.cards-wrapper {
  padding: 2rem 0;
  box-sizing: border-box;
  margin: auto;
}

.invest-shape {
  background: url("@icons/abstract-1.png") no-repeat bottom right;
  background-size: 30%;
}

.guru-shape {
  background: url("@icons/abstract-3.png") no-repeat bottom right;
  background-size: 40%;
}
</style>