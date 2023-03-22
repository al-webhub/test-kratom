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
            posX: 'center',
            posY: 'top',
            showTill: 'mobile'
          },
          figure: {
            posX: 'left',
            posY: 'top',
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
    <div v-if="isTitle" :class="[settings.title.posX, settings.title.posY]" class="text">{{ title }}</div>      
    <div v-if="isFigure" :class="[settings.figure.posX, settings.figure.posY, settings.figure.showTill]" class="figure"></div>

    <slot />
  </div>
</template>