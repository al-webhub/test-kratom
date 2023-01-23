<script>
import { useCartStore } from '~/store/cart';
export default {
  setup() {
    const { t } = useI18n({useScope: 'local'})
    const cartStore = useCartStore()

    return {
      cartStore,
      t
    }
  },

  data() {
    return {
      selectedModification: {},
      image: null,
      isInfoOpen: false
    }
  }, 

  props: {
    product: {
      type: Object,
      required: true
    }
  },

  computed: {
    photo() {
      if(this.product.image?.src)
        return '/server/' + this.product.image.src
      else
        return null
    },

    stimulation() {
      const attr = this.product.attrs.find(item => item.slug === 'stimulation')
      return attr && attr.value && this.toHumanValue(attr.value) || null
    },

    relaxation() {
      const attr = this.product.attrs.find(item => item.slug === 'relaxation')
      return attr && attr.value && this.toHumanValue(attr.value) || null
    },

    euphoria() {
      const attr = this.product.attrs.find(item => item.slug === 'euphoria')
      return attr && attr.value && this.toHumanValue(attr.value) || null
    },

    rating() {
      return Math.round(this.product.rating)
    }
  },

  methods: {
    toHumanValue(x) {
      return Math.floor(x / 20 * 2) / 2;
    },

    changeModification: function(modification) {
      this.selectedModification = Object.assign({}, modification);
    },

    closeInfoHandler() {
      this.isInfoOpen = false
    },

    openInfoHandler() {
      this.isInfoOpen = true
    },

    async toCartHandler() {
      await this.cartStore.add(this.selectedModification).then(() => {
        useNoty().setNoty(this.$t('noty.product_to_cart', {product: this.selectedModification.name}), 3000)
      })
    },
  },


  watch: {
    dataItem: {
      handler: function(value){
        this.product = value;
      },
      deep: true
    },
    product: {
      handler: function(value){
        this.selectedModification = Object.assign({}, value.modifications[0]);
      },
      deep: true
    }
  },

  created: function(){
    this.selectedModification = Object.assign({}, this.product.modifications[0]);
  },
}
</script>

<style src="./card.scss" lang="sass" scoped />

<template>
  <div class="box" :class="{active: isInfoOpen}">
      
      <!-- PRODUCT INFO -->
      <div class="info">
        <button @click="closeInfoHandler" class="info--close-btn">
          <img src="~assets/svg-icons/close.svg" class="icon" />
        </button>
        <div class="wrapper" v-html="product.excerpt"></div>
      </div>

      <!-- PRODUCT IMAGE -->
      <NuxtLink :to="localePath('/' + product.slug)" class="image">
        <nuxt-img
          v-if="photo"
          :src = "photo"
          :alt = "product.image.alt"
          :title = "product.image.title"
          :class="product.image.size"
          sizes = "mobile:100vw tablet:230px desktop:240px"
          format = "webp"
          quality = "40"
          loading = "lazy"
        >
        </nuxt-img> 
      </NuxtLink>

      <!-- PRODUCT NAME -->
      <NuxtLink :to="localePath('/' + product.slug)" class="link">{{ product.name }}</NuxtLink>
      
      <div class="rating">
        <img v-for="i in 5" :key="i" src="~assets/svg-icons/star.svg" :class="{active: i <= rating}" class="icon" />
      </div>

      <!-- PRODUCT SHOW INFO BUTTON -->
      <button @click="openInfoHandler" class="info-btn">
        <span class="text">{{ t('info') }}</span>
        <img src="~assets/svg-icons/arrow-45deg.svg" class="icon" />
      </button>

      <!-- PRODUCT PROPERTIES -->
      <ul
        class="qualities"
      >
          <li v-if="stimulation !== null" class="quality">
              <p class="name">{{ $t('label.stimulation') }}</p>
              <simple-five-dots v-model="stimulation" size="small" is-static></simple-five-dots>
          </li>
          <li v-if="relaxation !== null" class="quality">
              <p class="name">{{ $t('label.relaxation') }}</p>
              <simple-five-dots :model-value="relaxation" size="small" is-static></simple-five-dots>
          </li>
          <li v-if="euphoria !== null" class="quality">
              <p class="name">{{ $t('label.euphoria') }}</p>
              <simple-five-dots :model-value="euphoria" size="small" is-static></simple-five-dots>
          </li>
      </ul>

      <!-- PRODUCT MODIFICATIONS -->
      <div class="weight">
        <product-variants-list v-model="selectedModification" :values="product.modifications"></product-variants-list>
      </div>

      <!-- PRODUCT FOOTER -->
      <div class="footer">
        <p class="price">USD <span>{{ selectedModification.price }}</span></p>
        <button @click="toCartHandler" class="main-button primary small">
            <span class="text">{{ $t('button.add_to_cart') }}</span>
        </button>
      </div>

  </div>
</template>

<i18n>
  {
    "en": {
      "info" : "Info",
    },
    "ru": {
      "info" : "Подробнее",
    }
  }
</i18n>