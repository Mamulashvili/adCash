<template>
  <div v-if="users">
    <p class="secondary-title mb-1 mt-5">
      <span class="fw-bold">Recent</span>
      <span class="pl-1">users</span>
    </p>

    <div>
      <recent-users-layout>
        <recent-user
          v-for="user in users"
          :key="user.username"
          :username="user.username"
          :date="user?.created_at"
          :imageSrc="user.avatar"
        />
      </recent-users-layout>
    </div>
  </div>
</template>


<script>
import RecentUsersLayout from "@layouts/RecentUsersLayout";
import RecentUser from "./DetailsBarRecentUserCard.vue";
import { HTTP } from "@utils/HTTP";
import { GET_NEW_USERS_LIMIT } from "@utils/constants";

export default {
  name: "DetailsBarRecentUsers",
  components: {
    RecentUsersLayout,
    RecentUser,
  },

  created() {
    this.loadLastUsers();
  },

  data() {
    return {
      users: null,
    };
  },

  methods: {
    loadLastUsers: function () {
      HTTP.get(`users/get?limit=${GET_NEW_USERS_LIMIT}`)
        .then(({ data }) => {
          this.users = data;
        })
        .catch((e) => {
          alert("Something went wrong 😔");
          console.log(e);
        });
    },
  },
};
</script>

<style lang="scss" scoped>
ul li {
  &:nth-child(odd) {
    background-color: #f8f8f8;
  }
}
</style>