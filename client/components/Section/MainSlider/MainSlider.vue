
<script>
export default {
  data: function(){
    return {
      currentIndex: 0,
      bannersAmount: 0,
    }
  },
  props: {
    banners: {
      type: Array,
      required: true
    }
  },
  methods: {
    prevHandler: function(){
      if(this.currentIndex >= 1)
        this.currentIndex--;
      else
        this.currentIndex = this.bannersAmount - 1;
    },
    nextHandler: function(){
      if(this.currentIndex < this.bannersAmount - 1)
        this.currentIndex++;
      else
        this.currentIndex = 0;
    }
  },
  computed: {
  },
  watch: {
  },
  created() {
    this.bannersAmount = this.banners.length;        
  }
}
</script>

<style src="./main-slider.scss" lang="sass" scoped />

<template>
	<div class="wrapper">

    <simple-decorator-list class="decor-list"></simple-decorator-list>

	    <ul class="slides">

		    <template v-for="(banner, index) in banners" :key="banner.id"> 
          <li
            :class="{show: currentIndex == index}"
            class="slide" 
          >
            <nuxt-picture
              :src = "banner.src"
              :alt = "banner.alt"
              :title = "banner.title"
              sizes = "mobile:100vw"
              format = "webp"
              quality = "80"
              loading = "lazy"
              class="image cover"
            >
            </nuxt-picture> 

            <div class="content container">
              <p class="content__line-1">{{ banner.caption }}</p>
              <p class="content__line-2">{{ banner.excerpt }}</p>
              <a :href="banner.link" class="main-button-color">
                <span class="text">{{ banner.title }}</span>
              </a>
            </div>
          </li>
		    </template>

	    </ul>

	    <div class="nav">
        <button @click="prevHandler" class="nav__button prev">
          <img src="~assets/svg-icons/arrow.svg" class="icon" />
	      </button>

        <div class="numbers">
          <button
            v-for="(number, index) in bannersAmount"
            :key="index"
            @click="currentIndex = index"
            :class="{active: index == currentIndex}"
            class="numbers__button" 
          >
            0{{ number }}
          </button>
        </div>
        
        <button @click="nextHandler" class="nav__button next">
          <img src="~assets/svg-icons/arrow.svg" class="icon" />
        </button>
	    </div>

	</div>
</template>
