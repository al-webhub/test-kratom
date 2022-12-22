<script>
export default {
  data() {
    return {
      newComment: ''
    }
  },

  props: {
    user: {
      type: Object
    }
  },

  computed: {
    photo: function(){
      let noAvatar = '/img/photo-log-in.png';
      
      if(this.user)
        return this.user.usermeta.photo? this.user.usermeta.photo: noAvatar;
      else
        return noAvatar;
    }  
  },

  methods: {
    sendHandler() {
      this.$emit('reply', this.newComment)
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
      v-model:newComment="newComment"
      :user="user"
    >
    </review-input>

    <div class="buttons">
      <button @click="closeHandler" type="button" class="button-only-text">
        <span class="text">{{ $t('text.cancel') }}</span>
      </button>
      <button @click="sendHandler" class="main-button main-button-small main-button-confirm">
        <span class="text">{{ $t('text.reply') }}</span>
      </button>
    </div>
    
  </div>
</template>