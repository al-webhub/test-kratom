<template>
    <div>
        <ul class="js-infinity-slider-list" :style="[transform, width]" :class="dataClassList">
            <li class="js-slider-item-infinity" :class="[{show: shows.indexOf(index) != -1}, dataClassItem]" v-for="(item, index) in scaledItems">
            	<transition name="fade">
            		<keep-alive>
						<component v-bind:is="component" :data-item="item"></component>
					</keep-alive>
            	</transition>
            </li>
        </ul>
        <div class="general-slider__buttons js-arrow-infinity">
            <button class="slider-button prev" @click="prevSlide($event)">
                <span class="icon-arrow-left"></span>
            </button>
            
            <!-- Точки нужно выводить если они кратны 3 -->
            
            <div class="dots__list">
                <div class="dots__item js-dot" :class="{active: (key + 1) == 3}" v-for="(item,key) in items" v-if="(key + 1) % 3 == 0"></div>
            </div>
            
            <!-- //Точки нужно выводить если они кратны 3 -->
            <a :href="link" class="main-button">
                <span class="text">{{ button }}</span>
            </a>
            <button class="slider-button next" @click="nextSlide($event)">
                <span class="icon-arrow-right"></span>
            </button>
        </div>
    </div>
</template>

<script>
    export default {
		name: 'infinitySlider',
	    data: function(){
	      return {
		      items: this.dataItems,
		      type: this.dataType,
		      button: this.dataButton,
		      component: null,
		      currentIndex: 0,
		      link: this.dataLink,
		      translateX: 0,
		      shows: [0,1,2,3]
	      }
	    },
	    props: ['dataItems', 'dataType', 'dataLink', 'dataButton', 'dataClassList', 'dataClassItem'],
	    methods: {
	        loader: function() {
	            if (!this.type) {
	                return null
	            }
	            return import(`../components/${this.type}`)
	        },
	        prevSlide: function(event){
                let container = event.target.closest('.slider-infinity').querySelector('.js-infinity-slider-list'); 
                let allItems = container.querySelectorAll('.js-slider-item-infinity');
                let componentThis = this;
                
                
			    // this.items.unshift(this.items[this.items.length-1]);
                // this.shows = this.shows.map(function(item){
                //     // console.log(item);
                    
                //     return item-1;
                // });
                
/*			    
			    if(this.currentIndex >= 1)
			    	this.currentIndex--;
			    else
			    	this.currentIndex = this.scaledItems.length - 5;
*/
				this.currentIndex--;
	        },
	        nextSlide: function(event){
		        //var first = this.items.shift();
                let container = event.target.closest('.slider-infinity').querySelector('.js-infinity-slider-list');
                let allItems = container.querySelectorAll('.js-slider-item-infinity');
                
                
			    // this.items.push(this.items[0]);
			    // this.shows = this.shows.map(function(item){
				//     // console.log(item);
				//     return item+1;
			    // });
/*			    
				if(this.currentIndex < this.scaledItems.length - 5)
			    	this.currentIndex++;
			    else
			    	this.currentIndex = 0;
*/
				// this.currentIndex++;
	        }
	    },
	    computed: {
		    scaledItems: function(){
			    //return this.items.concat(this.items);
			    return this.items;
		    },
		    width: function() {
			    return {width: this.items.length * 330 + 'px'};
		    },
		    transform: function(){
			    var pixels = this.currentIndex * 330 * (-1);
			    return {transform: 'translateX(' + pixels + 'px)'};
		    }
	    },
	    mounted: function() {
	        this.loader()
	            .then(() => {
	                this.component = () => this.loader()
	            })
	    },
	    watch: { 
	    },
	    created: function(){
		    
	    }
	}
</script>
