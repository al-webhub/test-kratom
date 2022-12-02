<script>
import listIcon from 'assets/svg-icons/list.svg';
import homeIcon from 'assets/svg-icons/home.svg';
import gearIcon from 'assets/svg-icons/gear.svg';
import walletIcon from 'assets/svg-icons/wallet.svg';

export default {
  data() {
    return {
      user: {
        usermeta: {
          firstname: 'Andrej Koval',
          photo: null,
          email: 'para@gmail.com'
        }
      },
      balance: 10.15,
    }
  },

  computed: {
    menu() {
      return [
        {
          uid: 1,
          title:  this.$t('text.order_history'),
          url: '/account/order-history',
          icon: listIcon
        },{
          uid: 2,
          title:  this.$t('text.addresess'),
          url: '/account/addresess',
          icon: homeIcon
        },{
          uid: 3,
          title:  this.$t('text.account_settings'),
          url: '/account/edit-account',
          icon: gearIcon
        },{
          uid: 4,
          title:  this.$t('text.referral_network'),
          url: '/account/referral-network',
          icon: walletIcon
        }
      ]
    }
  }
}
</script>

<style src="assets/scss/pages/account/common.scss" lang="sass" scoped />

<template>
  <div>
    <the-header></the-header>

    <the-breadcrumbs></the-breadcrumbs>

    <main>
      <section class="profile">
        <div class="profile__wrapper container">
          <!-- <div class="general-decor-figure"></div> -->

          <div class="profile__header-wrapper">
            <div class="profile__header-wrapper__container">
              <h2 class="main-caption main-caption-align">
                {{ $t('text.hello') }}, <span>{{ user.usermeta.firstname }}</span>
              </h2>
              
              <p v-if="balance" class="profile__header__bonus">
                {{ $t('text.your_bonus_balance') }}: <span>USD {{ balance }}</span>
              </p>
            </div>
            <div class="profile__main-info">
              <div :style="{backgroundImage: user.usermeta.photo}" class="profile__img"></div>
              <p class="profile__email">{{ user.email }}</p>
            </div>
          </div>

          <div class="profile__container">
              
            <ul class="profile__sidebar-list">
                <li
                  v-for="item in menu"
                  :key="item.uid"
                  class="profile__sidebar-item"
                >
                  <a :href="item.url" class="profile__sidebar-link">
                    <img :src="item.icon" class="icon" />
                    <span class="text">{{ item.title }}</span>
                  </a>
                </li>
                <li class="profile__sidebar-item">
                  <button class="profile__sidebar-link">
                    <img src="~assets/svg-icons/logout.svg" class="icon" />
                    <span class="text">{{ $t('text.logout') }}</span>
                  </button>
                </li>
            </ul>
            
            <div class="profile__info">
              <p class="profile__info__caption">{{ $t('text.Shipping_address') }}</p>
              
              <slot />
            </div>
          </div>
        </div>
      </section>
    </main>

    <the-footer></the-footer>

    <popup-auth-log-out></popup-auth-log-out>

  </div>
</template>