<script>
export default {
  data() {
    return {
      onFocus: false
    }
  },

  props: {
    modelValue: {
      type: String
    },
    placeholder: {
      type: String
    },
    required: {
      type: Boolean,
      default: false
    },
    error: {
      type: [Object, Array, String, Boolean],
      default: false
    },
    isDisabled: {
      type: Boolean,
      default: false
    },
    readonly: {
      type: Boolean,
      default: false
    }
  },

  computed: {
    isActive() {
      return this.onFocus || this.modelValue?.length
    },
  },

  methods: {
    changeHandler(v) {
      this.$emit('update:modelValue', v.target.value)
    },

    focusHandler() {
      this.onFocus = true
    },

    blurHandler() {
      this.onFocus = false
    }
  },
}
</script>

<style src="./text.scss" lang="sass" scoped />

<template>
  <div :class="{error: error, disabled: isDisabled}" class="input__wrapper">
    <input
      :value="modelValue"
      @input="changeHandler"
      @focus="focusHandler"
      @blur="blurHandler"
      type="text"
      class="main-input"
      :readonly="readonly"
    >
    
    <form-placeholder
      v-if="placeholder"
      :is-active="isActive"
      :placeholder="placeholder"
      :is-required="required"
      :is-disabled="isDisabled"
    >
    </form-placeholder>

    <slot name="icon-right"></slot>
    
    <form-error :error="error"></form-error>

  </div>
</template>