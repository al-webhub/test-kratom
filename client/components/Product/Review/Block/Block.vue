<script>
import { useReviewStore } from '~/store/review';

export default {
  setup() {
    const reviewStore = useReviewStore()

    return {
      reviewStore
    }
  },

  data() {
    return {}
  },

  props: {
    reviews: {
      type: Array
    },

    product: {
      type: Object
    },

    meta: {
      type: Object
    },

    slice: {
      type: [Number, Boolean],
      default: false
    },

    allowLoadmore: {
      type: Boolean,
      default: true
    }
  },

  methods: {
    addHandler() {
      this.reviewStore.setReviewable(this.product.id, String.raw`Backpack\Store\app\Models\Product`)
      this.reviewStore.openModal()
    },

    loadmoreHandler() {
      this.$emit('loadmore')
    }
  },

  computed: {
    reviewsSlice() {
      return this.slice? this.reviews.slice(0, this.slice): this.reviews
    }
  }
}
</script>

<style src="./block.scss" lang="sass" scoped />

<template>
  <div class="block-wrapper">

    <div class="reviews">
      <ul class="reviews__list">
        <review-card
          v-for="review in reviewsSlice"
          :key="review.id"
          :review="review"
          :user="user"
        >
        </review-card>
      </ul>

      <button
        v-if="allowLoadmore && meta && meta.current_page !== meta.last_page"
        @click="loadmoreHandler"
        class="loadmore-btn"
      >
        {{ $t('button.load_more') }}
        <img src="~assets/svg-icons/arrow-simple.svg" class="icon" />
      </button>

    </div>

    <div class="rating">
      <product-rating v-if="product?.reviews_rating_detailes" :rating="product.reviews_rating_detailes"></product-rating>

      <div class="add-reviews">
        <div class="add-reviews__text">
          <p class="add-reviews__title">{{ $t('messages.feedback_and_earn') }}</p>
          <p class="add-reviews__desc" v-html="$t('messages.leave_incognito_for', {first: '$1', second: '$2'})"></p>
        </div>
        <button @click="addHandler" class="main-button primary btn-item">
          <span class="text">{{ $t('button.leave_feedback') }}</span>
        </button>
      </div>
    </div>

    <popup-feedback></popup-feedback>

  </div>
</template>