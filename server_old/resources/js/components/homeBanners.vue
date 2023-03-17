<template>
	<div>
		<div class="general-decor-figure"></div>
	    <ul class="general-decor-text__list">
	        <li class="general-decor-text__item">kratom powder</li>
	        <li class="general-decor-text__item">Kratom Pills</li>
	        <li class="general-decor-text__item">Griffonia seeds</li>
	    </ul>
	    <div class="general-decor-text">kratom helper</div>
	    <ul class="main-banner__list js-list">
		    <template v-for="(banner, index) in banners"> 
		        <li class="main-banner__item js-slider-item" :class="{show: currentIndex == index}">
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
	            <button class="main-banner__nav__button js-dot" :class="{active: index == currentIndex}" v-for="(number, index) in bannersAmount" @click="currentIndex = index">0{{ number }}</button>
	        </div>
	        
	        <button class="slider-button slider-button-small next" @click="nextSlide">
	            <span class="icon-arrow-right"></span>
	        </button>
	    </div>
	</div>
</template>

<script>
    export default {
		name: 'homeBanners',
	    data: function(){
	      return {
	        banners: this.dataBanners,
	        currentIndex: 0,
	        bannersAmount: 0
	      }
	    },
	    props: ['dataBanners'],
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
	    created: function(){
		    this.bannersAmount = this.dataBanners.length;
		    var component = this;
		    
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
			});
            
            
	    }
	}
</script>
