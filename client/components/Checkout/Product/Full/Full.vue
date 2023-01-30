<script>
export default {
  setup() {
    const {t} = useI18n({useScope: 'local'})
    return {t}
  },

  props: {
    modification: {
      type: Object,
      required: true
    }
  },

  computed: {
    photo() {
      if(this.modification?.image?.src)
        return '/server/' + this.modification?.image?.src
      else
        return null
    }
  },

  methods: {
    deleteHandler() {
      this.$emit('delete')
    }
  }
}
</script>

<style src="./full.scss" lang="sass" scoped />

<template>
  <li class="order__info__item">
      <div class="order__info__preview order-position-item">
        <NuxtLink :to="localePath('/' + modification.slug)" class="order__info__preview__img">
          <nuxt-img
            v-if="photo"
            :src="photo"
            :alt="modification.image?.alt"
            :title="modification.image?.title"
            :class="modification.image?.size"
            sizes = "mobile:128px desktop:128px"
            format = "webp"
            quality = "40"
            loading = "lazy"
            class="image"
          >
          </nuxt-img>
        </NuxtLink>

        <div class="order__info__preview__descrip">
          <p class="order__info__preview__name">
            <NuxtLink :to="localePath('/' + modification.slug)">{{ modification.name }}</NuxtLink>
          </p>
          <ul class="product__weight-list">
            <li class="product__weight-item">{{ modification.short_name }}</li>
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
          <li class="product__weight-item">{{ modification.short_name }}</li>
        </ul>
      </div>

      <div class="order__info__quantity order-position-quantity">
        <p class="order-caption">{{ t('quantity') }}:</p>
        <form-amount v-model="modification.amount"></form-amount>
      </div>

      <div class="order__info__price order__info__price-subtotal order-position-subtotal">
        <p class="order-caption">{{ t('subtotal') }}:</p>
        <p>USD <span>{{ modification.price * modification.amount }}</span></p>
      </div>

      <div class="order-position-last order__delete">
        <button type="button" class="delete-button" @click="deleteHandler" title="Remove">
          <img src="~assets/svg-icons/delete.svg" class="icon" />
        </button>
      </div>

  </li>
</template>
<i18n>
  {
    en: {
      quantity: "Quantity",
      subtotal: "Subtotal"
    },
    ru: {
      quantity: "Количество",
      subtotal: "Сумма"
    }
  }
</i18n>