<script>
import { useCartStore } from '~/store/cart';

export default {
  setup() {
    const cartStore = useCartStore()

    return {
      cartStore,
    }
  },

  computed: {
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
    async deleteHandler(product) {
      const {setNoty} = useNoty()

      await this.cartStore.remove(product.id).then(() => {
        setNoty(this.$t('noty.product_remove_from_cart', {product: product.name}), 3000)

        if(!this.cartLength)
          this.cartStore.close()

      })
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
  <section class="popup-noty-cart">
      
    <div class="popup-noty-cart__header">
      <simple-more-btn :text="$t('button.Back')" @click="closeHandler" is-reverse></simple-more-btn>
      <p class="main-caption">{{ $t('title.cart') }}</p>
    </div>

    <template v-if="cartLength">
      
      <div class="popup-noty-cart__body">
        <ul class="popup-noty-cart__list">
          <checkout-product-tiny
            v-for="(product, key) in cart"
            :modification="product"
            :key="product.id"
            @delete="deleteHandler(product)"
          >
          </checkout-product-tiny>
        </ul>
      </div>

      <div class="popup-noty-cart__footer js-drop-item">
        <button class="popup-noty-cart__open-button js-drop-button"></button>
        <div class="total__wrapper">
          <div class="total__item total__item-general">
            <p class="type">{{ $t('label.subtotal') }}</p>
            <p class="description">usd {{ total }}</p>
          </div>
        </div>
        
        <NuxtLink :to="localePath('/checkout')" @click="closeHandler" class="main-button primary btn">
          <span class="text">{{ $t('button.checkout') }}</span>
        </NuxtLink>
        
        <NuxtLink :to="localePath('/shop')" @click="closeHandler" class="main-button btn">
          <span class="text">{{ $t('button.edit') }}</span>
        </NuxtLink>

      </div>
    </template>

    <p class="popup-noty__empty" v-else>{{ $t('messages.cart_is_empty') }}</p>
  </section>
</template>