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
          <div class="general-slider__buttons js-arrow-infinity">
              <button class="slider-button prev">
                  <span class="icon-arrow-left"></span>
              </button>
              
              <!-- Точки нужно выводить если они кратны 3 -->
              
              <div class="dots__list">
                  <div
                    v-for="(product, key) in products"
                    :key="product.id"
                    v-if="(key + 1) % 3 == 0"
                    :class="{active: (key + 1) == 3}"
                    class="dots__item js-dot"
                  >
                  </div>
              </div>
              
              <!-- //Точки нужно выводить если они кратны 3 -->
              <a href="shop" class="main-button">
                  <span class="text">{{ $t('text.view_all_products') }}</span>
              </a>
              <button class="slider-button next">
                  <span class="icon-arrow-right"></span>
              </button>
          </div>
      </div>
  </section>
</template>