<script>
export default {
  data() {
    return {}
  },

  props: {
    modelValue: {
      type: [String, Number]
    },

    values: {
      type: Array
    },

    index: {
      type: String
    },

    value: {
      type: String
    }
  },

  methods: {
    isTabActive(index) {
      if(this.index)
        return this.values[index][this.index] === this.modelValue
      else
        return index === this.modelValue
    },

    selectHandler(index) {
      if(this.index)
        this.$emit('update:modelValue', this.values[index][this.index])
      else
        this.$emit('update:modelValue', index) 
    }
  }
}
</script>

<style src="./tabs.scss" lang="sass" scoped />

<template>
  <ul class="list">
    <li
      v-for="(tab, index) in values"
      :key="index"
      @click="selectHandler(index)"
      :class="{active: isTabActive(index)}"
      class="item"
    >
      {{ tab[value] || tab }}
    </li>
  </ul>
</template>