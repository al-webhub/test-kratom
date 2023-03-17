<template>
    <div class="product__item__container js-drop-item">
        <div class="product__item__info-block">
            <div class="wrapper" v-html="product.excerpt">
            </div>
        </div>
        <a :href="product.link" class="product__item__img">
            <img :alt="product.name" :title="product.name" v-lazy="product.image">
        </a>
        <a :href="product.link" class="product__item__link">{{ product.name }}</a>
        <button class="product__item__button js-drop-button">
            <span class="text">{{ strings.info }}</span>
            <span class="icon-info"></span>
        </button>
        <ul class="product__item__info-list" v-if="product.stimulation != null && product.relaxation != null && product.euphoria != null">
            <li class="product__item__info-item">
                <p class="name">{{ strings.stimulation }}</p>
                <ul class="product__item__info-poins__list" :title="product.stimulation">
                    <li class="product__item__info-poins__item" v-for="point in 5" :class="{active: product.stimulation <= point * 20 }"></li>
                </ul>
            </li>
            <li class="product__item__info-item">
                <p class="name">{{ strings.relaxation }}</p>
                <ul class="product__item__info-poins__list" :title="product.relaxation">
                    <li class="product__item__info-poins__item" v-for="point in 5" :class="{active: product.relaxation <= point * 20 }"></li>
                </ul>
            </li>
            <li class="product__item__info-item">
                <p class="name">{{ strings.euphoria }}</p>
                <ul class="product__item__info-poins__list" :title="product.euphoria">
                    <li class="product__item__info-poins__item" v-for="point in 5" :class="{active: product.euphoria <= point * 20 }"></li>
                </ul>
            </li>
        </ul>
        <div class="product__item__weight">
            <ul class="product__weight-list">
                <li class="product__weight-item" 
                	:class="{active: selectedModification.id === modification.id}" 
                	v-for="(modification, key) in product.modifications"
                	@click="changeModification(modification)">{{ modification.name }}</li>
            </ul>
        </div>
        <div class="product__item__footer">
            <p class="product__item__price">{{ strings.currency }} <span>{{ selectedModification.price }}</span></p>
            <button class="main-button-color" @click="addToCart(product.id, selectedModification)">
                <span class="text">{{ strings.add_to_cart }}</span>
            </button>
        </div>
    </div>
</template>

<script>
	import cartMix from '../mixins/cartMix.js'
	
    export default {
		name: 'productcard',
	    data: function(){
	      return {
	        product: this.dataItem,
	        selectedModification: {},
	        image: null,
	        strings: strings
	      }
	    },
	    mixins: [cartMix],
	    props: ['dataItem'],
	    methods: {
			changeModification: function(modification) {
				this.selectedModification = Object.assign({}, modification);
			},
		  lazyImage: function(){
			this.image = this.product.image;
		  } 
	    },
	    computed: { 
	    },
	    watch: {
		  	dataItem: {
			  	handler: function(value){
				  	this.product = value;
			  	},
			  	deep: true
		  	},
		  	product: {
			  	handler: function(value){
				  	this.selectedModification = Object.assign({}, value.modifications[0]);
			  	},
			  	deep: true
		  	}
	    },
	    created: function(){
		    this.selectedModification = Object.assign({}, this.product.modifications[0]);
	    }
	}
</script>
