<template>
  <base-banner
    src="banner-hero"
    title="Fantasy Finance"
    subtitle="The fun and
  social way to learn how to invest."
    description=" Learn the markets and
  sharpen your skills without risking real money by managing a $1M virtual
  portfolio."
    :route="{ name: 'Add user' }"
    routeText="Get started"
    alt="Dashboard banner hero"
  />
</template>

<script>
import BaseBanner from "@components/BaseBanner.vue";

export default {
  name: "DashboardBannerWrapper",
  components: { BaseBanner },
};
</script>