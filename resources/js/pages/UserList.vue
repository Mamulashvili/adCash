<template>
  <base-banner
    src="banners-users"
    title="User list"
    subtitle="See all active users"
    description="Active users is a measurement metric that is commonly used to measure the level of engagement for a particular product or object"
    :additionalStyleImageObject="imageStyle"
    :route="{ name: 'Add user' }"
    routeText="Add new user"
    alt="User list"
  />
  <div class="mt-4">
    <base-table title-pr="User" title-sec="list">
      <template #header>
        <tr>
          <th>Avatar</th>
          <th>Username</th>
          <th>Firstname</th>
          <th>Lastname</th>
          <th>Deposit</th>
          <th>Profit</th>
          <th>Actions</th>
        </tr>
      </template>
      <template #content>
        <tr v-for="item in data" :key="item.id">
          <td>
            <figure>
              <img
                :alt="item.name"
                :src="imageSource(item.avatar)"
                class="user-avatar brd-rounded"
              />
            </figure>
          </td>
          <td>{{ item.username }}</td>
          <td>{{ item.fname }}</td>
          <td>{{ item.lname }}</td>
          <td>{{ item.deposit }}</td>
          <td>{{ item.profit || 0 }}$</td>
          <td>
            <user-list-actions-modal
              :item-id="item.id"
              @userAction="handleUserAction"
            />
          </td>
        </tr>
      </template>
    </base-table>
  </div>
  <base-modal
    v-if="showModal"
    m-width="70%"
    :m-height="actionType === 'view' ? '60%' : '300px'"
    @closeModal="closeModal"
  >
    <template #content>
      <component
        :is="modalComponent"
        @closeModal="closeModal"
        :item-id="selectedItemId"
      />
    </template>
  </base-modal>
</template>

<script>
import UserListActionsModal from "@components/UserListActionsModal.vue";
import BaseBanner from "@components/BaseBanner.vue";
import ModalLayout from "@layouts/ModalLayout.vue";
import BaseTable from "@components/BaseTable.vue";

import { capitalizeFirstLetter } from "@utils/helpers";
import { HTTP } from "@utils/HTTP";

import { defineAsyncComponent } from "vue";

export default {
  name: "UserList",
  components: {
    BaseModal: ModalLayout,
    UserListActionsModal,
    BaseBanner,
    BaseTable,
  },

  created() {
    this.getUsers();
  },

  updated() {
    if (!this.showModal) this.getUsers();
  },

  data() {
    return {
      data: null,
      showModal: false,
      actionType: null,
      selectedItemId: null,
      componentToDisplay: null,
    };
  },
  methods: {
    getUsers: function () {
      HTTP.get(`/users/get`)
        .then(({ data }) => {
          console.log("All users - ", data);
          this.data = data;
        })
        .catch((e) => {
          alert("Something went wrong 😔");
          console.log(e);
        });
    },

    closeModal: function () {
      this.showModal = false;
    },

    imageSource: function (imageSrc) {
      return imageSrc ? `/storage/${imageSrc}` : "/images/avatar.png";
    },

    handleUserAction: function ({ actionType, itemId }) {
      this.actionType = actionType;
      this.showModal = true;
      this.selectedItemId = itemId;
      this.componentToDisplay = capitalizeFirstLetter(actionType);
    },
  },

  computed: {
    imageStyle() {
      return {
        "max-width": "25%", // No overflow for banner
      };
    },
    modalComponent() {
      console.log(this.componentToDisplay);
      return defineAsyncComponent(() =>
        import(`@components/ModalUser${this.componentToDisplay}.vue`)
      );
    },
  },
};
</script>
