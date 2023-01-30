
<script>
export default {
  data: function(){
    return {
      currentIndex: 0,
      bannersAmount: 0,
      nextTickAnimate: false
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

	    <ul class="slides">

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
              sizes = "mobile:100vw desktop:100vw"
              format = "webp"
              quality = "25"
              fit="cover"
              :loading = "index === 0? null: 'lazy'"
              class="image"
            >
            </nuxt-img> 

            <div :class="{animated: canAnimate}" class="content container">
              <p class="content__line-1">{{ banner.caption }}</p>
              <p class="content__line-2">{{ banner.excerpt }}</p>
              <NuxtLink :to="localePath(banner.link)" class="main-button primary">
                <span class="text">{{ banner.title }}</span>
              </NuxtLink>
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
