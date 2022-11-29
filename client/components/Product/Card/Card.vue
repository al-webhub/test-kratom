<script>
export default {
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

    addToCart(arg1, arg2) {
      
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
  }
}
</script>

<style src="./card.scss" lang="sass" scoped />

<template>
  <div class="product__item__container" :class="{active: isInfoOpen}">
      
      <!-- PRODUCT INFO -->
      <div class="product__item__info-block">
        <button @click="closeInfoHandler" class="product__item__info-block--close-btn">+</button>
        <div class="wrapper" v-html="product.excerpt"></div>
      </div>

      <!-- PRODUCT IMAGE -->
      <a :href="product.link" class="image">
        <!-- <img :alt="product.name" :title="product.name" :src="product.image"> -->

        <nuxt-picture
          :src = "product.image"
          sizes = "mobile:100vw tablet:230px desktop:240px"
          format = "webp"
          quality = "80"
          loading = "lazy"
        >
        </nuxt-picture> 
      </a>

      <!-- PRODUCT NAME -->
      <a :href="product.link" class="link">{{ product.name }}</a>
      
      <!-- PRODUCT SHOW INFO BUTTON -->
      <button @click="openInfoHandler" class="info-btn">
          <span class="text">{{ $t('text.info') }}</span>
          <img src="~assets/svg-icons/arrow-45deg.svg" class="icon" />
      </button>

      <!-- PRODUCT PROPERTIES -->
      <ul 
        v-if="product.stimulation !== null && product.relaxation !== null && product.euphoria !== null"
        class="product__item__info-list"
      >
          
          <li class="product__item__info-item">
              <p class="name">{{ $t('text.stimulation') }}</p>
              <simple-five-dots v-model="product.stimulation" size="small" is-static></simple-five-dots>
          </li>
          <li class="product__item__info-item">
              <p class="name">{{ $t('text.relaxation') }}</p>
              <simple-five-dots v-model="product.relaxation" size="small" is-static></simple-five-dots>
          </li>
          <li class="product__item__info-item">
              <p class="name">{{ $t('text.euphoria') }}</p>
              <simple-five-dots v-model="product.euphoria" size="small" is-static></simple-five-dots>
          </li>
      </ul>

      <!-- PRODUCT MODIFICATIONS -->
      <div class="product__item__weight">
          <ul class="product__weight-list">
              <li
                v-for="(modification, key) in product.modifications"
                :key="modification.id"
                :class="{active: selectedModification.id === modification.id}"
                @click="changeModification(modification)"
                class="product__weight-item" 
              >
                {{ modification.name }}
              </li>
          </ul>
      </div>

      <!-- PRODUCT FOOTER -->
      <div class="product__item__footer">
        <p class="product__item__price">USD <span>{{ selectedModification.price }}</span></p>
        <button @click="addToCart(product.id, selectedModification)" class="main-button-color">
            <span class="text">{{ $t('text.add_to_cart') }}</span>
        </button>
      </div>

  </div>
</template>