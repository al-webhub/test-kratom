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
  <li class="wrapper">
    <div class="header">
      <NuxtLink :to="localePath('/' + modification.slug)" class="header__image">
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
      
      <div class="header__content">
        <NuxtLink :to="localePath('/' + modification.slug)" class="title">{{ modification.name }}</NuxtLink>
        
        <div class="mod">
          {{ modification.short_name }} g.
          
          <div class="mod__price">
            USD <b>{{ modification.price }}</b>
          </div>
        </div>
        
      </div>
    </div>

    <div class="price">
      USD <b>{{ modification.price }}</b>
    </div>

    <div class="quantity">
      <p class="mobile-caption">{{ t('quantity') }}:</p>
      <form-amount v-model="modification.amount"></form-amount>
    </div>

    <div class="total">
      <p class="mobile-caption">{{ t('subtotal') }}:</p>
      <div>USD <b>{{ modification.price * modification.amount }}</b></div>
    </div>

    <div class="delete">
      <button type="button" class="delete-btn" @click="deleteHandler" title="Remove">
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