<template>
  <Teleport to="body">
    <div class="fade relative">
      <div
        :class="[
          'modal',
          'brd-radius',
          'bg-white',
          'box-shadow',
          'brd-radius',
          mAdditionalStyle,
        ]"
        :style="{ width: mWidth, height: mHeight }"
      >
        <figure>
          <img
            src="@icons/close.png"
            class="close-button"
            alt="Close"
            @click="$emit('closeModal', e)"
          />
        </figure>
        <slot name="header"></slot>
        <slot name="content"></slot>
        <slot name="footer"></slot>
      </div>
    </div>
  </Teleport>
</template>

<script>
export default {
  name: "BaseModal",
  emits: ["closeModal"],
  props: {
    mWidth: {
      type: String,
      required: false,
      default: "50%",
    },
    mHeight: {
      type: String,
      required: false,
      default: "200px",
    },
    mAdditionalStyle: {
      type: String,
      required: false,
    },
  },
};
</script>

<style lang="scss" scoped>
.fade {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: #00000070;
  z-index: 2;
}
.modal {
  position: fixed;
  z-index: 3;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
  padding: 1.5rem;
  max-width: 700px;
  display: flex;
  align-items: center;
  flex-direction: column;
  justify-content: center;

  .close-button {
    width: 15px;
    height: 15px;
    right: 1rem;
    top: 1rem;
    position: absolute;
    cursor: pointer;
  }
}
</style>