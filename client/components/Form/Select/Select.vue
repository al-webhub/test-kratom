<script>
export default {
  data() {
    return {
      isActive: false
    }
  },

  props: {
    nullable: {
      type: Boolean,
      default: true
    },
    modelValue: {
      type: String
    },
    placeholder: {
      type: String,
    },
    required: {
      type: Boolean,
      default: false
    },
    values: {
      type: [Array, Object],
      required: true
    }
  },

  methods: {
    selectHandler(val) {
      this.$emit('update:modelValue', val)
    },
    focusHandler() {
      this.isActive = true
    },
    blurHandler() {
      this.isActive = false
    }
  }
}
</script>

<style src="./select.scss" lang="sass" scoped />

<template>
  <div :class="{active: isActive}" class="input__wrapper js-input-wrapper js-drop-item general-drop">
      <input
        :value="modelValue"
        @focus="focusHandler"
        @blur="blurHandler" 
        type="text"
        class="main-input js-input js-drop-input js-drop-button"
        readonly 
        required
      > 
      
      <form-placeholder v-if="placeholder" :is-active="isActive" :placeholder="placeholder" :is-required="required"></form-placeholder>

      <span class="icon-drop"></span>

      <div class="general-drop__list">
        
        <div v-if="nullable" class="general-drop__item general-drop__item-select">
          <div class="text">{{ $t('text.Please_select') }}</div>
        </div>

        <div
          v-for="(value, index) in values"
          :key="index"
          @click="selectHandler(value)"
          :class="{active: modelValue === value}"
          class="general-drop__item js-drop-contains"
        >
          <span class="icon-active"></span>
          <div class="text">{{ value }}</div>
        </div>

      </div>
  </div>
</template>