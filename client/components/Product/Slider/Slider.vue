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
    getImageUrl(src) {
      if(src)
        return '/server/' + src
      else
        return null
    },

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
        class="product-page__img-item"
      >
        <nuxt-img
          :src="getImageUrl(image.src)"
          :title="image.title || image.alt || 'kratom'"
          :alt="image.alt || image.title || 'kratom'"
          sizes = "mobile:100vw tablet:450px desktop:470px"
          provider="ipx"
          format = "webp"
          quality = "40"
          loading = "lazy"
          fit="contain"
          class="image contain"
        >
        </nuxt-img>
      </li>
    </ul>
    
    <div
      v-if="images.length > 1"
      class="product-page__img-arrows"
    >
      <button @click="prevHandler" type="button" class="nav-button prev" aria-label="prev image">
        <img src="~assets/svg-icons/arrow.svg" class="icon" alt="arrow icon" />
      </button>
      <button @click="nextHandler" type="button" class="nav-button next" aria-label="next image">
        <img src="~assets/svg-icons/arrow.svg" class="icon" alt="arrow icon" />
      </button>
    </div>

    <div v-if="images.length > 1" class="dots__list">
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