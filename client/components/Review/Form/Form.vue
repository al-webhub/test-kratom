<script>
import { useAuthStore } from '~/store/auth';
export default {
  setup() {
    const authStore = useAuthStore()

    return {
      authStore
    }
  },

  data() {
    return {
      comment: {
        text: null,
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
      this.$emit('create', JSON.parse(JSON.stringify(this.comment)))

      this.comment.text = null
    },

    loginHandler() {
      this.authStore.open('signInSocial')
    }
  }
}
</script>

<style src="./form.scss" lang="sass" scoped />

<template>
  <div>
    <div class="reviews__caption">
      <span class="general-decor-elem"></span>
      <p>{{ $t('messages.feedback_and_earn') }}</p>
    </div>

    <!-- CONDITIONS INFO 1 -->
    <div class="add-reviews__item">
      <img src="~assets/svg-icons/promo/user-filled.svg" class="icon" />
      <p>{{ $t('messages.first_of_all') }}</p>
      
      <template v-if="user">
        <p class="add-reviews__active">
          <img src="~assets/svg-icons/check.svg" class="icon" />
        </p>
      </template>
      <template v-else>
        <button @click="loginHandler" class="button-enter a-link">{{ $t('button.Log_In') }}</button>
      </template>
    </div>
    
    <!-- CONDITIONS INFO 2 -->
    <div class="add-reviews__item">
      <img src="~assets/svg-icons/promo/dollar-filled.svg" class="icon" />
      <p v-html="$t('messages.leave_incognito_for', {first: '$1', second: '$2'})"></p>
    </div>

    <!-- REVIEW FORM -->
    <div v-if="user" class="add-reviews__form">

      <!-- COMMENT FORM -->
      <review-input
        v-model="comment.text"
        :user="user"
      >
      </review-input>

      <!-- COMMENT BUTTONS -->
      <div class="add-reviews__buttons">
        <button class="main-button primary-color btn" @click="createHandler('incognito')">
          <span class="text">{{ $t('button.post_incognito') }}</span>
        </button>
        <button class="main-button primary btn" @click="createHandler('common')">
          <span class="text">{{ $t('button.post') }}</span>
        </button>
      </div>

    </div>
  </div>
</template>