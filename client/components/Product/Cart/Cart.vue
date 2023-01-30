<script>
import { useCartStore } from '~/store/cart';

export default {
  setup() {
    const cartStore = useCartStore()

    return {
      cartStore
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
      const {setNoty} = useNoty()
      
      await this.cartStore.add(this.selectedModification).then(() => {
        setNoty(this.$t('noty.product_to_cart', {product: this.selectedModification.name}), 3000)
      })
    },

    buyHandler() {
      this.cartStore.setBuy1Product(this.selectedModification)
      this.cartStore.toggleBuy1()
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

    <lazy-popup-buy-1-click></lazy-popup-buy-1-click>
  </div>
</template>