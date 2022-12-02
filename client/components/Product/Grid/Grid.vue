<script>
export default {
  props: {
    products: {
      type: Array
    },
    title: {
      type: String
    }
  }
}
</script>

<style src="./grid.scss" lang="sass" scoped />

<template>
  <section class="container">
    <div class="header">
      <p class="main-caption">{{ title }}</p>
      <simple-more-btn :text="$t('text.shop')" class="btn"></simple-more-btn>
    </div>
    <div class="grid">
      <product-card 
        v-for="(product, key) in products"
        :key="product.id"
        :product="product"
      ></product-card>
    </div>
  </section>
</template>