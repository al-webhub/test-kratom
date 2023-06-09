<script setup>
  import { useCartStore } from '~/store/cart';
  import { useModalStore } from '~/store/modal';
  import { useAuthStore } from '~/store/auth';

  const { t } = useI18n()
  
  // DATA
  const isLanguagesActive = ref(false)
  const isBurgerActive = ref(false)

  // COMPUTED
  const user = computed(() => {
    return useAuthStore().getUser
  })
  
  const isAuth = computed(() => {
    return useAuthStore().isAuth
  })

  const cartLength = computed(() => {
    return useCartStore().cart.length
  })

  const photo = computed(() => {
    return user.value.photo.startsWith('http')? user.value.photo :'/server/' + user.value.photo
  })

  const isModalLivesearchActive = computed(() => {
    return useModalStore().show('search')
  })

  const isHomePage = computed(() => {
    return useRoute().name.startsWith('index')
  })

  // HANDLER METHODS
  const openModalCartHandler = () => {
    useModalStore().open('cart')
  }

  const toggleModalSearchHandler = () => {
    useModalStore().toggle('search')
  }

  const toggleModalLanguagesHandler = () => {
    isLanguagesActive.value = !isLanguagesActive.value
  }

  const toggleModalBurgerHandler = () => {
    isBurgerActive.value = !isBurgerActive.value
  }

  const closeModalMobileMenuHandler = () => {
    isBurgerActive.value = false
  }

  const openModalSignInSocialHandler = () => {
    useModalStore().open('signInSocial')
  }

  const languageSelectHandler = () => {
    isLanguagesActive.value = false
  }
</script>

<style src="./header.scss" lang="sass" scoped />

<template>
  <header class="header">
    
    <NuxtLink v-if="!isHomePage" :to="localePath('/')" clickable :prefetch="false" class="logo">
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
        class="logo"
      >
      </nuxt-img>
    </NuxtLink>
    <span v-else class="logo">
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
        class="logo"
      >
      </nuxt-img>
    </span>

    <lazy-the-header-menu v-if="$device.isDesktop"></lazy-the-header-menu>

    <div class="phone">
      <a href="tel:+420722133136">+420&nbsp;722&nbsp;133&nbsp;136</a>
    </div>

    <div class="btns-set">
        <!-- SEARCH BUTTON -->
        <div class="search-btn">
          <button @click="toggleModalSearchHandler" clickable class="header__search__button" type="button" aria-label="Search">
            <img src="~assets/svg-icons/search.svg" class="icon" alt="search-icon"  />
          </button>
        </div>

        <!-- LANGUAGE BUTTON -->
        <div class="lang-btn">
          <transition name="fade-in">
            <modal-lang-switcher
              v-show="isLanguagesActive"
              @select="languageSelectHandler"
              class="lang-popup"
            >
            </modal-lang-switcher>
          </transition>
	        
	        <button @click="toggleModalLanguagesHandler" clickable type="button" aria-label="Change Language">
            <img src="~assets/svg-icons/globe.svg" class="icon" alt="globe-icon" />
          </button>
        </div>

        <!-- PROFILE BUTTON -->
        <div class="profile-btn">
            <button v-if="!isAuth" @click="openModalSignInSocialHandler" clickable type="button" aria-label="To Account">
              <img src="~assets/svg-icons/user.svg" class="icon" alt="user-icon"/>
            </button>

            <NuxtLink v-else-if="isAuth && user" :to="localePath('/account/order-history')" clickable >
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
          <button @click="openModalCartHandler" clickable type="button" aria-label="cart">
            <img src="~assets/svg-icons/cart.svg" class="icon" alt="cart-icon" />
          </button>
          <span class="decor-cart" v-if="cartLength"></span>
        </div>

        <!-- MOBULE MENU BUTTON -->
        <button @click="toggleModalBurgerHandler" :class="{active: isBurgerActive}" clickable class="burger-btn" type="button" aria-label="menu">
          <span class="decor"></span>
        </button>

        <transition name="move-x-right">
          <modal-menu-mobile
            v-if="isBurgerActive"
            @close="closeModalMobileMenuHandler"
          ></modal-menu-mobile>
        </transition>
    </div>
  </header>

  <transition name="fade-in">
    <modal-livesearch v-if="isModalLivesearchActive"></modal-livesearch>
  </transition>

</template>