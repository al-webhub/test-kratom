<script>
import { useReviewStore } from '~/store/review';
import { useLikesStore } from '~/store/likes';

export default {
  setup() {
    const reviewStore = useReviewStore()
    const likesStore = useLikesStore()

    return {
      reviewStore,
      likesStore
    }
  },

  data() {
    return {
      page: {
        h1: 'REVIEWS',
        title: ''
      },

      user: {
        photo: '/images/ava3.jpg',
      },

      comment: {
        text: null
      },
    }
  },

  computed: {

    reviews() {
      return this.reviewStore?.all;
    },

    meta() {
      return this.reviewStore?.meta;
    },

    photo: function(){
      let noAvatar = '/img/photo-log-in.png';
      
      if(this.user)
        return this.user.usermeta.photo? this.user.usermeta.photo: noAvatar;
      else
        return noAvatar;
    }  
  },

  methods: {
    async getReviews(query = {per_page: 12}) {
      await this.reviewStore?.getAll(query)
    },

    async addReview(data) {
      await this.reviewStore?.create(data)
    },

    async loadMoreHandler() {
      await this.getReviews({per_page: 12, page: this.meta.current_page + 1})
    },

    createHandler(value) {
      const data = {
        ...value,
        owner: {
          id: 1
        }
      }

      this.addReview(data)
    },

  },

  async created() {
    await useAsyncData('reviews', () => this.getReviews())
  }
}
</script>

<style src="assets/scss/pages/reviews.scss" lang="sass" scoped />

<template>
  <div>
    <simple-decorator
      :is-figure="true"
      :settings="{title: {posX: 'left', posY: 'bottom'}, figure: {posX:'left', posY: 'bottom', showTill: 'desktop'}}"
    >
    <section class="wrapper">
        <div class="container">
            
            <h1 class="main-caption main-caption-align">{{ page.h1 || page.title }}</h1>
            
            <div class="inner">
              <ul class="list">
                <review-card
                  v-for="(review, index) in reviews" 
                  :key="review.id"
                  :review="review"
                  :user="user"
                  class="review"
                  body-class="card"
                >
                </review-card>
              </ul>

              <button v-if="meta && meta.current_page !== meta.last_page" @click="loadMoreHandler" class="main-button loadmore-btn" >
                <span class="text">{{ $t('text.show_more') }}</span>
              </button>

              <!-- FORM -->
              <review-form
                :user="user"
                @create="createHandler"
                class="form"
              >
              </review-form>

            </div>

        </div>
    </section>
    </simple-decorator>

    <section-write-us></section-write-us>
  </div>
</template>