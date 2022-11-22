<script>
export default {
  data() {
    return {
      page: {
        h1: 'REVIEWS',
        title: ''
      },

      user: {
        usermeta: {
          photo: null
        },
      },

      reviews: [
        {
          id: 1,
          name: 'Vasia',
          photo: null,
          text: 'The best store on the Internet Thank you very much for what you are!',
          likes: 1,
          dislikes: 2,
          created_at: '18.19.2020',
          children: []
        },
        {
          id: 2,
          name: 'Vasia',
          photo: null,
          text: 'The best store on the Internet Thank you very much for what you are!',
          likes: 1,
          dislikes: 2,
          created_at: '18.19.2020',
          children: []
        }
      ],

      comment: {
        text: null
      },

      productId: null
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
    add: function(productId = null, isIncognito = false){
      var component = this;
      
      let params = {
        product_id: productId,
        text: this.comment.text,
        name: isIncognito? 'Incognito': this.user.usermeta.fullname,
        likes: 0,
        dislikes: 0
      };
                
      axios.post('/reviews/review/add', params).then(function(response) {
        
        console.log(response.data);
        component.comment.text = '';
        noty('success', response.data.message);
      });			    
    },

    loadMore: function() {
      let component = this;
      
      let params = {
        product_id: this.productId,
        page: this.reviews.current_page + 1
      };
      
      axios.post('/reviews/loadmore', params).then(function(response) {
        console.log(response);
        component.reviews.current_page = response.data.current_page;
        component.reviews.next_page_url = response.data.next_page_url;
        
        response.data.data.forEach(function(review){
          component.reviews.data.push(review);
        });
      });
    },

  }
}
</script>

<style src="assets/scss/pages/reviews.scss" lang="sass" scoped />

<template>
  <section class="reviews-page">
      <div class="reviews__wrapper container">
          <div class="general-decor-figure"></div>
          <div class="general-decor-text">kratom helper</div>
          
          <h1 class="main-caption main-caption-align">{{ page.h1 || page.title }}</h1>
          
          <div class="reviews__container">
            <div class="reviews__inner">
              <ul class="reviews__list">
                <review-card
                  v-for="(review, index) in reviews" 
                  :key="review.id"
                  :review="review"
                  :user="user"
                >
                </review-card>
              </ul>

              <button v-if="reviews.next_page_url" @click="loadMore" class="main-button reviews-more" >
                  <span class="text">{{ $t('text.show_more') }}</span>
              </button>

              <div class="add-reviews" id="feedback">

                  <div class="reviews__caprtion">
                    <span class="general-decor-elem"></span>
                    <p>{{ $t('text.feedback_and_earn') }}</p>
                  </div>

                  <div class="add-reviews__item">
                    <span class="icon-man"></span>
                    
                    <p>{{ $t('text.first_of_all') }}</p>

                    <template v-if="user">
                      <p class="add-reviews__active"><span class="icon-active"></span></p>
                    </template>
                    <template v-else>
                      <button class="button-enter js-button" data-target="registration-social">
                        {{ $t('text.Log_In') }}
                      </button>
                    </template>
                  </div>

                  <div class="add-reviews__item">
                    <span class="icon-reviews-message"></span>
                    <p v-html="$t('text.leave_incognito_for')"></p>
                  </div>
                  
                  <div v-if="user" class="add-reviews__form"> <!-- Form-->

                    <div class="wrapper">
                      <div :style="{backgroundImage: 'url(' + photo + ')'}" class="reviews-img"></div>

                      <label class="textarea__wrapper js-input-wrapper">
                        
                        <textarea v-model="comment.text" class="main-textarea js-input"></textarea>

                        <span class="custome-placeholder__wrapper">
                          <span class="custome-placeholder__before"></span>
                          <span class="custome-placeholder__text">
                            <span class="inner-text">{{ $t('text.your_reviews') }}</span>
                          </span>
                          <span class="custome-placeholder__after"></span>
                        </span>
                      </label>

                    </div>
                    
                    <div class="add-reviews__buttons">
                      <button class="main-button main-button-small" @click="add(productId, true)">
                        <span class="text">{{ $t('text.post_incognito') }}</span>
                      </button>
                      <button class="main-button main-button-small main-button-confirm" @click="add(productId)">
                        <span class="text">{{ $t('text.post') }}</span>
                      </button>
                    </div>

                  </div> <!-- Form-->
                  
              </div>

            </div>
          
          </div>

      </div>
  </section>

  <section-write-us></section-write-us>
</template>