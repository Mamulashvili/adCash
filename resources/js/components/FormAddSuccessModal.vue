<template>
  <base-modal @closeModal="closeModal">
    <template #content>
      <figure>
        <img src="@icons/checked.png" alt="Success image" />
      </figure>
      <h3 v-if="title" class="txt-accent mt-4 mb-2">{{ title }}</h3>
      <p v-if="content" class="fs-medium fw-100 txt-secondary">
        {{ content }}
      </p>
    </template>
  </base-modal>
</template>

<script>
import ModalLayout from "@layouts/ModalLayout.vue";

export default {
  name: "FormAddSuccessModal",
  components: {
    BaseModal: ModalLayout,
  },
  props: {
    title: {
      type: String,
      required: false,
    },
    content: {
      type: String,
      required: true,
    },
  },
  methods: {
    closeModal: function () {
      location.reload();
    },
  },
};
</script>

<style lang="scss" scoped>
img {
  max-width: 70px;
}
</style>