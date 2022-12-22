<script>
export default {

  data() {
    return {
      comment: {
        text: '',
        extras: {
          method: 'common'
        }
      },
      product: {
        id: 1
      }
    }
  },

  props: {
    user: {
      type: Object
    }
  },

  methods: {
    createHandler(method = 'common') {
      this.comment.extras.method = method
      this.$emit('create', this.comment)
    }
  }
}
</script>

<style src="./form.scss" lang="sass" scoped />

<template>
  <div>
    <div class="reviews__caption">
      <span class="general-decor-elem"></span>
      <p>{{ $t('text.feedback_and_earn') }}</p>
    </div>

    <!-- CONDITIONS INFO 1 -->
    <div class="add-reviews__item">
      <img src="~assets/svg-icons/promo/user-filled.svg" class="icon" />
      <p>{{ $t('text.first_of_all') }}</p>
      
      <template v-if="user">
        <p class="add-reviews__active">
          <img src="~assets/svg-icons/check.svg" class="icon" />
        </p>
      </template>
      <template v-else>
        <button class="button-enter">{{ $t('text.Log_In') }}</button>
      </template>
    </div>
    
    <!-- CONDITIONS INFO 2 -->
    <div class="add-reviews__item">
      <img src="~assets/svg-icons/promo/dollar-filled.svg" class="icon" />
      <p v-html="$t('text.leave_incognito_for')"></p>
    </div>

    <!-- REVIEW FORM -->
    <div v-if="user" class="add-reviews__form">

      <!-- COMMENT FORM -->
      <review-input
        v-model:newComment="comment.text"
        :user="user"
      >
      </review-input>

      <!-- COMMENT BUTTONS -->
      <div class="add-reviews__buttons">
        <button class="main-button main-button-small" @click="createHandler('incognito')">
          <span class="text">{{ $t('text.post_incognito') }}</span>
        </button>
        <button class="main-button main-button-small main-button-confirm" @click="createHandler('common')">
          <span class="text">{{ $t('text.post') }}</span>
        </button>
      </div>

    </div>
  </div>
</template>