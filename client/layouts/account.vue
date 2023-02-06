<script>
import listIcon from 'assets/svg-icons/list.svg';
import homeIcon from 'assets/svg-icons/home.svg';
import gearIcon from 'assets/svg-icons/gear.svg';
import walletIcon from 'assets/svg-icons/wallet.svg';

import { useAuthStore } from '~/store/auth';
import { useProfileStore } from '~/store/profile';
import { useTransactionStore } from '~/store/transaction'
import { useCartStore } from '~/store/cart'

export default {
  setup() {
    const { t } = useI18n({useScope: 'local'})
    const authStore = useAuthStore()
    const profileStore = useProfileStore()

    const isPopupAuthChangePasswordActive = computed(() => {
      return useAuthStore().showChangePassword
    })

    const isModalCartActive = computed(() => {
      return useCartStore().show
    })

    const isPopupAuthLogOutActive = computed(() => {
      return useAuthStore().showLogOut
    })

    const isPopupWithdrawalShow = computed(() => {
      return useTransactionStore().withdrawal.isShow
    })

    return {
      authStore,
      profileStore,
      isPopupWithdrawalShow,
      isPopupAuthLogOutActive,
      isModalCartActive,
      isPopupAuthChangePasswordActive,
      t
    }
  },

  data() {
    return {}
  },

  computed: {

    title() {
      return useAccount().title.value
    },

    profile() {
      return this.profileStore.profile  
    },

    balance() {
      return this.profile.balance?.balance
    },

    user() {
      return this.authStore.getUser
    },

    isAuth() {
      return this.authStore.isAuth
    },

    menu() {
      return [
        {
          uid: 1,
          title:  this.$t('title.order_history'),
          url: '/account/order-history',
          icon: listIcon
        },{
          uid: 2,
          title:  this.$t('title.addresses'),
          url: '/account/addresses',
          icon: homeIcon
        },{
          uid: 3,
          title:  this.$t('title.account_settings'),
          url: '/account/edit-account',
          icon: gearIcon
        },{
          uid: 4,
          title:  this.$t('title.referral_network'),
          url: '/account/referral-network',
          icon: walletIcon
        }
      ]
    },
  },

  methods: {
    async logoutHandler() {
      this.authStore.open('logOut')
    }
  }
}
</script>

<style src="assets/scss/pages/account/common.scss" lang="sass" scoped />

<template>
  <div>
    <the-header></the-header>

    <the-breadcrumbs></the-breadcrumbs>
    
    <modal-noty></modal-noty>

    <main>
      <section class="profile">
        <div class="profile__wrapper container">
          <!-- <div class="general-decor-figure"></div> -->

          <div class="profile__header-wrapper">

            <div class="profile__header-wrapper__container">
              <h2 class="main-caption main-caption-align">
                {{ t('hello') }}, <span>{{ user.fullname }}</span>
              </h2>
              
              <p v-if="balance" class="profile__header__bonus">
                {{ t('your_bonus_balance') }}: <span>USD {{ balance }}</span>
              </p>
            </div>

            <div class="profile__main-info">
              <img v-if="user.photo" :src="user.photo" class="profile__img"/>
              <!-- <nuxt-img
                v-if="user.photo"
                :src="'/server/'+user.photo"
                sizes = "mobile:50px"
                format = "webp"
                quality = "80"
                loading = "lazy"
                class="profile__img"
              ></nuxt-img> -->
              <div v-else class="profile__img">
                <img src="~assets/images/photo-log-in.png" />
              </div>
              <p class="profile__email">{{ user.email }}</p>
            </div>

          </div>

          <div class="profile__container">
              
            <!-- SIDEBAR -->
            <ul class="sidebar">
                <li
                  v-for="item in menu"
                  :key="item.uid"
                  class="profile__sidebar-item"
                >
                  <NuxtLink :to="localePath(item.url)" class="profile__sidebar-link">
                    <img :src="item.icon" class="icon" />
                    <span class="text">{{ item.title }}</span>
                  </NuxtLink>
                </li>

                <li class="profile__sidebar-item">
                  <button @click="logoutHandler" class="profile__sidebar-link">
                    <img src="~assets/svg-icons/logout.svg" class="icon" />
                    <span class="text">{{ $t('title.logout') }}</span>
                  </button>
                </li>
            </ul>
            
            <!-- CONTENT -->
            <div class="profile__info">
              <p class="profile__info__caption">{{ title }}</p>
              <slot />
            </div>

          </div>
        </div>
      </section>
    </main>

    <section-write-us></section-write-us>

    <the-footer></the-footer>

    <!-- MODAL / shoping cart -->
    <transition name="move-x-right">
      <lazy-modal-cart v-if="isModalCartActive"></lazy-modal-cart>
    </transition>

    <!-- POPUP / log out -->
    <transition name="fade-in">
      <lazy-popup-auth-log-out v-if="isPopupAuthLogOutActive"></lazy-popup-auth-log-out>
    </transition>

    <!-- POPUP / change password -->
    <transition name="fade-in">
      <popup-auth-change-password v-if="isPopupAuthChangePasswordActive"></popup-auth-change-password>
    </transition>

    <!-- POPUP / withdrawal -->
    <transition name="fade-in">
      <popup-withdrawal v-if="isPopupWithdrawalShow"></popup-withdrawal>
    </transition>

  </div>
</template>

<i18n>
  {
    "en": {
      "hello" : "hello",
      "your_bonus_balance" : "your bonus balance",
    },
    "ru": {
      "hello" : "Здравствуйте",
      "your_bonus_balance" : "Ваш бонусный баланс",
    }
  }
</i18n>