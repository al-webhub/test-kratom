<script>
export default {
  data() {
    return {
      label: null
    }
  },

  props: {
    link: {
      type: String,
      required: true
    },
    text: {
      type: String,
      required: false
    },
    isReverse: {
      type: Boolean,
      default: false
    }
  },
  
  mounted() {
    this.label = this.text? this.text: this.$t('button.read_more')
  }
}
</script>

<style src="./more-btn.scss" lang="sass" scoped />

<template>
  <NuxtLink :to="localePath(link)" :class="{reverse: isReverse}" :prefetch="false" :aria-label="label" class="general-more" >
      <span class="text">{{ label }}</span>
      <span class="circle">
        <img src="~assets/svg-icons/arrow.svg" class="icon" alt="arrow icon" /> 
      </span>
  </NuxtLink>
</template>