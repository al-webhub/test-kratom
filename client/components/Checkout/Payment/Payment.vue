<script>
export default {
  data() {
    return {
      privatePolicy: 0,
      canConfirm: false,
      selectedPayment: null,
      payments: [
        {
          id: 1,
          name: 'Mastercard',
          image: null
        },{
          id: 2,
          name: 'Kiwi',
          image: null
        },{
          id: 3,
          name: 'Crypto',
          image: null
        }
      ]
    }
  },

  props: {
    isActive: {
      type: Boolean,
      default: false
    },
    bonuses: {
      type: Number,
      default: 10
    }
  }
}
</script>

<style src="./../checkout.scss" lang="sass" scoped />
<style src="./payment.scss" lang="sass" scoped />

<template>
  <li :class="{active:isActive}" class="checkout__item">
      
    <div class="checkout__item__header">
      <p class="calc">3/3</p>
      <p class="caption">{{ $t('text.payment') }}</p>
    </div>

    <div class="checkout__item__body">
      <ul class="delivery__list delivery__list-payment delivery__list-payment-checkout">
        <li
          v-for="method in payments"
          :key="method.id"
          class="delivery__item"
        >
          <label class="input__wrapper input__wrapper-radio">
            <input v-model="selectedPayment" type="radio" class="input-radio" name="payment">
            <span class="custome-radio"></span>
            <div :style="{backgroundImage: 'url(' + method.image + ')'}" class="delivery__item__img"></div>
            <p class="text">{{ method.name }}</p>
          </label>
        </li>

        <li @click="selectedPayment = 'another'" class="delivery__item">
          <label class="input__wrapper input__wrapper-radio">
            <input type="radio" class="input-radio" name="delivery-pay">
            <span class="custome-radio"></span>
            <p class="text">{{ $t('text.Another_Payment_Method') }}</p>
          </label>
        </li>
      </ul>

      <template v-if="bonuses">
        <div class="check-bonuse">
          <p class="type">{{ $t('text.Bonuses_used') }}</p>
          <p class="description">USD {{ bonuses }}</p>
        </div>
        <button class="check-bonuse__button js-button" data-target="bonuses">{{ $t('text.change_bonus_amount') }}</button>
      </template>
    </div>

    <div class="checkout__item__footer">
      <div class="checkout__item__policy">
        <label class="input__wrapper input__wrapper-checkbox">
          
          <input type="checkbox" class="input-checkbox" v-model="privatePolicy" required>

          <span class="custome-checkbox">
            <span class="icon-active"></span>
          </span>

          <p class="privat-policy-text">
            {{ $t('text.I_agreed_with') }} 
            <a href="/privacy">{{ $t('text.Privacy_Policy') }}</a>
          </p>

        </label>
      </div>
      
      <button class="main-button-color" :class="{disabled:!canConfirm}">
        <span class="text">{{ $t('text.confirm_order') }}</span>
      </button>

    </div>

  </li>
</template>