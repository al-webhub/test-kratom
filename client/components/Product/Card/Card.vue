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
      <div class="product__item__info-block">
          <button class="product__item__info-block--close-btn" @click="closeInfoHandler">+</button>
          <div class="wrapper" v-html="product.excerpt">
          </div>
      </div>
      <a :href="product.link" class="product__item__img">
          <img :alt="product.name" :title="product.name" :src="product.image">
      </a>
      <a :href="product.link" class="product__item__link">{{ product.name }}</a>
      <button class="product__item__button" @click="openInfoHandler">
          <span class="text">{{ $t('text.info') }}</span>
          <span class="icon-info"></span>
      </button>
      <ul class="product__item__info-list" v-if="product.stimulation != null && product.relaxation != null && product.euphoria != null">
          <li class="product__item__info-item">
              <p class="name">{{ $t('text.stimulation') }}</p>
              <ul class="product__item__info-poins__list" :title="product.stimulation">
                  <li
                    v-for="point in 5"
                    :key="point + 'index'"
                    :class="{active: product.stimulation <= point * 20 }"
                    class="product__item__info-poins__item"
                  >
                  </li>
              </ul>
          </li>
          <li class="product__item__info-item">
              <p class="name">{{ $t('text.relaxation') }}</p>
              <ul class="product__item__info-poins__list" :title="product.relaxation">
                  <li
                    :key="point + 'index'"
                    v-for="point in 5"
                    :class="{active: product.relaxation <= point * 20 }"
                    class="product__item__info-poins__item" 
                  >
                  </li>
              </ul>
          </li>
          <li class="product__item__info-item">
              <p class="name">{{ $t('text.euphoria') }}</p>
              <ul class="product__item__info-poins__list" :title="product.euphoria">
                  <li
                    :key="point + 'index'"
                    v-for="point in 5"
                    :class="{active: product.euphoria <= point * 20 }"
                    class="product__item__info-poins__item" 
                  >
                  </li>
              </ul>
          </li>
      </ul>
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
      <div class="product__item__footer">
          <p class="product__item__price">USD <span>{{ selectedModification.price }}</span></p>
          <button class="main-button-color" @click="addToCart(product.id, selectedModification)">
              <span class="text">{{ $t('text.add_to_cart') }}</span>
          </button>
      </div>
  </div>
</template>