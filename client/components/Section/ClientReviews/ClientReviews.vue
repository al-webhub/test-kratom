<script>
import clientsSayBg from 'assets/images/clients-say-bg.png';

export default {
  data() {
    return {}
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
  }
}
</script>

<style src="./client-reviews.scss" lang="sass" scoped />

<template>
  <section class="clients-say">
      
    <div class="clients-say__img js-img-bg" :style="{backgroundImage: bgImage}"></div>
      
      <div class="clients-say__wrapper container slider-infinity">
          
        <h2 class="main-caption">{{ $t('text.What_our_clients_say') }}</h2>
          
        <div class="clients-say__header">
            <p class="clients-say__caption">{{ $t('text.leave_feedback_and_earn') }}</p>
            <div class="clients-say__buttons">
                <a href="reviews#feedback" class="main-button-color">
                    <span class="text">{{ $t('text.leave_feedback') }}</span>
                </a>
                <a href="rewards" class="main-button-color clients-say__button">
                    <span class="text">{{ $t('text.learn_more') }}</span>
                </a>
            </div>
        </div>
        
        <!-- <infinity-slider :data-items="reviews" data-type="reviewCard" data-link="/reviews" data-button="read all reviews" data-class-list="clients-say__list" data-class-item="clients-say__item js-item"></infinity-slider> -->
        <ul class="clients-say__list js-infinity-slider-list">
            <li
              v-for="(review, index) in reviews"
              :key="review.id"
              :class="{show: index == 0}"
              class="js-slider-item-infinity clients-say__item js-item" 
            >
                <review-home-card :review="review"></review-home-card>
            </li>
        </ul>

        <div class="general-slider__buttons js-arrow-infinity">
            <button class="slider-button prev">
                <span class="icon-arrow-left"></span>
            </button>
            
            <!-- Точки нужно выводить если они кратны 3 -->
            
            <div class="dots__list">
                <div
                  v-for="(item, key) in reviews"
                  :key="item.id"
                  v-if="(key + 1) % 3 == 0"
                  :class="{active: (key + 1) == 3}"
                  class="dots__item js-dot" 
                >
                </div>
            </div>
            
            <!-- //Точки нужно выводить если они кратны 3 -->
            <a href="reviews" class="main-button">
                <span class="text">{{ $t('text.read_all_reviews') }}</span>
            </a>

            <button class="slider-button next">
                <span class="icon-arrow-right"></span>
            </button>

        </div>
      </div>
  </section>
</template>