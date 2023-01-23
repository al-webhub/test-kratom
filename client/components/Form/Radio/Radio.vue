<script>
export default {
  props: {
    modelValue: {
      required: true
    },
    value: {
      type: String
    },
    name: {
      type: String
    }
  },

  methods: {
    changeHandler(v) {
      this.$emit('update:modelValue', v.target.value)
    }
  }
}
</script>

<style src="./radio.scss" lang="sass" scoped />

<template>
  <label class="input__wrapper-radio">
    <input :value="value" @change="changeHandler" :name="name" :checked="value === modelValue" type="radio" class="input-radio" >
    <span class="custome-radio"></span>

    <slot />
  </label>
</template>