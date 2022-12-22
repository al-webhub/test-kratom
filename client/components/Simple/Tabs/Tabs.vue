<script>
export default {
  data() {
    return {}
  },

  props: {
    activeTab: {
      type: [String, Number]
    },

    values: {
      type: Array
    }
  },

  methods: {
    selectHandler(index) {
      this.$emit('update:activeTab', index)
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
      :class="{active: index === activeTab}"
      class="item"
    >
      {{ tab }}
    </li>
  </ul>
</template>