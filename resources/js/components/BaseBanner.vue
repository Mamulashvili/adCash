<template>
  <div
    :class="[
      'banner-wrapper',
      'relative',
      'brd-radius',
      'box-shadow',
      'container-lg',
      additionalStyleBanner,
    ]"
  >
    <div class="banner-text-holder">
      <h1 class="txt-accent">{{ title }}</h1>
      <p class="mt-3 txt-secondary">
        <span v-if="subtitle" class="fw-bold">
          {{ subtitle }}
        </span>
        <br />
        <span class="mt-2 block banner-description">
          {{ description }}
        </span>
      </p>
    </div>
    <img
      v-if="src"
      :alt="alt"
      :src="`/images/${src}.png`"
      :class="['banner-hero', 'absolute', additionalStyleImage]"
      :style="additionalStyleImageObject"
    />
    <base-link
      v-if="route"
      :route="route"
      :text="routeText"
      textStyle="txt-accent"
      additionalStyle="mt-0 pl-0 pb-0"
    />
  </div>
</template>

<script>
import BaseLink from "@components/BaseLink";

export default {
  name: "BaseBanner",
  components: {
    BaseLink,
  },
  props: {
    title: {
      type: String,
      required: true,
      default: "Test title",
    },
    subtitle: {
      type: String,
      required: false,
    },
    description: {
      type: String,
      required: true,
      default: "Description...",
    },
    src: {
      type: String,
      required: false,
    },
    alt: {
      type: String,
      required: true,
      default: "hero image",
    },
    additionalStyleBanner: {
      type: [String, Object],
      required: false,
    },
    additionalStyleImage: {
      type: [String, Object],
      required: false,
    },
    route: {
      type: Object,
      required: false,
      default: () => {
        name: "Dashboard";
      },
    },
    routeText: {
      type: String,
      required: false,
      default: "Get started",
    },
    additionalStyleImageObject: {
      type: Object,
      required: false,
      default: () => {},
    },
  },
};
</script>

<style lang="scss" scoped>
.banner-wrapper {
  margin: auto;
  margin-top: 2rem;
  padding: 2rem 3rem;
  box-sizing: border-box;
  background-color: #fff;

  .banner-text-holder {
    max-width: 60%;
  }

  .banner-hero {
    max-width: 300px;
    right: 0;
    top: 0;
    bottom: 0;
    margin: auto;
  }

  .pl-0 {
    padding-left: 0 !important;
  }
}

.banner-description {
  line-height: 115%;
  font-weight: 100;
  font-size: 14px;
}

@media (max-width: 769px) {
  .banner-wrapper {
    padding: 2rem;
    .banner-text-holder {
      max-width: 100%;
    }

    .banner-hero {
      max-width: 150px;
      top: auto;
    }
  }
}
</style>