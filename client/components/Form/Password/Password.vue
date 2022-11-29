<script>
export default {
  data() {
    return {}
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
  }
}
</script>

<style src="./password.scss" lang="sass" scoped />

<template>
  <form-text
    :modelValue="modelValue"
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