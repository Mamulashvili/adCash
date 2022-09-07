<template>
  <page-layout>
    <router-view />
  </page-layout>
</template>


<script>
import PageLayout from '@layouts/PageLayout.vue';

export default {
  name: "App",
  components: { PageLayout }
};
</script>