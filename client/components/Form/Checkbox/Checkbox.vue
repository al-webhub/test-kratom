<script>
export default {
  props: {
    modelValue: {
      type: Boolean,
      default: false
    },
    value: {
      type: String
    },
    name: {
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
  },

  methods: {
    changeHandler(v) {
      this.$emit('update:modelValue', v.target.value)
    }
  }
}
</script>

<style src="./checkbox.scss" lang="sass" scoped />

<template>
  <label class="input__wrapper input__wrapper-checkbox">
    <input
      :checked="modelValue === value"
      :value="value"
      :name="name"
      @change="changeHandler"
      type="checkbox"
      class="input-checkbox"
    />
    
    <span class="custome-checkbox">
      <img src="~assets/svg-icons/check.svg" class="icon"/>
    </span>

    <slot />
  </label>
</template>