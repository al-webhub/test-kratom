<script>
export default {
  data() {
    return {
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
  
  methods: {
    changeHandler(value) {
      this.$emit('update:modelValue', value)
    },
  },
}
</script>

<style src="./password.scss" lang="sass" scoped />

<template>
  <form-text
    :model-value="modelValue"
    @update:modelValue="changeHandler"
    :placeholder="placeholder"
    :required="required"
    :error="error"
    :is-disabled="isDisabled"
  >
    <template v-slot:icon-right>
      <button type="button" class="show-password">
        <img src="~assets/svg-icons/eye.svg" class="icon"/>
      </button>
    </template>
  </form-text>
</template>