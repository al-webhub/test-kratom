<script>
import { useReviewStore } from '~/store/review';

export default {
  setup() {
    const reviewStore = useReviewStore()

    return {
      reviewStore
    }
  },

  data() {
    return {
      comment: {
        rating: null,
        text: null,
        provider: 'auth',
        extras: {
          method: 'common',
        },
      },
    }
  },

  computed: {
    isActive() {
      return this.reviewStore.isShow
    },
  },

  methods: {
    closeHandler() {
      return this.reviewStore.closeModal()
    },

    async createHandler(method = 'common') {
      this.comment.extras.method = method
      
      await this.reviewStore.create(this.comment).then((res) => {
        if(res.data) {
          useNoty().setNoty(this.$t('noty.add_review'))
          
          this.comment.rating = 0
          this.comment.text = null

          this.reviewStore.clearReviewable()
          this.closeHandler()
        }

        if(res.error) {
          useNoty().setNoty(this.$t('noty.add_review_fail'))
        }
      })
    },
  }
}
</script>

<style src="./feedback.scss" lang="sass" scoped />

<template>
  <popup-layout-simple :is-active="isActive" @close="closeHandler">
    <template v-slot:title>
      {{ $t('title.your_feedback') }}
    </template>

    <template v-slot:content>
      <div>
        <form-stars v-model="comment.rating" class="rate"></form-stars>

        <form-textarea v-model="comment.text" :placeholder="$t('form.your_review')" ></form-textarea>

        <div class="buttons">
          <button class="main-button main-button-small" @click="createHandler('incognito')">
            <span class="text">{{ $t('button.post_incognito') }}</span>
          </button>
          <button class="main-button main-button-small main-button-confirm" @click="createHandler('common')">
            <span class="text">{{ $t('button.post') }}</span>
          </button>
        </div>
      </div>
    </template>

    <template v-slot:footer>
    </template>

  </popup-layout-simple>
</template>