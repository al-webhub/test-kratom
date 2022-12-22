<script>
export default {
  props: {
    products: {
      type: Array,
      required: true
    }
  },
  watch: {
    product: {
      handler(val) {
        console.log('watch', val)
      },
      immediate: true,
      deep: true
    }
  }
}
</script>

<style src="./products-slider.scss" lang="sass" scoped />

<template>
  <section class="product slider-infinity">
      <div class="product__wrapper container">
          
        <h2 class="main-caption">{{ $t('text.featured') }}</h2>
        

        <simple-slider
          v-if="products && products.length"
          :values="products"
          target-component-name="productCard"
          target-data-name="product"
          :all-items-label="$t('text.view_all_products')"
          all-items-link="shop"
        >
        </simple-slider>
        <!-- <TransitionGroup name="list" tag="ul" class="list slider__list"  mode="in-out" appear>
          <li 
            v-for="(product, index) in products"
            :key="product.id"
            :class="{show: index == 0}"
            class="product__item item" 
          >
            <product-card  :product="product"></product-card>
          </li>
        </TransitionGroup>

        <simple-slider-btns
          :title="$t('text.view_all_products')"
          :items="products.length"
          link="shop"
        >
        </simple-slider-btns> -->

      </div>
  </section>
</template>