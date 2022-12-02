<script>
export default {
  props: {
    modelValue: {
      type: Boolean,
      default: false
    },
    label: {
      type: String
    },
    required: {
      type: Boolean,
      default: false
    },
    error: {
      type: Object,
      default: false
    },
    isDisabled: {
      type: Boolean,
      default: false
    }
  }
}
</script>

<style src="./checkbox.scss" lang="sass" scoped />

<template>
  <label class="input__wrapper input__wrapper-checkbox">
    <input :checked="modelValue" type="checkbox" class="input-checkbox">
    <span class="custome-checkbox">
      <img src="~assets/svg-icons/check.svg" class="icon"/>
    </span>
    <p class="text">{{ label }}</p>
  </label>
</template>