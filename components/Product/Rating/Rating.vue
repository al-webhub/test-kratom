<script>
export default {
  setup() {
    const { t } = useI18n({useScope: 'local'})
    return {t}
  },

  props: {
    rating: {
      type: Object
    },
  },

  computed: {
    value() {
      return this.rating.rating
    },

    ratingCount() {
      return this.rating.rating_count
    },

    reviewsCount() {
      return this.rating.reviews_count
    },

    roundValue() {
      return Math.round(this.value);
    },

    detailes() {
      return Object.values(this.rating.rating_detailes)
    }
  },

  methods: {

    getLineStyle(point) {
      const percent = point * 100 / this.ratingCount

      return {
        width: percent + '%'
      }
    }
  }
}
</script>

<style src="./rating.scss" lang="scss" scoped />

<template>
  <div v-if="value" class="wrapper">
    <div class="header">
      <div class="rating">
        <div class="rating__value">{{ value }}</div>
        <div class="rating__out-of">{{ t('out_of', {value: 5}) }}</div>
      </div>
      <div class="stars">
        <img v-for="key in 5" :key="key" src="~assets/svg-icons/star.svg" :class="{active: key <= roundValue }" class="icon" alt="star" />
      </div>
      <div class="reviews">
        {{ $t('label.rating_reviews', {rating: ratingCount, reviews: reviewsCount})}}
      </div>
    </div>
    <div class="body">
      <div
        v-for="(point, index) in detailes"
        :key="index"
        class="scale"
      >
        <div class="scale__stars">
          <img v-for="key in 5 - index" :key="key" src="~assets/svg-icons/star.svg" class="icon" alt="star" />
        </div>
        <div class="scale__line">
          <div class="scale__line-fill" :style="getLineStyle(point)"></div>
        </div>
        <div class="scale__value">{{ point }}</div>
      </div>
    </div>
  </div>
</template>
<i18n>
  {
    en: {
      "out_of": "out of {value}",
    },

    ru: {
      "out_of": "из {value}",
    }
  }
</i18n>