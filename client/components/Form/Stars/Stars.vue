<script>
export default {
  props: {
    modelValue: {
      type: [Number],
      default: 0
    },

    slots: {
      type: Number,
      default: 5
    },

    labels: {
      type: [Array],
      default: () => {
        const nuxtApp = useNuxtApp()

        return [
          nuxtApp.$i18n.t('review.mark.bad'),
          nuxtApp.$i18n.t('review.mark.so_so'),
          nuxtApp.$i18n.t('review.mark.normal'),
          nuxtApp.$i18n.t('review.mark.good'),
          nuxtApp.$i18n.t('review.mark.perfect'),
        ]
      }
    }
  },

  methods: {
    setHandler(v) {
      if(v === this.modelValue)
        this.$emit('update:modelValue', 0)
      else
        this.$emit('update:modelValue', v)
    }
  }
}
</script>

<style src="./stars.scss" lang="scss" scoped />

<template>
  <ul class="stars">
    <li
      v-for="i in slots"
      :key="i"
      @click="setHandler(i)"
      :class="{active: i <= modelValue}"
      class="item"
    >
      <img src="~assets/svg-icons/star.svg" class="icon" />
      <p v-if="labels[i - 1]">{{ labels[i-1] }}</p>
    </li>
  </ul>
</template>