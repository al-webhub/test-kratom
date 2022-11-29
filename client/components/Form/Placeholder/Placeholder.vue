<script>
export default {
  data() {
    return {}
  },

  props: {
    placeholder: {
      type: String,
      required: true
    },
    isRequired: {
      type: Boolean,
      default: false
    },
    isActive: {
      type: Boolean,
      default: false
    },
    isDisabled: {
      type: Boolean,
      default: false
    }
  }
}
</script>

<style src="./placeholder.scss" lang="sass" scoped />

<template>
  <span :class="[{active: isActive}, {disabled: isDisabled}]" class="custome-placeholder__wrapper">
    <span class="custome-placeholder__before"></span>
    <span class="custome-placeholder__text">
      <span class="inner-text">
        {{ placeholder }}
        <span v-if="isRequired">*</span>
      </span>
    </span>
    <span class="custome-placeholder__after"></span>
  </span>
</template>