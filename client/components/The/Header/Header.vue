<script>
import { useCartStore } from '~/store/cart';
import { useAuthStore } from '~/store/auth';
import { useProductStore } from '~/store/product';

export default {
  setup() {
    const cartStore = useCartStore()
    const authStore = useAuthStore()
    const productStore = useProductStore()
    
    const isModalLivesearchActive = computed(() => {
      return productStore.livesearchIsShow
    })

    return {
      cartStore,
      authStore,
      productStore,
      isModalLivesearchActive
    }
  },

  data() {
    return {
      isLanguagesActive: false,
      isSubmenuActive: false,
      menu: null,
      burgerIsActive: false
    }
  },

  computed: {
    user() {
      return this.authStore.getUser
    },

    isAuth() {
      return this.authStore.isAuth
    },

    isMenuObserved() {
      const carry = Object.keys(this.menu).reduce((carry, key) => {
        return carry + this.menu[key].observed
      }, 0)

      return  carry === Object.keys(this.menu).length
    },

    cartLength() {
      return this.cartStore.cart.length
    },

    photo() {
      return this.user.photo.startsWith('http')? this.user.photo :'/server/' + this.user.photo
    }
  },

  methods: {
    setMenu() {
      const groups = useProductGroups()
      const productGroups = groups.reduce((carry, item) => carry.concat(item.items), [])
      
      this.menu = useMenu().menu

      this.menu.shop.items = productGroups
      this.menu = Object.assign(this.menu, {
        menu: {
          id: 'menu',
          link: null,
          name: this.$t('title.menu'),
          items: [],
          observed: false
        },
      })
    },


    observeCallback: function (index, visible) {
      
      this.menu[index].observed = true

      if(!visible && index !== 'menu') {
        const hiddenItem = this.menu[index]
        delete this.menu[index]

        this.menu.menu.items.push(hiddenItem)
      }
    },

    toggleSearchHandler() {
      this.productStore.toggleModal()
    },

    toggleLanguagesHandler() {
      this.isLanguagesActive = !this.isLanguagesActive
    },

    languageSelectHandler() {
      this.isLanguagesActive = false
    },

    openCartHandler() {
      this.cartStore.open()
    },

    openSignInSocialHandler() {
      this.authStore.open('signInSocial')
    },

    toggleSubmenuHandler() {
      this.isSubmenuActive = !this.isSubmenuActive
    },

    toggleBurgerHandler() {
      this.burgerIsActive = !this.burgerIsActive
    },

    closeMobileMenuHandler() {
      this.burgerIsActive = false
    }
  },

  created() {
    this.setMenu()
  },
}
</script>

<style src="./header.scss" lang="sass" scoped />

<template>
  <header class="header">
    
    <NuxtLink :to="localePath('/')" class="logo">
      <nuxt-img
        src="/images/logo.png"
        alt="Kratomhelper.com logo"
        title="Kratomhelper.com logo"
        width="138"
        height="31"
        sizes = "mobile:138px tablet:138px desktop:138px"
        format = "webp"
        fit="contain"
        quality = "70"
        loading = "lazy"
        class="logo">
      </nuxt-img>
    </NuxtLink>

    <nav :class="{overflow: isMenuObserved}" class="nav">
        <span class="general-decor-elem"></span>

        <ul class="list">
            <li
              v-for="(item, key) in menu"
              :key="item.id"
              v-observe="{index: key, callback: observeCallback}"
              class="item"
            >
                <NuxtLink
                  :to="localePath(item.link)"
                  class="link"
                >
                  {{ item.name }}
                </NuxtLink>

                <img v-if="item.items && item.items.length" src="~assets/svg-icons/arrow-simple.svg" class="icon" />

                <ul v-if="item.items && item.items.length" class="submenu">
                  <li v-for="subitem in item.items" :key="subitem.id" class="submenu-item">
                    <NuxtLink :to="subitem.link" class="submenu-link">
                      {{ subitem.name }}
                    </NuxtLink>
                  </li>
                </ul>
            </li>
        </ul>
        <button class="header__close-nav">
          <span class="icon-close"></span>
        </button>
    </nav>

    <div class="phone">
      <a href="tel:+420 722 133 136">+420 722 133 136</a>
    </div>

    <div class="btns-set">
        <!-- SEARCH BUTTON -->
        <div class="search-btn">
          <button @click="toggleSearchHandler" class="header__search__button">
            <img src="~assets/svg-icons/search.svg" class="icon"  />
          </button>
        </div>

        <!-- LANGUAGE BUTTON -->
        <div class="lang-btn">
          <transition name="fade-in">
            <modal-lang-switcher
              v-if="isLanguagesActive"
              @select="languageSelectHandler"
              class="lang-popup"
            >
            </modal-lang-switcher>
          </transition>
	        
	        <button class="js-button js-drop-button" @click="toggleLanguagesHandler">
            <img src="~assets/svg-icons/globe.svg" class="icon" />
          </button>
        </div>

        <!-- PROFILE BUTTON -->
        <div class="profile-btn">
            <button v-if="!isAuth" @click="openSignInSocialHandler">
              <img src="~assets/svg-icons/user.svg" class="icon" />
            </button>

            <NuxtLink v-else-if="isAuth && user" :to="localePath('/account/order-history')">
              <nuxt-img
                :src="photo"
                width="24"
                height="24"
                sizes = "mobile:24px"
                format = "webp"
                quality = "20"
                fit="cover"
                loading = "lazy"
                class="photo"
              >
              </nuxt-img>
            </NuxtLink>
        </div>
        
        <!-- CART BUTTON -->
        <div class="cart-btn">
          <button class="js-button" @click="openCartHandler">
            <img src="~assets/svg-icons/cart.svg" class="icon"  />
          </button>
          <span class="decor-cart" v-if="cartLength"></span>
        </div>

        <!-- MOBULE MENU BUTTON -->
        <button @click="toggleBurgerHandler" :class="{active: burgerIsActive}" class="burger-btn">
          <span class="decor"></span>
        </button>

        <transition name="move-x-right">
          <modal-menu-mobile
            v-if="burgerIsActive"
            :menu="menu"
            @close="closeMobileMenuHandler"
          ></modal-menu-mobile>
        </transition>
    </div>
  </header>

  <transition name="fade-in">
    <modal-livesearch v-if="isModalLivesearchActive"></modal-livesearch>
  </transition>

</template>