<script>
export default {
  props: {
    error: {
      type: [Object, Array, String, Boolean],
      default: false
    },
  },

  computed: {
    errorMessage() {
      return Array.isArray(this.error)? this.error[0]: this.error;
    }
  },
}
</script>

<style src="./error.scss" lang="sass" scoped />

<template>
  <span v-if="error" class="input-error-text">{{ errorMessage }}</span>
</template>