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
    }
  },

  // props: {
  //   cart: {
  //     type: Array
  //   }
  // },

  computed: {
    isActive() {
      return this.cartStore?.show
    },

    cart() {
      return this.cartStore?.cart
    },

    total() {
      return this.cart.reduce(
        (carry, item) => carry + item.price * item.amount, 
        0
      ).toFixed(2)
    },

    cartLength() {
      return Object.keys(this.cart).length
    }
  },

  methods: {
    deleteHandler(id) {
      this.cartStore.remove(id)
    },

    checkIfCartEmpty(event) {

    },

    closeHandler() {
      this.cartStore.close()
    }
  }
}
</script>

<style src="../../Popup/popup.scss" lang="less" scoped />
<style src="./cart.scss" lang="postcss" scoped />

<template>
  <section :class="{active: isActive}" class="popup popup-noty-cart">
      
    <div class="popup-noty-cart__header">
      <simple-more-btn :text="$t('text.Back')" @click="closeHandler" is-reverse></simple-more-btn>
      <p class="main-caption">{{ $t('text.cart') }}</p>
    </div>

    <template v-if="cartLength">
      
      <div class="popup-noty-cart__body">
        <ul class="popup-noty-cart__list">
          <checkout-product-tiny
            v-for="(product, key) in cart"
            :modification="product"
            :key="product.id"
            @delete="deleteHandler(product.id)"
          >
          </checkout-product-tiny>
        </ul>
      </div>

      <div class="popup-noty-cart__footer js-drop-item">
        <button class="popup-noty-cart__open-button js-drop-button"></button>
        <div class="total__wrapper">
          <div class="total__item total__item-general">
            <p class="type">{{ $t('text.subtotal') }}</p>
            <p class="description">usd {{ total }}</p>
          </div>
        </div>
        <NuxtLink :to="localePath('/checkout')" @click="checkIfCartEmpty($event)" class="main-button-color popup-noty-cart__button">
          <span class="text">{{ $t('text.checkout') }}</span>
        </NuxtLink>
        <NuxtLink :to="localePath('/shop')" class="main-button popup-noty-cart__button">
          <span class="text">{{ $t('text.edit') }}</span>
        </NuxtLink>
      </div>
    </template>

    <p class="popup-noty__empty" v-else>{{ $t('text.cart_is_empty') }}</p>
  </section>
</template>