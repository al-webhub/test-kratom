<script>
export default {
  props: {
    values: {
      type: Array
    },
    modelValue: {
      type: Object
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
  <ul class="list">
    <li
      v-for="(value, key) in values"
      :key="value.id"
      @click="changeHandler(value)"
      :class="{active: value.id === modelValue.id}"
      clickable
      class="item"
    >
      {{ value.short_name }}
    </li>
  </ul>
</template>