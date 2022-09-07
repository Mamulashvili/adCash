<template>
  <router-link to="/">
    <figure class="flex flex-align-center">
      <img src="@icons/logo.png" alt="Logo" />
      <figcaption class="pl-2 fs-logo fw-bold txt-accent">
        Stock Overflow
      </figcaption>
    </figure>
  </router-link>
</template>

<style lang="scss" scoped>
figure {
  img {
    max-width: 25px;
  }
}

.router-link-exact-active {
  border-left: none;
}
</style>