<script>
export default {
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
    },

    activeIndex: {
      type: Number,
      default: 0
    },

    isArrows: {
      type: Boolean,
      default: 0
    }
  },

  methods: {
    prevHandler() {
      this.$emit('prev')
    },
    nextHandler() {
      this.$emit('next')
    }
  }
}
</script>

<style src="./slider-btns.scss" lang="sass" scoped />

<template>
  <div class="general-slider__buttons">

    <transition name="fade-in">
      <button v-if="isArrows" @click="prevHandler" class="slider-button prev" type="button" title="prev">
        <img src="~assets/svg-icons/arrow.svg" class="icon" alt="arrow icon" />
      </button>
    </transition>
    
    <div class="dots__list">
      <template v-for="(item, key) in items" :key="key">
        <div
          :class="{active: key === activeIndex}"
          class="dots__item" 
        >
        </div>
      </template>
    </div>
    
    <NuxtLink :to="localePath(link)" :aria-label="title" class="main-button">
      <span class="text">{{ title }}</span>
    </NuxtLink>

    <transition name="fade-in">
      <button v-if="isArrows" @click="nextHandler" class="slider-button next" type="button" title="next">
        <img src="~assets/svg-icons/arrow.svg" class="icon" alt="arrow icon" />
      </button>
    </transition>

  </div>
</template>