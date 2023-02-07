<script>
import { useCartStore } from '~/store/cart';
import { useAuthStore } from '~/store/auth';
import { useProfileStore } from '~/store/profile';

export default {
  async setup() {
    const cartStore = useCartStore()
    const authStore = useAuthStore()
    const profileStore = useProfileStore()
    
    await useAsyncData('profile', () => profileStore.getProfile())

    return {
      cartStore,
      authStore,
      profileStore
    }
  },

  data() {
    return {
      isLoading: false
    }
  },

  computed: {
    profile() {
      return this.profileStore.profile
    },

    user() {
      return this.authStore.getUser
    },

    isAuth() {
      return this.authStore.isAuth
    },

    order() {
      return this.cartStore?.order
    },

    errors() {
      return this.cartStore?.errors
    },

    cart() {
      return this.cartStore?.cart
    },

    cartLength() {
      return Object.keys(this.cart).length
    },

    isUserSectionFilled() {
      return this.isAuth || this.order.user.firstname
        && this.order.user.lastname 
        && this.order.user.communication 
        && this.order.user.communication_number
    },

    isDeliverySectionFilled() {
      return this.order.address.country
        && this.order.address.city 
        && this.order.address.state 
        && this.order.address.street 
        && this.order.address.apartment
    }
  },

  methods: {

    setCrumbs() {
      useCrumbs().setCrumbs([
          {
            name: this.$t('crumbs.home'),
            link: '/'
          },{
            name: this.$t('crumbs.checkout'),
            link: '/checkout'
          }
      ])
    },

    bonusHandler(v) {
      console.log('bonusesUsed', v)
      this.order.bonusesUsed = v
    },

    async deleteHandler(product) {
      await this.cartStore.remove(product.id).then(() => {
        useNoty().setNoty(this.$t('noty.product_remove_from_cart', {product: product.name}))
      })
    },

    async confirmHandler() {
      this.isLoading = true
      
      const provider = this.isAuth? 'auth': 'data'

      if(this.isAuth)
        this.cartStore.setUser(this.user)

      await this.cartStore.createOrder(provider).then((res) => {
        if(res.data._value) {
          useNoty().setNoty(this.$t('noty.order_success', {code: res.data._value.code}), 10000)
          this.cartStore.clearCart()
          navigateTo('/')
        }

        if(res.error._value) {
          useNoty().setNoty(this.$t('noty.order_fail'), 5000)
        }

        this.isLoading = false
      })
    }
  },

  created() {
    this.setCrumbs()
  }
}
</script>

<style src="assets/scss/pages/checkout.scss" lang="sass" scoped />

<template>
<div>
  <section class="cart">
    <div class="cart__wrapper container">
      
      <!-- <div class="general-decor-figure"></div> -->
      <p class="main-caption main-caption-align">{{ $t('title.your_order') }}</p>

      <div class="checkout__wrapper">
        <p class="main-caption-l hide-mobile">{{ $t('title.cart') }}</p>
        <checkout-cart :cart="cart" :user="user" :profile="profile" @delete="deleteHandler" @update:bonus="bonusHandler"></checkout-cart>
      </div>
      
      <!-- CHECKOUT -->
      <div v-if="cartLength" class="checkout__wrapper checkout__wrapper-cart">
        <p class="main-caption-l">{{ $t('title.checkout') }}</p>
        <ul class="checkout__list">
          <checkout-user v-model:order="order" :errors="errors"></checkout-user>
          
          <checkout-delivery :is-active="isUserSectionFilled" v-model:order="order" :errors="errors"></checkout-delivery>
          
          <checkout-payment :is-active="isDeliverySectionFilled" :is-loading="isLoading" v-model:order="order" :errors="errors" @confirm="confirmHandler"></checkout-payment>
        </ul>
      </div>

    </div>
  </section>

  <section-write-us></section-write-us>
</div>
</template>