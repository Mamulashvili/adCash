<template>
  <li class="flex flex-align-center mb-2 brd-radius">
    <figure class="def-brd brd-radius flex flex-center">
      <img
        alt="Avatar icon"
        :src="imageSource"
        class="user-avatar brd-rounded"
      />
    </figure>
    <div class="user-details ml-2">
      <p class="fs-medium">
        <span class="fw-bold">@</span>
        {{ username }}
      </p>
      <small class="fs-s">{{ date }}</small>
    </div>
  </li>
</template>

<script>
export default {
  name: "DetailsBarRecentUserCard",
  props: {
    username: {
      type: String,
      required: true,
      default: "",
    },
    date: {
      type: String,
      required: true,
      default: "",
    },
    imageSrc: {
      type: [String, null],
      required: true,
    },
  },
  computed: {
    imageSource: function () {
      return this.imageSrc ? `/storage/${this.imageSrc}` : "/images/avatar.png";
    },
  },
};
</script>

<style lang="scss" scoped>
.user-details {
  padding: 0.7rem;
  p {
    color: #585973;
  }
  small {
    color: #a8a9b4;
  }
}

figure {
  padding: 0.5rem;
}
</style>