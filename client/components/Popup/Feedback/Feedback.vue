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
      isLoading: false,
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

  methods: {
    closeHandler() {
      return this.reviewStore.closeModal()
    },

    async createHandler(method = 'common') {
      this.isLoading = true
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

        this.isLoading = false
      })
    },
  }
}
</script>

<style src="./feedback.scss" lang="sass" scoped />

<template>
  <popup-layout-simple @close="closeHandler">
    <template v-slot:title>
      {{ $t('title.your_feedback') }}
    </template>

    <template v-slot:content>
      <div>
        <form-stars v-model="comment.rating" class="rate"></form-stars>

        <form-textarea v-model="comment.text" :placeholder="$t('form.your_review')" ></form-textarea>
      </div>
    </template>

    <template v-slot:footer>
        <div class="buttons">
          <button @click="createHandler('incognito')" :class="{loading: isLoading}" clickable class="main-button small">
            <span class="text">{{ $t('button.post_incognito') }}</span>
          </button>
          <button @click="createHandler('common')" :class="{loading: isLoading}" clickable class="main-button small primary">
            <span class="text">{{ $t('button.post') }}</span>
          </button>
        </div>
    </template>

  </popup-layout-simple>
</template>