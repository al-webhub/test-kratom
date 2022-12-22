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
    
    toCartHandler(arg1, arg2) {
      this.cartStore.add(this.selectedModification)
    },
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

    <button @click="toCartHandler" class="main-button-color btn-item">
      <span class="text">{{ $t('text.add_to_cart') }}</span>
    </button>
  </div>
</template>