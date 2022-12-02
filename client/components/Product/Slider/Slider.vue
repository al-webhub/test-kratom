<script>
export default {
  data() {
    return {
      showIndex: 0
    }
  },

  props: {
    images: {
      type: Array,
      required: true
    }
  },

  methods: {
    prevHandler() {
      if(this.showIndex > 0)
        this.showIndex -= 1
      else
        this.showIndex = this.images.length - 1
    },

    nextHandler() {
      if(this.showIndex < this.images.length - 1)
        this.showIndex += 1
      else
        this.showIndex = 0
    }
  }

}
</script>

<style src="./slider.scss" lang="sass" scoped />

<template>
  <div class="product-page__img slider">
    <ul class="product-page__img-list">
      <li 
        v-for="(image, index) in images"
        :key="index"
        :class="{show: index === showIndex}"
        class="product-page__img-item js-slider-item"
      >
        <img
          :src="image"
          :title="image.title || image.alt || null"
          :alt="image.alt || image.title || null"
        />
      </li>
    </ul>
    
    <div
      v-if="images.length"
      class="product-page__img-arrows"
    >
      <button @click="prevHandler" class="nav-button prev">
        <img src="~assets/svg-icons/arrow.svg" class="icon" />
      </button>
      <button @click="nextHandler" class="nav-button next">
        <img src="~assets/svg-icons/arrow.svg" class="icon" />
      </button>
    </div>

    <div v-if="images.length" class="dots__list">
      <div class="dots__item active js-dot"></div>
      <div
        v-for="index in images.length"
        :key="index"
        class="dots__item js-dot"
      >
      </div>
    </div>
  </div>
</template>