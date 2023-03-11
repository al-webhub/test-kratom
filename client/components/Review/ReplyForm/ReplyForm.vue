<script>
export default {
  data() {
    return {
      newComment: null
    }
  },

  props: {
    user: {
      type: Object
    }
  },

  methods: {
    sendHandler() {
      this.$emit('reply', this.newComment)
      this.newComment = null
      this.closeHandler()
    },

    closeHandler() {
      this.$emit('close')
    }
  }
}
</script>

<style src="./reply-form.scss" lang="scss" scoped />

<template>
  <div class="add-reviews__form">
      
    <review-input
      v-model="newComment"
      :user="user"
    >
    </review-input>

    <div class="buttons">
      <button @click="closeHandler" clickable type="button" class="button-only-text btn">
        <span class="text">{{ $t('button.cancel') }}</span>
      </button>
      <button @click="sendHandler" clickable class="main-button small primary-color btn">
        <span class="text">{{ $t('button.reply') }}</span>
      </button>
    </div>
    
  </div>
</template>