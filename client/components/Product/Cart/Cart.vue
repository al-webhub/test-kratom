<script>
export default {
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

    },
  }
}
</script>

<style src="./cart.scss" lang="sass" scoped />

<template>
  <div class="product-page__info-choose">
                  
    <product-variants-list
      :model-value="selectedModification"
      :values="product.modifications"
      @update:modelValue="updateVariantHandler"
      size="large"
    >
    </product-variants-list>

    <div class="product-page__price-wrapper">
      <div class="wrapper">
        <p class="product-page__price">USD <span>{{ selectedModification.price * selectedModification.amount }}</span></p>
        <form-amount v-model="selectedModification.amount" ></form-amount>
      </div>
      
      <product-sale
        v-if="product.modifications[1]"
        :product="product"
        :selected-modification="selectedModification"
        class="product-page__info-sale-mobile"
      >
      </product-sale>

      <button @click="toCartHandler(product.id, selectedModification)" class="main-button-color">
        <span class="text">{{ $t('text.add_to_cart') }}</span>
      </button>

    </div>
  </div>
</template>