<script>
import { useLikesStore } from '~/store/likes';

export default {
  setup() {
    const likesStore = useLikesStore()

    return {
      likesStore
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
      let noAvatar = '/img/photo-log-in.png';
      
      if(this.user)
        return this.user.usermeta.photo? this.user.usermeta.photo: noAvatar;
      else
        return noAvatar;
    },

    isLiked() {
      return this.likesStore.likes.includes(this.review.id)
    },

    isDisliked() {
      return this.likesStore.dislikes.includes(this.review.id)
    },
  },

  methods: {
    toggleReplyFormHandler() {
      this.isReplyActive = !this.isReplyActive
    },
    
    closeReplyHandler() {
      this.isReplyActive = false
    },
    
    sendReplyHandler() {

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

    reply: function(parentId, baseIndex){
      var component = this;
      
      let params = {
        parent_id: parentId,
        product_id: this.productId,
        text: this.comment.text,
        name: this.user.usermeta.fullname,
        likes: 0,
        dislikes: 0,
        photo: this.photo
      };
      
      this.reviews.data[baseIndex].children.push(params);
      
      axios.post('/reviews/reply/create', params).then(function(response) {
        console.log(response);
        component.comment.text = '';
      });
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
    <div :style="{backgroundImage: 'url(' + review.owner.photo + ')'}" :title="review.owner.fullname" class="avatar"></div>

    <div :class="bodyClass" class="body">

        <div class="header">
          <p class="name">{{ review.owner.fullname }}</p>
          <p class="date">{{ review.created_at }}</p>
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
              >
                <img src="~assets/svg-icons/like.svg" class="icon" />
                <span class="text">{{ review.likes }}</span>
              </button>
              
              <!-- DISLIKE BUTTON -->
              <button
                @click="dislikeHandler"
                :class="{active: isDisliked}"
                class="controls__button"
              >
                <img src="~assets/svg-icons/dislike.svg" class="icon" />
                <span class="text">{{ review.dislikes }}</span>
              </button>
              
              <!-- REPLY BUTTON -->
              <button
                v-if="(user && isReplyAllowed)"
                @click="toggleReplyFormHandler"
                class="controls__button controls__button-reply"
              >
                <img src="~assets/svg-icons/reply.svg" class="icon" />
                <span class="text">{{ $t('text.reply') }}</span>
              </button>

            </div>

            <!-- REPLY FORM -->
            <review-reply-form
              v-if="isReplyAllowed"
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
          >
            <span class="text">Show {{ review.children.length }} replies</span>
            <img src="~assets/svg-icons/arrow-simple.svg" class="icon" />
          </button>

          <ul class="replies">
            <review-card
              v-for="subReview in review.children"
              :key="subReview.id"
              :review="subReview"
              :user="user"
              :is-reply-allowed="false"
            >
            </review-card>
          </ul>
        </div>
        
    </div>
</li>
</template>