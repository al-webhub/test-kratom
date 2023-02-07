<script>
import { useAuthStore } from '~/store/auth';

export default {
  setup() {
    const { t } = useI18n({useScope: 'local'})
    const authStore = useAuthStore()

    return {t, authStore}
  },

  data() {
    return {
      bonusesUsed: 0,
      hintIsOpen: false
    }
  },

  props: {
    cart: {
      type: Array,
      required: true
    },

    user: {
      type: Object
    },
    
    profile: {
      type: Object
    }
  },

  computed: {
    bonusesLeft() {
      return this.balance - this.bonusesUsed
    },

    balance() {
      return this.profile?.balance?.balance || 0
    },

    total() {
      return this.cart.reduce(
        (carry, item) => carry + item.price * item.amount, 
        0
      ).toFixed(2)
    },

    cartLength(){
      return Object.keys(this.cart).length
    },

    maxBonusesUsed() {
      return this.balance
    },

    isAuth() {
      return this.authStore.isAuth
    },
  },

  methods: {
    updateBonusHandler(value) {
      if(this.total - value) 
        this.bonusesUsed = value
       
      this.$emit('update:bonus', this.bonusesUsed)  
    },

    deleteHandler(product) {
      this.$emit('delete', product)
    },

    bonusesUsedChange(dir){

    },

    openHintHandler() {
      this.hintIsOpen = !this.hintIsOpen
    }
  }
}
</script>

<style src="./cart.scss" lang="less" scoped />

<template>
  <div class="cart-wrapper">

      <div class="order__info">
        <p class="main-caption-l">{{ $t('title.cart') }}</p>
        
        <div class="order__info__header">
          <p class="order__info__name order-position-item">{{ t('item') }}</p>
          <p class="order__info__name order-position-price">{{ t('price') }}</p>
          <p class="order__info__name order-position-quantity">{{ t('quantity') }}</p>
          <p class="order__info__name order-position-subtotal">{{ t('subtotal') }}</p>
          <p class="order__info__name order-position-last"></p>
        </div>

        <ul class="list">
          <checkout-product-full
            v-for="(product, index) in cart"
            :key="product.id"
            :modification="product"
            @delete="deleteHandler(product)"
          >
          </checkout-product-full>
          <li v-if="!cartLength" style="margin-top: 30px;">{{ $t('messages.cart_is_empty') }}</li>
        </ul>

      </div>

      <div class="order__info-bar">
        <div class="order__info-bar__wrapper">
          <p class="caption">{{ $t('title.your_order') }}</p>
          <div class="total__wrapper">
              
            <div class="total__item">
              <p class="type">{{ t('order_price') }}</p>
              <p class="description">usd {{ total }}</p>
            </div>

            <div v-if="isAuth && maxBonusesUsed >= 1" class="bonuses__container">
              <div class="bonuses__wrapper">
                <p v-html="t('how_much')"></p>
              </div>

              <div class="bonuses__wrapper">
                <p class="sub-text">{{ t('your_bonus_balance') }}: <span>USD {{ bonusesLeft.toFixed(2) }}</span></p>
                <form-amount @update:modelValue="updateBonusHandler" :model-value="bonusesUsed" :min="0" :max="maxBonusesUsed"></form-amount>
              </div>
            </div>

            <div :class="{active: hintIsOpen, extra: !isAuth}" class="total-info">
                <p class="total-info__caption">+{{ t('delivery_cost') }}</p>
                <button @click="openHintHandler" type="button" class="info-button"></button>
                <div class="info-drop"><p>{{ $t('delivery.The_Dispatch_takes') }}</p></div>
            </div>

            <div class="total__item total__item-general">
                <p class="type">{{ $t('label.subtotal') }}</p>
                <p class="description">usd {{ total - bonusesUsed }}</p>
            </div>

          </div>
        </div>

        <p class="order__info-bar__text">
          <a href="/contacts">{{ t('Сontact_us') }}</a>&nbsp;
          <span>{{ t('have_questions') }}</span>
        </p>
      </div>
      
  </div>
</template>

<i18n>
  {
    "en": {
      "item" : "item",
      "price" : "price",
      "quantity" : "quantity",
      "order_price" : "order price",
      "your_bonus_balance" : "your bonus balance",
      "delivery_cost" : "delivery cost",
      "Сontact_us" : "Сontact us",
      "have_questions" : "if you have questions",
      "how_much" : "how much do you <br> want to use?",
    },
    "ru": {
      "item" : "товар",
      "price" : "цена",
      "quantity" : "количество",
      "order_price" : "стоимость заказа",
      "your_bonus_balance" : "Ваш бонусный баланс",
      "delivery_cost" : "стоимость доставки",
      "Сontact_us" : "Сообщите нам",
      "have_questions" : "Если у вас есть вопросы",
      "how_much" : "Сколько вы хотите <br> использовать?",
    }
  }
</i18n>