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
      type: Object,
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
    }
  },

  methods: {
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
  <div :class="{error: error}" class="input__wrapper">
    <input
      :value="modelValue"
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
    >
    </form-placeholder>

    <slot name="icon-right"></slot>

    <span v-if="error" class="input-error-text">{{ error.message }}</span>
  </div>
</template>