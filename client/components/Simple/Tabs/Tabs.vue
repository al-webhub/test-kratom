<script>
export default {
  data() {
    return {}
  },

  props: {
    modelValue: {
      type: [String, Number]
    },

    values: {
      type: Array
    }
  }
}
</script>

<style src="./tabs.scss" lang="sass" scoped />

<template>
  <ul class="general-tabs__list">
    <li class="general-tabs__item active">{{ $t('text.description') }}</li>
    <li class="general-tabs__item">{{ $t('text.reviews') }}</li>
  </ul>
</template>