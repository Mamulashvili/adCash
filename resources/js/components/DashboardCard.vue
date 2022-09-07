<template>
  <card-layout>
    <template #header>
      <card-header :iconName="iconName" :headerText="headerText" />
    </template>
    <template #default>
      <card-content :contentName="contentName" :contentDesc="contentDesc" />
    </template>
    <template #footer>
      <card-footer />
    </template>
  </card-layout>
</template>

<script>
import CardLayout from "@layouts/CardLayout";
import CardHeader from "@components/DashboardCardHeader";
import CardContent from "@components/DashboardCardContent";
import CardFooter from "@components/DashboardCardFooter";

export default {
  name: "DashboardCard",
  props: {
    iconName: {
      type: String,
      required: true,
      default: "lamp",
    },
    headerText: {
      type: String,
      required: true,
      default: "Test",
    },
    contentName: {
      type: String,
      required: true,
      default: "Test name",
    },
    contentDesc: {
      type: String,
      required: true,
      default: "Description...",
    },
  },
  components: {
    CardLayout,
    CardHeader,
    CardContent,
    CardFooter,
  },
};
</script>
