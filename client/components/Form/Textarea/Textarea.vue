<script>
export default {
  data() {
    return {
      isActive: false
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
    }
  },

  methods: {
    focusHandler() {
      this.isActive = true
    },

    blurHandler() {
      this.isActive = false
    }
  }
}
</script>

<style src="./textarea.scss" lang="sass" scoped />

<template>
  <div :class="{error: error}" class="input__wrapper">
    <textarea
      @focus="focusHandler"
      @blur="blurHandler"
      :value="modelValue"
      rows="5"
      class="main-textarea"
    >
    </textarea>

    <form-placeholder
      v-if="placeholder"
      :is-active="isActive"
      :placeholder="placeholder"
      :is-required="required"
    >
    </form-placeholder>

    <span v-if="error" class="input-error-text">{{ error.message }}</span>
  </div>
</template>