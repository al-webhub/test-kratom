<script>
export default {
  props: {
    modification: {
      type: Object,
      required: true
    }
  },

  methods: {
    deleteFromCart(arg1, arg2){

    }
  }
}
</script>

<style src="./full.scss" lang="sass" scoped />

<template>
  <li class="order__info__item">
      <div class="order__info__preview order-position-item">
        <div class="order__info__preview__img">
          <a :href="modification.product_link">
            <img 
              :src="modification.product_image"
              :alt="modification.product_name"
              :title="modification.product_name"
            />
          </a>
        </div>

        <div class="order__info__preview__descrip">
          <p class="order__info__preview__name">
            <a :href="modification.product_link">{{ modification.product_name }}</a>
          </p>
          <ul class="product__weight-list">
            <li class="product__weight-item">{{ modification.name }}</li>
          </ul>
          <div class="order-tablet-version">
            <div class="order__info__price">
              <p>USD <span>{{ modification.price }}</span></p>
            </div>
            <div class="order__info__quantity">
              <p class="order-caption">{{ $t('text.quantity') }}:</p>
              <div class="product__calc">
                <button type="button" class="calc_button" @click="modification.amount > 1 ? modification.amount-- : false">
                  <span class="text">-</span>
                </button>
                <input type="text" class="calc-input" v-model="modification.amount">
                <button type="button" class="calc_button" @click="modification.amount++">
                  <span class="text">+</span>
                </button>
              </div>
            </div>
          </div>
        </div>

      </div>
      
      <div class="order__info__price order-position-price">
        <p>USD <span>{{ modification.price }}</span></p>
      </div>

      <div class="order__mobile-weight">
        <ul class="product__weight-list">
          <li class="product__weight-item">{{ modification.name }}</li>
        </ul>
      </div>

      <div class="order__info__quantity order-position-quantity">
        <p class="order-caption">{{ $t('text.quantity') }}:</p>
        <form-amount v-model="modification.amount"></form-amount>
      </div>

      <div class="order__info__price order__info__price-subtotal order-position-subtotal">
        <p class="order-caption">{{ $t('text.subtotal') }}:</p>
        <p>USD <span>{{ modification.price * modification.amount }}</span></p>
      </div>

      <div class="order-position-last order__delete">
        <button type="button" class="delete-button" @click="deleteFromCart(key, modification.id)" title="Remove">
          <img src="~assets/svg-icons/delete.svg" class="icon" />
        </button>
      </div>

  </li>
</template>