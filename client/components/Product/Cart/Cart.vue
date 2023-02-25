<script>
import { useCartStore } from '~/store/cart';
import { useModalStore } from '~/store/modal';
import _pick from 'lodash.pick';

export default {
  setup() {
    const cartStore = useCartStore()

    // COMPUTED
    const isPopupBuy1ClickShow = computed(() => {
      return useModalStore().show('buy1')
    })

    return {
      isPopupBuy1ClickShow
    }
  },

  props: {
    product: {
      type: Object
    },

    selectedModification: {
      type: Object
    }
  },

  methods: {

    updateVariantHandler(value) {
      this.$emit('update:selectedModification', value)
    },
    
    async toCartHandler() {
      const productToCart = Object.assign({}, this.selectedModification)

      productToCart.image || (productToCart.image = this.product.images[0])

      await useCartStore().add(productToCart).then(() => {
        useNoty().setNoty(this.$t('noty.product_to_cart', {product: this.selectedModification.name}), 3000)
      })
    },

    buyHandler() {
      const product = _pick(this.selectedModification, ['id', 'name', 'slug', 'price', 'amount', 'image', 'short_name'])

      useModalStore().setData('buy1', product)
      useModalStore().open('buy1')
    }
  }
}
</script>

<style src="./cart.scss" lang="sass" scoped />

<template>
  <div class="wrapper">      
    <product-variants-list
      :model-value="selectedModification"
      :values="product.modifications"
      @update:modelValue="updateVariantHandler"
      size="large"
      class="variants-item"
    >
    </product-variants-list>

    <div class="buy-item">
      <p class="price">USD <span>{{ Math.round(selectedModification.price * selectedModification.amount * 100) / 100 }}</span></p>
      <form-amount v-model="selectedModification.amount" ></form-amount>
    </div>
      
    <product-sale
      v-if="product.modifications[1]"
      :product="product"
      :selected-modification="selectedModification"
      class="sale-item"
    >
    </product-sale>

    <div class="btn-block">
      <button @click="toCartHandler" class="main-button primary btn-item">
        <span class="text">{{ $t('button.add_to_cart') }}</span>
      </button>

      <button @click="buyHandler" class="main-button primary-color btn-item">
        <img src="~assets/svg-icons/flash.svg" class="icon" />
        <span class="text">{{ $t('button.buy-1-click') }}</span>
      </button>
    </div>

    <transition name="fade-in">
      <lazy-popup-buy-1-click v-if="isPopupBuy1ClickShow"></lazy-popup-buy-1-click>
    </transition>
  </div>
</template>