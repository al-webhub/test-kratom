<script>
export default {
  data() {
    return {
      comment: {
        text: ''
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
      <div class="wrapper">
        <div :style="{backgroundImage: 'url(' + user.photo + ')'}" class="reviews-img"></div>
        
        <!-- textarea -->
        <form-textarea
          v-model="comment.text"
          :placeholder="$t('text.your_reviews')"
        >
        </form-textarea>

      </div>

      <!-- COMMENT BUTTONS -->
      <div class="add-reviews__buttons">
        <button class="main-button main-button-small" @click="add(product.id, true)">
          <span class="text">{{ $t('text.post_incognito') }}</span>
        </button>
        <button class="main-button main-button-small main-button-confirm" @click="add(product.id)">
          <span class="text">{{ $t('text.post') }}</span>
        </button>
      </div>

    </div>
  </div>
</template>