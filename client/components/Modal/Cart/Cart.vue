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
      total: 453.43,
      cart: [
        [
          {
            id: 1,
            name: '500 gr',
            product_link: '/',
            product_image: null,
            product_name: 'Kratom Maeng',
            price: 12.00,
            amount: 2,
          }
        ],
        [
          {
            id: 1,
            name: '500 gr',
            product_link: '/',
            product_image: null,
            product_name: 'Kratom Maeng',
            price: 12.00,
            amount: 2,
          }
        ]
      ]
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

    cartLength() {
      return Object.keys(this.cart).length
    }
  },

  methods: {
    deleteFromCart(arg1, arg2) {

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
          <template v-for="(product, key) in cart">
            <template v-for="modification in product" :key="modification.id">
              <checkout-product-tiny :modification="modification"></checkout-product-tiny>
            </template>
          </template>
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
        <a href="checkout" @click="checkIfCartEmpty($event)" class="main-button-color popup-noty-cart__button">
          <span class="text">{{ $t('text.checkout') }}</span>
        </a>
        <a href="shop" class="main-button popup-noty-cart__button">
          <span class="text">{{ $t('text.edit') }}</span>
        </a>
      </div>
    </template>

    <p class="popup-noty__empty" v-else>{{ $t('text.cart_is_empty') }}</p>
  </section>
</template>