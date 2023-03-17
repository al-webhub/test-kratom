<template>
	<div>
	    <div class="clients-say__info">
	        <span class="general-decor-elem"></span>
	        <div class="clients-say__info__text">
	            <div class="content js-content">
	                <p>{{ review.text }}</p>
	            </div>
	        </div>
	        <button class="clients-say__info__more js-more js-button" data-target="reviews">Read more</button>
	    </div>
	    <div class="clients-say__item__footer">
	        <div class="clients-say__item__img" :style="{backgroundImage: 'url(' + review.photo + ')' }"></div>
	        <p class="clients-say__item__name">{{ review.name }}</p>
	    </div>
	</div>
</template>

<script>
    export default {
		name: 'reviewcard',
	    data: function(){
	      return {
		      review: this.dataItem
	      }
	    },
	    props: ['dataItem'],
	    methods: {
	    },
	    computed: { 
	    },
	    watch: {
		  	dataItem: {
			  	handler: function(value){
				  	this.review = value;
			  	},
			  	deep: true
		  	}
	    },
	    created: function(){
		    console.log(this.review);
	    }
	}
</script>
