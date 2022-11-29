<script>
export default {
  data() {
    return {}
  },

  props: {
    modelValue: {
      type: Number,
      default: 1
    },

    max: {
      type: Number,
      default: 999999
    }
  },

  methods: {
    minusHandler() {
      if(this.modelValue > 1) {
        let value = this.modelValue
        this.$emit('update:modelValue', --value)
      }
    },

    plusHandler() {
      let value = this.modelValue
      this.$emit('update:modelValue', ++value)
    },

    updateHandler(event) {
      let value = event.target.value
      this.$emit('update:modelValue', value)
    }
  }
}
</script>

<style src="./amount.scss" lang="postcss" scoped />

<template>
  <div class="product__calc">
    <button @click="minusHandler" type="button" class="calc_button">
      <span class="text">-</span>
    </button>
    
    <input :value="modelValue" @change="updateHandler" :max="max" type="text" class="calc-input">

    <button @click="plusHandler" type="button" class="calc_button">
      <span class="text">+</span>
    </button>
  </div>
</template>