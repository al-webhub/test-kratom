<script>
export default {
  props: {
    reviews: {
      type: Array
    },
    product: {
      type: Object
    }
  },

  methods: {
    seeMoreHandler() {
      this.$emit('changeTab', 'reviews')
    }
  }
}
</script>

<style src="./description.scss" lang="scss" scoped />

<template>
  <div class="description-wrapper">
    <div v-html="product?.content" class="product-content-wrapper rich-text"></div>
    <div v-if="$device.isDesktop" class="reviews">
      <product-review-block :reviews="reviews" :product="product" :slice="3" :allow-loadmore="false" class="vertical"></product-review-block>
      <div v-if="reviews && reviews.length > 3" class="see-more">
        <button @click="seeMoreHandler" class="see-more__btn">
          {{ $t('button.see_more') }}
          <img src="~assets/svg-icons/arrow.svg" class="icon"/>
        </button>
      </div>
    </div>
  </div>
</template>