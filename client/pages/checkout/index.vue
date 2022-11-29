<script>
export default {
  data() {
    return {
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
      ],
      user: {
        name: 'Hi'
      }
    }
  },

  computed: {
    cartLength() {
      return Object.keys(this.cart).length
    }
  }
}
</script>

<style src="assets/scss/pages/checkout.scss" lang="sass" scoped />

<template>
  <section class="cart">
    <div class="cart__wrapper container">
      
      <!-- <div class="general-decor-figure"></div> -->
      <p class="main-caption main-caption-align">{{ $t('text.cart') }}</p>
      <p class="main-caption-l">{{ $t('text.your_order') }}</p>
      
      <checkout-cart :cart="cart" :user="user"></checkout-cart>
      
      <!-- CHECKOUT -->
      <div v-if="cartLength" class="checkout__wrapper checkout__wrapper-cart">
        <p class="main-caption-l">{{ $t('text.checkout') }}</p>
        <ul class="checkout__list">
          <checkout-user></checkout-user>
          
          <checkout-delivery></checkout-delivery>
          
          <checkout-payment></checkout-payment>
        </ul>
      </div>

    </div>
  </section>

  <section-write-us></section-write-us>
</template>