<script>
export default {
  setup() {
    const { t } = useI18n({
      useScope: 'local'
    }) 

    return {
      t
    }
  },

  props: {
    products: {
      type: Array,
      required: true
    }
  },

}
</script>

<style src="./products-slider.scss" lang="sass" scoped />

<template>
  <section class="">
    <div class="container"> 
      <h2 class="main-caption">{{ t('featured') }}</h2>
    </div>
      
    <div class="slider-holder">
      <simple-slider
        v-if="products && products.length"
        :values="products"
        target-component-name="productCard"
        target-data-name="product"
        :all-items-label="$t('button.view_all_products')"
        all-items-link="shop"
        class="slider"
      >
      </simple-slider>
    </div>
  </section>
</template>

<i18n>
  {
    "en": {
      "featured": "Featured"
    },
    "ru": {
      "featured": "Рекомендуемые"
    }
  }
</i18n>