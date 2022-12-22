<script>
import clientsSayBg from 'assets/images/clients-say-bg.png'; 

export default {
  data() {
    return {
    }
  },

  props: {
    reviews: {
      type: Array,
      required: true
    }
  },

  computed: {
    bgImage() {
      return 'url(' + clientsSayBg + ')';
    }
  },

  methods: {
  },
}
</script>

<style src="./client-reviews.scss" lang="sass" scoped />

<template>
  <section class="clients-say">
      
    <div class="bg-image" :style="{backgroundImage: bgImage}"></div>
      
    <div class="wrapper container">
        
      <h2 class="main-caption">{{ $t('text.What_our_clients_say') }}</h2>
        
      <div class="header">
        <p class="caption">{{ $t('text.leave_feedback_and_earn') }}</p>

        <div class="buttons">
          <a href="reviews#feedback" class="main-button-color">
            <span class="text">{{ $t('text.leave_feedback') }}</span>
          </a>
          <a href="rewards" class="main-button-color learn-more__button">
            <span class="text">{{ $t('text.learn_more') }}</span>
          </a>
        </div>
      </div>

      <simple-slider
        :values="reviews"
        target-component-name="reviewHomeCard"
        target-data-name="review"
        :all-items-label="$t('text.read_all_reviews')"
        all-items-link="reviews"
      >
      </simple-slider>
      
    </div>
  </section>
</template>