<script>
export default {
  data() {
    return {}
  },

  props: {
    modelValue: {
      type: String
    },

    user: {
      type: Object
    }
  },

  methods: {
    updateHandler(value) {
      this.$emit('update:modelValue', value)
    }
  }
}
</script>


<style src="./input.scss" lang="scss" scoped />

<template>
  <div class="wrapper">
    <div :style="{backgroundImage: 'url(' + user.photo + ')'}" class="reviews-img"></div>
    
    <!-- textarea -->
    <form-textarea
      :model-value="modelValue"
      @update:modelValue="updateHandler"
      :placeholder="$t('form.your_review')"
    >
    </form-textarea>

  </div>
</template>