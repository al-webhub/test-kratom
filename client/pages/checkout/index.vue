<script>
import { useCartStore } from '~/store/cart';

export default {
  setup() {
    const cartStore = useCartStore()

    return {
      cartStore,
    }
  },

  data() {
    return {
      user: {
        name: 'Hi'
      }
    }
  },

  computed: {
    order() {
      console.log('ORDER', this.cartStore?.order)
      return this.cartStore?.order
    },

    cart() {
      return this.cartStore?.cart
    },

    cartLength() {
      return Object.keys(this.cart).length
    },

    isUserSectionFilled() {
      return this.order.user.firstname
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
    deleteHandler(id) {
      this.cartStore.remove(id)
    },

    async confirmHandler() {
      await this.cartStore.createOrder()
    }
  }
}
</script>

<style src="assets/scss/pages/checkout.scss" lang="sass" scoped />

<template>
<div>
  <section class="cart">
    <div class="cart__wrapper container">
      
      <!-- <div class="general-decor-figure"></div> -->
      <p class="main-caption main-caption-align">{{ $t('text.cart') }}</p>
      <p class="main-caption-l">{{ $t('text.your_order') }}</p>
      
      <checkout-cart :cart="cart" :user="user" @delete="deleteHandler"></checkout-cart>
      
      <!-- CHECKOUT -->
      <div v-if="cartLength" class="checkout__wrapper checkout__wrapper-cart">
        <p class="main-caption-l">{{ $t('text.checkout') }}</p>
        <ul class="checkout__list">
          <checkout-user v-model:order="order"></checkout-user>
          
          <checkout-delivery :is-active="isUserSectionFilled" v-model:order="order"></checkout-delivery>
          
          <checkout-payment :is-active="isDeliverySectionFilled" v-model:order="order" @confirm="confirmHandler"></checkout-payment>
        </ul>
      </div>

    </div>
  </section>

  <section-write-us></section-write-us>
</div>
</template>