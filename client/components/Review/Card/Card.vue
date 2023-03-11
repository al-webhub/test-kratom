<script>
import { useLikesStore } from '~/store/likes';
import { useReviewStore } from '~/store/review';

export default {
  setup() {
    const likesStore = useLikesStore()
    const reviewStore = useReviewStore()

    return {
      likesStore,
      reviewStore
    }
  },

  data() {
    return {
      isReplyActive: false,
      repliesIsActive: false,
      like: ''
    }
  },
  
  props: {
    review: {
      type: Object,
      required: true
    },
    user: {
      type: Object,
    },
    isReplyAllowed: {
      type: Boolean,
      default: true
    },
    bodyClass: {
      type: String
    }
  },

  computed: {
    photo: function(){
      if(this.review.owner.photo)
        return this.review.owner.photo.startsWith('http')? this.review.owner.photo: '/server/' + this.review.owner.photo
      else
        return this.isIncognito? '/images/incognito.png': '/images/photo-log-in.png'
    },

    name: function() {
      if(this.isIncognito)
        return 'Incognito'
      
      return this.review?.owner?.fullname
    },

    isLiked() {
      return this.likesStore.likes.includes(this.review.id)
    },

    isDisliked() {
      return this.likesStore.dislikes.includes(this.review.id)
    },

    isIncognito() {
      return this.review.extras?.method && this.review.extras?.method === 'incognito'
    }
  },

  methods: {
    toggleReplyFormHandler() {
      this.isReplyActive = !this.isReplyActive
    },
    
    closeReplyHandler() {
      this.isReplyActive = false
    },
    
    async sendReplyHandler(comment) {

      const data = {
        parent_id: this.review.id,
        text: comment,
        provider: 'auth'
      }

      await this.reviewStore.create(data).then((res) => {
        if(res.data) {
          useNoty().setNoty(this.$t('noty.add_review'))
          this.toggleRepliesHandler()
        }
        
        if(res.error)
          useNoty().setNoty(this.$t('noty.add_review_fail'))
      })

      //console.log('sendReplyHandler', comment)
    },
    
    toggleRepliesHandler() {
      this.repliesIsActive = !this.repliesIsActive
    },

    likeHandler() {
      this.likesStore.toggleLike(this.review.id)
    },

    dislikeHandler() {
      this.likesStore.toggleDislike(this.review.id)
    },

    cancel: function(){
      this.comment.text = '';
    },
  }
}
</script>

<style src="./card.scss" lang="sass" scoped />

<template>
<li class="box">
    <nuxt-img
      v-if="photo"
      :src = "photo"
      :alt = "name"
      :title = "name"
      sizes = "mobile:40px"
      width="40"
      height="40"
      format = "webp"
      quality = "40"
      loading = "lazy"
      fit="cover"
      class="avatar"
    >
    </nuxt-img> 

    <div :class="bodyClass" class="body">

        <div class="header">
          <p class="name">{{ name }}</p>
          <div class="rating" v-if="review.rating">
            <img src="~assets/svg-icons/star.svg" class="icon" alt="star icon"/>
            <span class="rating__value">{{ review.rating }}</span>
          </div>
          <p class="date">{{ $d(review.created_at, 'long') }}</p>
        </div>
        
        <div class="content" v-html="review.text">
        </div>

        <div class="footer">
            <div class="controls">
              
              <!-- LIKE BUTTON -->
              <button
                @click="likeHandler"
                :class="{active: isLiked}" 
                class="controls__button"
                type="button"
                title="like"
                v-clickable
              >
                <img src="~assets/svg-icons/like.svg" class="icon" alt="like icon" />
                <span class="text">{{ review.likes }}</span>
              </button>
              
              <!-- DISLIKE BUTTON -->
              <button
                @click="dislikeHandler"
                :class="{active: isDisliked}"
                class="controls__button"
                type="button"
                title="dislike"
                v-clickable
              >
                <img src="~assets/svg-icons/dislike.svg" class="icon" alt="dislike icon" />
                <span class="text">{{ review.dislikes }}</span>
              </button>
              
              <!-- REPLY BUTTON -->
              <button
                v-if="user && isReplyAllowed"
                @click="toggleReplyFormHandler"
                class="controls__button controls__button-reply"
                type="button"
                title="reply"
                clickable
              >
                <img src="~assets/svg-icons/reply.svg" class="icon" alt="reply icon" />
                <span class="text">{{ $t('button.reply') }}</span>
              </button>

            </div>

            <!-- REPLY FORM -->
            <review-reply-form
              v-if="user && isReplyAllowed"
              :user="user"
              @reply="sendReplyHandler"
              @close="closeReplyHandler"
              :class="{active: isReplyActive}"
              class="reply-form"
            >
            </review-reply-form>

        </div>
        
        <div
          v-if="review.children.length"
          :class="{active: repliesIsActive}"
          class="reply"
        >
          
          <button
            @click="toggleRepliesHandler"
            class="more-btn"
            type="button"
            title="replies"
            clickable
          >
            <span class="text">{{ $t('button.show_x_replies', {replies: review.children.length}) }}</span>
            <img src="~assets/svg-icons/arrow-simple.svg" class="icon" alt="arrow icon" />
          </button>

          <transition name="fade-in">
            <ul v-if="repliesIsActive" class="replies">
              <review-card
                v-for="subReview in review.children"
                :key="subReview.id"
                :review="subReview"
                :user="user"
                :is-reply-allowed="false"
              >
              </review-card>
            </ul>
          </transition>
        </div>
        
    </div>
</li>
</template>