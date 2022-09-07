<template>
  <div class="navigation-wrapper h-100 relative">
    <div>
      <div
        class="flex flex-space-between flex-align-center w-100 pb-3 resp-navbar"
      >
        <nav-bar-logo />
        <figure class="mobile-only" @click="toggleMenu()">
          <img src="@icons/burger-menu.png" alt="Menu" class="menu-icon" />
        </figure>
      </div>
      <nav>
        <ul :class="{ 'show-menu': showMenu }">
          <li v-for="(route, index) in routes" :key="index">
            <router-link :to="route.path">
              <img :src="`/images/${route.icon}.png`" :alt="route.name" />
              <span>{{ route.name }}</span>
            </router-link>
          </li>
        </ul>
      </nav>
    </div>
    <nav-bar-last-stock />
  </div>
</template>

<script>
import NavBarLogo from "./NavBarLogo.vue";
import NavBarLastStock from "./NavBarLastStock.vue";
import routes from "../router/routes";

export default {
  name: "Navbar",
  components: {
    NavBarLogo,
    NavBarLastStock,
  },
  data() {
    return {
      routes,
      showMenu: window.innerWidth > 768 ? true : false,
    };
  },

  mounted() {
    this.$nextTick(() => {
      window.addEventListener("resize", this.onResize);
    });
  },

  beforeDestroy() {
    window.removeEventListener("resize", this.onResize);
  },

  methods: {
    toggleMenu() {
      this.showMenu = !this.showMenu;
    },

    onResize() {
      this.showMenu = window.innerWidth > 768 ? true : false;
    },
  },
};
</script>

<style lang="scss" scoped>
.navigation-wrapper {
  min-height: 100vh;
  box-sizing: border-box;
  padding: 1.5rem;

  .resp-navbar {
    border-bottom: 1px solid #f3f6f8;
  }

  .menu-icon {
    width: 20px;
    height: 20px;
  }

  ul {
    padding: 3rem 0;

    li {
      padding: 1rem 0;

      a {
        font-size: 15px;
        color: #a2a6af;
        display: flex;
        align-items: center;
      }

      img {
        width: 20px;
        height: 20px;
        padding: 0 0.7rem;
        transition: 0.3s ease;
        transform-origin: 50% 50%;
      }

      &:hover {
        img {
          transform: scale(0.9);
        }

        a {
          color: #0f6a6b69;
        }
      }
    }
  }
}

.show-menu {
  display: block !important;
}

@media (max-width: 769px) {
  .navigation-wrapper {
    min-height: auto !important;
    ul {
      padding: 0 !important;
      padding-top: 1.5rem !important;
      display: none;
    }
  }

  .resp-navbar {
    border-bottom: 0 !important;
    padding-bottom: 0 !important;
  }
}
</style>