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
      type: [Object, Boolean],
      default: false
    },
    isDisabled: {
      type: Boolean,
      default: false
    }
  },

  computed: {
    isPlaceholderActive() {
      return this.isActive || this.modelValue && this.modelValue.length
    },

    id() {
      return 'input-' + (Math.random() + 1).toString(36).substring(7);
    }
  },

  methods: {
    updateHandler(value) {
      this.$emit('update:modelValue', value)
    },

    focusHandler() {
      this.isActive = true
    },

    blurHandler() {
      this.isActive = false
    },

  },
}
</script>

<style src="./textarea.scss" lang="sass" scoped />

<template>
  <div :class="{error: error}" class="input__wrapper">
    
    <form-textarea-resize
      :model-value="modelValue"
      @update:modelValue="updateHandler"
      :min-height="40"
      :max-height="350"
      :rows="1"
      :id="id"
      @focus="focusHandler"
      @blur="blurHandler"
      class="main-textarea"
    >
    </form-textarea-resize>

    <form-placeholder
      v-if="placeholder"
      :is-active="isPlaceholderActive"
      :placeholder="placeholder"
      :is-required="required"
      :target-id="id"
    >
    </form-placeholder>

    <span v-if="error" class="input-error-text">{{ error.message }}</span>
  </div>
</template>