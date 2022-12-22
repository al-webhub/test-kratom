<script>
import { useCartStore } from '~/store/cart';
export default {
  setup() {
    const cartStore = useCartStore()

    return {
      cartStore
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

  methods: {
    changeModification: function(modification) {
      this.selectedModification = Object.assign({}, modification);
    },

    closeInfoHandler() {
      this.isInfoOpen = false
    },

    openInfoHandler() {
      this.isInfoOpen = true
    },

    toCartHandler(arg1, arg2) {
      this.cartStore.add(this.selectedModification)
    },

    emitHeightHandler() {
      if (process.client){
        if(window.innerWidth >= 1024)
          this.$emit('height', '451px')
        else
          this.$emit('height', 'auto')
      }else{
        if(this.$device.isDesktop)
          this.$emit('height', '451px')
        else
          this.$emit('height', 'auto')        
      }
    }
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

    this.emitHeightHandler()

    if (process.client){
      window.addEventListener("resize", this.emitHeightHandler);
    }
  },

  destroyed: function() {
    if (process.client){
      window.removeEventListener("resize", this.emitHeightHandler);
    }
  },
}
</script>

<style src="./card.scss" lang="sass" scoped />

<template>
  <div class="box" :class="{active: isInfoOpen}">
      
      <!-- PRODUCT INFO -->
      <div class="info">
        <button @click="closeInfoHandler" class="info--close-btn">+</button>
        <div class="wrapper" v-html="product.excerpt"></div>
      </div>

      <!-- PRODUCT IMAGE -->
      <NuxtLink :to="localePath('/' + product.slug)" class="image">
        <nuxt-picture
          :src = "product.image.src"
          :alt = "product.image.alt"
          :title = "product.image.title"
          sizes = "mobile:100vw tablet:230px desktop:240px"
          format = "webp"
          quality = "80"
          loading = "lazy"
        >
        </nuxt-picture> 
      </NuxtLink>

      <!-- PRODUCT NAME -->
      <NuxtLink :to="localePath('/' + product.slug)" class="link">{{ product.name }}</NuxtLink>
      
      <!-- PRODUCT SHOW INFO BUTTON -->
      <button @click="openInfoHandler" class="info-btn">
        <span class="text">{{ $t('text.info') }}</span>
        <img src="~assets/svg-icons/arrow-45deg.svg" class="icon" />
      </button>

      <!-- PRODUCT PROPERTIES -->
      <ul 
        v-if="product.stimulation !== null && product.relaxation !== null && product.euphoria !== null"
        class="qualities"
      >
          <li class="quality">
              <p class="name">{{ $t('text.stimulation') }}</p>
              <simple-five-dots v-model="product.stimulation" size="small" is-static></simple-five-dots>
          </li>
          <li class="quality">
              <p class="name">{{ $t('text.relaxation') }}</p>
              <simple-five-dots v-model="product.relaxation" size="small" is-static></simple-five-dots>
          </li>
          <li class="quality">
              <p class="name">{{ $t('text.euphoria') }}</p>
              <simple-five-dots v-model="product.euphoria" size="small" is-static></simple-five-dots>
          </li>
      </ul>

      <!-- PRODUCT MODIFICATIONS -->
      <div class="weight">
        <product-variants-list v-model="selectedModification" :values="product.modifications"></product-variants-list>
      </div>

      <!-- PRODUCT FOOTER -->
      <div class="footer">
        <p class="price">USD <span>{{ selectedModification.price }}</span></p>
        <button @click="toCartHandler" class="main-button-color">
            <span class="text">{{ $t('text.add_to_cart') }}</span>
        </button>
      </div>

  </div>
</template>