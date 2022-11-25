<script>
export default {
  props: {
    title: {
      type: String,
      default: 'kratomhelper'
    },
    isTitle: {
      type: Boolean,
      default: true
    },
    isFigure: {
      type: Boolean,
      default: false
    },
    settings: {
      type: Object,
      default: () => {
        return {
          title: {
            pos: 'center',
            showTill: 'mobile'
          },
          figure: {
            pos: 'left',
            showTill: 'mobile'
          }
        }
      }
    }
  }
}
</script>

<style src="./decorator.scss" lang="sass" scoped />

<template>
  <div class="wrapper">
    <div v-if="isTitle" :class="settings.title.pos" class="text">{{ title }}</div>      
    <div v-if="isFigure" :class="[settings.figure.pos, settings.figure.showTill]" class="figure"></div>

    <slot />
  </div>
</template>