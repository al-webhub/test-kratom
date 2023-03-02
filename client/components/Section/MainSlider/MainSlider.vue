
<script>
export default {
  data: function(){
    return {
      currentIndex: 0,
      bannersAmount: 0,
      nextTickAnimate: false,
      touch: {
        from: null,
        to: null
      }
    }
  },
  
  props: {
    banners: {
      type: Array,
      required: true
    }
  },

  methods: {
    prevHandler() {
      if(this.currentIndex >= 1)
        this.currentIndex--;
      else
        this.currentIndex = this.bannersAmount - 1;
    },

    nextHandler() {
      if(this.currentIndex < this.bannersAmount - 1)
        this.currentIndex++;
      else
        this.currentIndex = 0;
    },

    touchStartHandler(event) {
      this.touch.from = event.changedTouches[0].screenX
    },

    touchEndHandler(event) {
      this.touch.to = event.changedTouches[0].screenX

      const step = this.touch.from - this.touch.to
      
      if(Math.abs(step) < 30)
        return

      if(step < 0)
        this.prevHandler()
      else
        this.nextHandler()
    },
  },

  computed: {
    canAnimate(){
      return this.nextTickAnimate
    }
  },
  
  created() {
    this.bannersAmount = this.banners.length;        

    this.$nextTick(() => {
        this.nextTickAnimate = true
    })
  }
}
</script>

<style src="./main-slider.scss" lang="sass" scoped />

<template>
	<div class="wrapper">

    <simple-decorator-list class="decor-list"></simple-decorator-list>

	    <ul
        @touchstart="touchStartHandler"
        @touchend="touchEndHandler"
        class="slides"
      >

		    <template v-for="(banner, index) in banners" :key="banner.id"> 
          <li
            :class="{show: currentIndex == index}"
            class="slide" 
          >
            <nuxt-img
              :src = "`/server/${banner.src}`"
              :alt = "banner.alt"
              :title = "banner.title"
              height="260"
              sizes = "mobile:300px tablet:360px desktop:1024px"
              format = "webp"
              quality = "15"
              fit="cover"
              :loading = "index === 0? null: 'lazy'"
              class="image"
              provider="ipx"
            >
            </nuxt-img> 

            <div :class="{animated: canAnimate}" class="content container">
              <p class="content__line-1">{{ banner.caption }}</p>
              <div class="content__line-2" v-html="banner.excerpt"></div>
              <NuxtLink :to="localePath(banner.link)" class="main-button primary">
                <span class="text">{{ banner.title }}</span>
              </NuxtLink>
            </div>
          </li>
		    </template>

	    </ul>

      <div class="container">
        <div class="nav">
          <button @click="prevHandler" class="nav__button prev" type="button" title="prev">
            <img src="~assets/svg-icons/arrow.svg" class="icon" alt="arrow icon" />
          </button>

          <div class="numbers">
            <button
              v-for="(number, index) in bannersAmount"
              :key="index"
              @click="currentIndex = index"
              :class="{active: index == currentIndex}"
              class="numbers__button"
              type="button"
              title="pagination"
            >
              0{{ number }}
            </button>
          </div>
          
          <button @click="nextHandler" class="nav__button next" type="button" title="next">
            <img src="~assets/svg-icons/arrow.svg" class="icon" alt="arrow icon" />
          </button>
        </div>
      </div>

	</div>
</template>
