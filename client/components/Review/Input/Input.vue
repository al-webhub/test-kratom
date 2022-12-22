<script>
export default {
  data() {
    return {
      comment: ''
    }
  },

  props: {
    newComment: {
      type: String
    },

    user: {
      type: Object
    }
  },

  watch: {
    comment: {
      immediate: true,
      handler(value) {
        this.$emit('update:newComment', value)
      }
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
      v-model="comment"
      :placeholder="$t('text.your_reviews')"
    >
    </form-textarea>

  </div>
</template>