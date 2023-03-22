<script>
export default {
  props: {
    title: {
      type: String,
      default: 'kratomhelper'
    },
    titleAmount: {
      type: Number,
      default: 1
    },
    figureAmount: {
      type: Number,
      default: 1
    }
  }
}
</script>

<style src="./decor.scss" lang="sass" scoped />

<template>
  <div class="decor-wrapper">
    <div v-for="i in titleAmount" :key="i" :class="`decor-text-${i}`" class="decor-text">{{ title }}</div>      
    <div v-for="i in figureAmount" :key="i" :class="`decor-figure-${i}`" class="decor-figure"></div>

    <slot />
  </div>
</template>