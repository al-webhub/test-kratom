<script>
export default {
  data() {
    return {
      clearValue: '',
      isVisible: false
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
    changeVisible(value) {
      this.clearValue = value
      this.$emit('update:modelValue', value)
    },

    changeInvisible(value) {
      const lastSymbol = value.slice(-1)

      if(lastSymbol === '*' || !lastSymbol){
        this.clearValue = this.clearValue.slice(0, -1)
      }else {
        this.clearValue += value.slice(-1)
      }

      this.$emit('update:modelValue', this.clearValue)
    },

    changeHandler(value) {
      if(this.isVisible){
        this.changeVisible(value)
        return
      }
      
      this.changeInvisible(value)
      
    },

    showHandler() {
      this.isVisible = !this.isVisible
    }
  },

  computed: {
    valueWithStars() {
      if(this.isVisible)
        return this.modelValue
      else
        return '*'.repeat(this.modelValue.length)
    }
  }
}
</script>

<style src="./password.scss" lang="sass" scoped />

<template>
  <form-text
    :model-value="valueWithStars"
    @update:modelValue="changeHandler"
    :placeholder="placeholder"
    :required="required"
    :error="error"
    :is-disabled="isDisabled"
  >
    <template v-slot:icon-right>
      <button @click="showHandler" :class="{active: isVisible}" clickable class="show-password">
        <img src="~assets/svg-icons/eye.svg" class="icon"/>
      </button>
    </template>

  </form-text>
</template>