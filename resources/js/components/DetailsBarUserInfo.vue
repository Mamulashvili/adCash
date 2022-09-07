<template>
  <div class="info-holder flex flex-align-center flex-justify-end">
    <div class="user-details mr-2 text-right">
      <p class="fw-bold txt-accent">John Doe</p>
      <small class="txt-primary"> johndoe@gmail.com </small>
    </div>
    <figure>
      <img src="@icons/avatar.png" alt="User avatar" class="brd-radius" />
    </figure>
  </div>
</template>

<style lang="scss" scoped>
.info-holder {
  background-color: #fafafa;
  padding: 1.5rem;

  figure img {
    max-width: 50px;
  }

  @media (max-width: 769px) {
    flex-direction: row-reverse;

    .user-details {
      text-align: left;
      padding-left: 1rem;
    }
  }
}
</style>