<template>
  <base-banner
    src="banner-newuser"
    title="New user"
    subtitle="Here you can create new account!"
    description="Where The Stock Market Meets Fantasy Sports. Manage A $1 Million Virtual Portfolio."
    :additionalStyleImageObject="imageStyle"
    :route="{ name: 'Users list' }"
    routeText="Show active users"
    alt="Add new user"
  />
  <div class="mt-4">
    <user-add-form />
  </div>
</template>

<script>
import BaseBanner from "@components/BaseBanner.vue";
import UserAddForm from "@components/FormUserAdd.vue";

export default {
  name: "UserAdd",
  components: {
    BaseBanner,
    UserAddForm,
  },

  computed: {
    imageStyle() {
      return {
        "max-width": "23%",
      };
    },
  },
};
</script>
