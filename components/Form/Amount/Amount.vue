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

    min: {
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
      if(this.modelValue > this.min) {
        let value = this.modelValue
        this.$emit('update:modelValue', --value)
      }
    },

    plusHandler() {
      if(this.modelValue < this.max) {
        let value = this.modelValue
        this.$emit('update:modelValue', ++value)
      }
    },

    updateHandler(event) {
      let value = 1
      
      if(event.target.value > 0)
        value = event.target.value
      
      this.$emit('update:modelValue', value)
    }
  }
}
</script>

<style src="./amount.scss" lang="postcss" scoped />

<template>
  <div class="product__calc">
    <button @click="minusHandler" clickable type="button" class="calc_button">
      <span class="text">-</span>
    </button>
    
    <input :value="modelValue" @change="updateHandler" :max="max" :min="min" type="number" class="calc-input">

    <button @click="plusHandler" clickable type="button" class="calc_button">
      <span class="text">+</span>
    </button>
  </div>
</template>