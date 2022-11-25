<script>
export default {
  props: {
    products: {
      type: Array,
      required: true
    }
  }
}
</script>

<style src="./products-slider.scss" lang="sass" scoped />

<template>
  <section class="product slider-infinity">
      <div class="product__wrapper container">
          
        <h2 class="main-caption">{{ $t('text.featured') }}</h2>
          
        <!-- <infinity-slider :data-items="popular_products" data-type="productCard" data-link="/shop" data-button="view all products" data-class-list="product__list product-slider__list" data-class-item="product__item product-slider__item"></infinity-slider> -->
          
        <ul class="product__list product-slider__list js-infinity-slider-list">
          <li 
            v-for="(product, index) in products"
            :key="product.id"
            :class="{show: index == 0}"
            class="js-slider-item-infinity product__item product-slider__item" 
          >
            <product-card  :product="product"></product-card>
          </li>
        </ul>

        <simple-slider-btns
          :title="$t('text.view_all_products')"
          :items="products.length"
          link="shop"
        >
        </simple-slider-btns>

      </div>
  </section>
</template>