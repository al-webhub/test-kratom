<script>
export default {
  data() {
    return {
      total: 567.44,
      bonusesLeft: 15,
      bonusesUsed: 10,
    }
  },

  props: {
    cart: {
      type: Array,
      required: true
    },
    user: {
      type: Object
    }
  },

  computed: {
    cartLength(){
      return Object.keys(this.cart).length
    },

    maxBonusesUsed() {
      return 100
    }
  },

  methods: {
    bonusesUsedChange(dir){

    },
  }
}
</script>

<style src="./cart.scss" lang="less" scoped />

<template>
  <div class="order__wrapper">

      <div class="order__info">
        <p class="main-caption-l">{{ $t('text.your_order') }}</p>
        
        <div class="order__info__header">
          <p class="order__info__name order-position-item">{{ $t('text.item') }}</p>
          <p class="order__info__name order-position-price">{{ $t('text.price') }}</p>
          <p class="order__info__name order-position-quantity">{{ $t('text.quantity') }}</p>
          <p class="order__info__name order-position-subtotal">{{ $t('text.subtotal') }}</p>
          <p class="order__info__name order-position-last"></p>
        </div>

        <ul class="order__info__list">
          <template v-for="(product, index) in cart" :key="index">
            <template v-for="modification in product" :key="modification.id">
              <checkout-product-full :modification="modification"></checkout-product-full>
            </template>
          </template>
          <li v-if="!cartLength" style="margin-top: 30px;">{{ $t('text.cart_is_empty') }}</li>
        </ul>
      </div>

      <div class="order__info-bar">
        <div class="order__info-bar__wrapper">
          <p class="caption">{{ $t('text.your_order') }}</p>
          <div class="total__wrapper">
              
            <div class="total__item">
              <p class="type">{{ $t('text.order_price') }}</p>
              <p class="description">usd {{ total }}</p>
            </div>

            <div v-if="user" class="bonuses__container">
              <div class="bonuses__wrapper">
                <p>how much do you <br> want to use?</p>
              </div>

              <div class="bonuses__wrapper">
                <p class="sub-text">{{ $t('text.your_bonus_balance') }}: <span>USD {{ bonusesLeft }}</span></p>
                
                <form-amount v-model="bonusesUsed" :max="maxBonusesUsed"></form-amount>

              </div>
            </div>

            <div class="total-info js-drop-item">
                <p class="total-info__caption">+{{ $t('text.delivery_cost') }}</p>
                <button type="button" class="info-button js-drop-button"></button>
                <div class="info-drop"><p>{{ $t('text.The_Dispatch_takes') }}</p></div>
            </div>

            <div class="total__item total__item-general">
                <p class="type">{{ $t('text.subtotal') }}</p>
                <p class="description">usd {{ total - bonusesUsed }}</p>
            </div>

          </div>
        </div>

        <p class="order__info-bar__text">
          <a href="/contacts">{{ $t('text.Сontact_us') }}</a> 
          <span>{{ $t('text.have_questions') }}</span>
        </p>
      </div>
      
      <button
        v-if="cartLength"
        class="main-button-color main-button-color-mobile"
      >
        <span class="text">{{ $t('text.checkout') }}</span>
      </button>

  </div>
</template>