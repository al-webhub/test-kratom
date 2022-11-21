
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
    getImage: function(index){
      return this.banners[index].badImage;  
    },
    prevSlide: function(){
      if(this.currentIndex >= 1)
        this.currentIndex--;
      else
        this.currentIndex = this.bannersAmount - 1;
    },
    nextSlide: function(){
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

    var component = this;
    
    if(process.client) {
      this.$nextTick(() => {
        window.addEventListener("load", function(event) {
          console.log('was load');

          setTimeout(function(){
            for(var key in component.banners){
              component.banners[key].badImage = component.banners[key].image;
            }
          }, 0);
                
          var sliderAutoStart;
                
          setTimeout(function(){
              let slider = document.querySelector('.main-banner');
              if(window.innerWidth > 1160){
                  slider.addEventListener('mouseover', function(){
                      clearInterval(sliderAutoStart);
                  });
                  
                      
                  slider.addEventListener('mouseleave', function(){
                      sliderAutoStart = setInterval(component.nextSlide, 10000);
                  });
                  
                  sliderAutoStart = setInterval(component.nextSlide, 10000);
              }
              
              var startPointX;
              slider.addEventListener("touchstart", function(event) {
                  startPointX = event.changedTouches[0].screenX;
                  clearInterval(sliderAutoStart);
              }, {passive: true});
              slider.addEventListener("touchend", function(event){
                  var endPointX = event.changedTouches[0].screenX;
                  
                  if(startPointX - endPointX > 40) {
                      component.nextSlide();
                  } else if(endPointX - startPointX > 40) {
                      component.prevSlide();
                  }
              }, {passive: true});
          },0)

        })
      })
    }  
        
  }
}
</script>

<style src="./main-slider.scss" lang="sass" scoped />

<template>
	<div>
		<div class="general-decor-figure"></div>

	    <ul class="general-decor-text__list">
	        <li class="general-decor-text__item">kratom powder</li>
	        <li class="general-decor-text__item">Kratom Pills</li>
	        <li class="general-decor-text__item">Griffonia seeds</li>
	        <li class="general-decor-text__item">Akuamma powder</li>
	        <li class="general-decor-text__item">banisteriopsis caapi</li>
	        <li class="general-decor-text__item">psychotria colorata</li>
	        <li class="general-decor-text__item">kopi luwak coffee</li>
	    </ul>

	    <div class="general-decor-text">kratom helper</div>

	    <ul class="main-banner__list js-list">

		    <template v-for="(banner, index) in banners" :key="banner.id"> 
		        <li
              :class="{show: currentIndex == index}"
              class="main-banner__item js-slider-item" 
            >
		            <div class="main-banner__img" :style="{backgroundImage: 'url(' + banner.badImage + ')'}" ></div>

		            <div class="main-banner__info">
		                <p class="main-banner__info__descrip-sub">{{ banner.desc }}</p>
		                <p class="main-banner__info__descrip">{{ banner.short_desc }}</p>
		                <a :href="banner.link" class="main-button-color">
		                    <span class="text">{{ banner.title }}</span>
		                </a>
		            </div>

		        </li>
		    </template>

	    </ul>

	    <div class="main-banner__arrows main-js-arrows">
	        
        <button class="slider-button slider-button-small prev" @click="prevSlide"> <!-- disabled -->
	        <span class="icon-arrow-left"></span>
	      </button>

        <div class="main-banner__nav">
          <button
            v-for="(number, index) in bannersAmount"
            :key="index"
            @click="currentIndex = index"
            :class="{active: index == currentIndex}"
            class="main-banner__nav__button js-dot" 
          >
            0{{ number }}
          </button>
        </div>
        
        <button @click="nextSlide" class="slider-button slider-button-small next">
          <span class="icon-arrow-right"></span>
        </button>

	    </div>

	</div>
</template>
