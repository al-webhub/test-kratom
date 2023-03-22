<script>
export default {
  props: {
    isStatic: {
      type: Boolean,
      default: false
    },
    
    size: {
      type: String,
      default: 'large'
    },

    modelValue: {
      type: Number,
      default: 0
    },

    userMark: {
      type: Number,
      default: 0
    },

    get: {
      type: String,
      default: 'absolute'
    }
  },

  methods: {

  	minusHandler: function(){
      if(this.get === 'relative') {
        this.$emit('update:modelValue', -1)
        return
      }

      const value = this.modelValue - 0.5

	  	if(this.modelValue > 0)
        this.$emit('update:modelValue', value)
  	},

  	plusHandler: function(){
      if(this.get === 'relative') {
        this.$emit('update:modelValue', 1)
        return
      }

      const value = this.modelValue + 0.5

	  	if(this.modelValue < 5)
        this.$emit('update:modelValue', value)
  	}
  },
}
</script>

<style src="./five-dots.scss" lang="sass" scoped />

<template>
  <div :class="[size, {static: isStatic}]" class="five-dots-wrapper">

    <button
      v-if="!isStatic"
      @click="minusHandler"
      :class="{disabled: userMark === -1}"
      class="button minus"
      type="button"
      title="minus"
      clickable
    >
      –
    </button>
    
    <div
      v-for="circle in 5"
      :key="circle"
      :class="{
        active: modelValue > (circle - 0.5),
        'active-half': modelValue == (circle - 0.5)
      }"
      class="point" 
    >
      <span class="point__round">
        <span class="point__halfs"></span>
      </span>
    </div>
    
    <button
      v-if="!isStatic"
      @click="plusHandler"
      :class="{disabled: userMark === 1}"
      class="button plus"
      type="button"
      title="plus"
      clickable
    >
      +
    </button>
  </div>
</template>