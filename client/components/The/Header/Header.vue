<script>
import { useCartStore } from '~/store/cart';
import { useAuthStore } from '~/store/auth';
import { useProductStore } from '~/store/product';

export default {
  setup() {
    const cartStore = useCartStore()
    const authStore = useAuthStore()
    const productStore = useProductStore()
    
    return {
      cartStore,
      authStore,
      productStore
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
      <img src="~assets/images/logo.svg" alt="Kratom">
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
            
          
            <!-- <li :class="{active: isSubmenuActive}" class="header__item header__item__drop">
              <div @click="toggleSubmenuHandler" class="wrapper">
                <a class="text">{{ $t('text.menu') }}</a>
                <img src="~assets/svg-icons/arrow-simple.svg" class="icon icon-drop" />
              </div>
              <ul class="header__drop-list">
                <li
                  v-for="item in subMenu"
                  :key="item.uid"
                  class="header__drop-item">
                  <NuxtLink :to="localePath(item.link)" class="header__drop-link">
                    {{ item.name }}
                  </NuxtLink>
                </li>
              </ul>
            </li> -->
            
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
            <div v-if="isLanguagesActive" class="lang-popup">
              <modal-lang-switcher @select="languageSelectHandler"></modal-lang-switcher>
            </div>
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
              <!-- <img :src="user.photo" class="photo" /> -->
              <nuxt-img
                :src="'/server/'+user.photo"
                sizes = "mobile:24px"
                format = "webp"
                quality = "20"
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

        <modal-menu-mobile :is-active="burgerIsActive" :menu="menu"></modal-menu-mobile>
    </div>
  </header>

  <modal-livesearch></modal-livesearch>

</template>