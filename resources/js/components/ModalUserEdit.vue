<template>
  <div v-if="showUser" class="wrapper flex flex-center flex-column">
    <p class="title fw-bold block mb-2">
      Edit user
      <span class="fw-bold txt-accent">
        {{ `${showUser?.fname} ${showUser?.lname}` }}
      </span>
    </p>
  </div>
  <div class="w-100">
    <base-input
      v-model.trim="username"
      additionalClassWrapper="mb-3"
      additionalClassInput="w-100"
      label="Username"
      id="user_usr"
      type="text"
      disabled
    />
    <base-input
      v-model.trim="fname"
      additionalClassWrapper="mb-3"
      additionalClassInput="w-100"
      label="Firstname"
      id="user_fn"
      type="text"
    />
    <base-input
      v-model.trim="lname"
      additionalClassWrapper="mb-3"
      additionalClassInput="w-100"
      label="Lastname"
      id="user_ln"
      type="text"
    />
    <div v-if="errorMessages" class="w-100">
      <small
        v-for="(error, index) in errorMessages"
        :key="index"
        class="txt-danger fs-s mt-1 mb-1 block"
      >
        {{
          error?.[0].replace("fname", "firstname").replace("lname", "lastname")
        }}
      </small>
    </div>
    <p v-if="successMessage" class="fs-default txt-accent">
      User updated successfully!
    </p>
    <div class="flex flex-justify-end w-100">
      <base-button @handleClick="updateUser"> Update </base-button>
    </div>
  </div>
</template>

<script>
import BaseInput from "@components/BaseInput";
import BaseButton from "@components/BaseButton.vue";
import { HTTP } from "@utils/HTTP";

export default {
  name: "ModalUserEdit",
  emits: ["closeModal"],
  components: {
    BaseInput,
    BaseButton,
  },
  props: {
    itemId: {
      type: Number,
      required: true,
      default: 1,
    },
  },

  created() {
    this.getUser();
  },
  data() {
    return {
      showUser: null,
      username: "",
      fname: "",
      lname: "",
      successMessage: false,
      errorMessages: null,
    };
  },
  methods: {
    updateUser: function () {
      const formData = {
        fname: this.fname,
        lname: this.lname,
      };

      HTTP.put(`/users/${this.itemId}`, formData)
        .then((resp) => {
          if (resp.status === 200) this.successMessage = true;
          this.errorMessages = null;
        })
        .catch(({ response }) => {
          this.successMessage = false;
          if (response.status === 422)
            this.errorMessages = response?.data?.errors;
          else alert("Something went wrong 😔");
        });
    },

    getUser: function () {
      HTTP.get(`/users/${this.itemId}`)
        .then(({ data }) => {
          console.log(data);
          this.showUser = data;
          this.username = data.username;
          this.fname = data.fname;
          this.lname = data.lname;
        })
        .catch((e) => {
          console.log(e);
          alert("Something went wrong 😔");
        });
    },
  },
};
</script>