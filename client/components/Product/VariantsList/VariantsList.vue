<script>
export default {
  props: {
    values: {
      type: Array
    },
    modelValue: {
      type: Number
    }
  },

  methods: {
    changeHandler(value) {
      this.$emit('update:modelValue', value)
    }
  }
}
</script>

<style src="./variants-list.scss" lang="sass" scoped />

<template>
  <ul class="product__weight-list">
    <li
      v-for="(value, key) in values"
      :key="value.id"
      @click="changeHandler(value)"
      :class="{active: value.id === modelValue.id}"
      class="product__weight-item"
    >
      {{ value.short_name }}
    </li>
  </ul>
</template>