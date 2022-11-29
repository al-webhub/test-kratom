<script>
import clientsSayBg from 'assets/images/clients-say-bg.png'; 

export default {
  data() {
    return {
      items: [],
      arrayLength: 0,
      startIndex: 0,
      direction: 'next',
      touch: {
        from: null,
        to: null
      }
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
    prevHandler(){
      this.direction = 'prev'
      let index = this.arrayLength - 1

      let item = this.items.splice(index, 1)
      this.items.unshift(item[0])
    },

    nextHandler() {
      //this.startIndex = 1
      // this.isReverse = true

      // setTimeout(() => {
      //   this.isReverse = false
      // }, 10000)

      this.direction = 'next'
      let index = 0
      let item = this.items.splice(index, 1)
      this.items.push(item[0])
    },

    touchHandler(event) {
      console.log('TOUCH', event)
    },

    touchStartHandler(event) {
      // console.log('TOUCH-START', event)
      this.touch.from = event.changedTouches[0].screenX
    },

    touchEndHandler(event) {
      // console.log('TOUCH-END', event)
      this.touch.to = event.changedTouches[0].screenX

      if(this.touch.from < this.touch.to) {
        this.prevHandler()
      }else
        {
          this.nextHandler()
        }
    }
  },

  mounted() {
    // this.startIndex = this.reviews.length
    // this.items = this.reviews.concat(this.reviews, this.reviews);

    this.startIndex = 0
    this.arrayLength = this.reviews.length
    this.items = this.reviews
  }
}
</script>

<style src="./client-reviews.scss" lang="sass" scoped />

<style>
  .list-ul {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }
</style>

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
          <a href="rewards" class="main-button-color clients-say__button">
            <span class="text">{{ $t('text.learn_more') }}</span>
          </a>
        </div>
      </div>
      
      <div class="list" 
        @touchmove="touchHandler"
        @touchstart="touchStartHandler"
        @touchend="touchEndHandler"
      >
        <TransitionGroup name="list" tag="ul" class="list-ul"  mode="in-out" appear>
          <li
            v-for="(review, index) in items"
            :key="review.id"
            :class="[{show:  index === startIndex }, direction, 'item-' + index]"
            class="item" 
          >
            <review-home-card :review="review"></review-home-card>
          </li>
        </TransitionGroup>
      </div>

      <simple-slider-btns
        :title="$t('text.read_all_reviews')"
        :items="reviews.length"
        @prev="prevHandler"
        @next="nextHandler"
        link="reviews"
      >
      </simple-slider-btns>
      
    </div>
  </section>
</template>