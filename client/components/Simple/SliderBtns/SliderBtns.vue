<script>
export default {
  data() {
    return {
      activeIndex: 0
    }
  },

  props: {
    title: {
      type: String,
      default: 'View all'
    },
    
    link: {
      type: String,
      required: true
    },

    items: {
      type: Number,
      required: true
    }
  },

  methods: {
    prevHandler() {
      this.activeIndex--
      this.$emit('prev')
    },
    nextHandler() {
      this.activeIndex++
      this.$emit('next')
    }
  }
}
</script>

<style src="./slider-btns.scss" lang="sass" scoped />

<template>
  <div class="general-slider__buttons">

    <button @click="prevHandler" class="slider-button prev">
      <img src="~assets/svg-icons/arrow.svg" class="icon" />
    </button>
    
    <!-- Точки нужно выводить если они кратны 3 -->
    
    <div class="dots__list">
      <template v-for="(item, key) in items" :key="key">
        <div
          v-if="(key + 1) % 3 == 0"
          :class="{active: key === activeIndex}"
          class="dots__item" 
        >
        </div>
      </template>
    </div>
    
    <!-- //Точки нужно выводить если они кратны 3 -->
    <NuxtLink :to="localePath(link)" class="main-button">
      <span class="text">{{ title }}</span>
    </NuxtLink>

    <button @click="nextHandler" class="slider-button next">
      <img src="~assets/svg-icons/arrow.svg" class="icon" />
    </button>

  </div>
</template>