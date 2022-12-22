<script>

export default {
  data() {
    return {
      isActive: false,
      content: ''
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

  computed: {
    isPlaceholderActive() {
      return this.isActive || this.content.length
    }
  },

  watch: {
    content: {
      handler(value) {
        this.$emit('update:modelValue', value)
      },
      immediate: true
    }
  },

  methods: {
    focusHandler() {
      this.isActive = true
    },

    blurHandler() {
      this.isActive = false
    },

  },

  mounted() {
    this.content = this.modelValue
  }
}
</script>

<style src="./textarea.scss" lang="sass" scoped />

<template>
  <div :class="{error: error}" class="input__wrapper">
    
    <resize-textarea
      v-model="content"
      :min-height="30"
      :max-height="350"
      :rows="1"
      @focus.native="focusHandler"
      @blur.native="blurHandler"
      class="main-textarea"
    >
    </resize-textarea>

    <form-placeholder
      v-if="placeholder"
      :is-active="isPlaceholderActive"
      :placeholder="placeholder"
      :is-required="required"
    >
    </form-placeholder>

    <span v-if="error" class="input-error-text">{{ error.message }}</span>
  </div>
</template>