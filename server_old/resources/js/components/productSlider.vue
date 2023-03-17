<template>
	<div class="product-slider">
		<ul class="product__list product-slider__list js-infinity-slider-list">
		    <li class="js-slider-item-infinity product__item product-slider__item" v-for="(item, index) in products" :class="{show: index == 0}">
		        <productcard  :data-item="item"></productcard>
		    </li>
		</ul>
	</div>
</template>

<script>
	import cartMix from '../mixins/cartMix.js'
	
    export default {
		name: 'productSlider',
	    data: function(){
	      return {
	        products: [],
	        query: {
		        ids: JSON.parse(this.dataIds)
	        }
	      }
	    },
	    mixins: [cartMix],
	    components: {
			'productcard': () => import('../components/productCard.vue'),
		},
	    props: ['dataIds'],
	    methods: {},
	    computed: {},
	    watch: {},
	    created: function(){
		    var component = this;
		    //component.products = response.data
		    //<product-slider data-ids="[1,3,4,5,6]"></product-slider>
		    console.log(this.query);
		    axios.post('/api/product/getByIds', this.query).then(response => (
			    component.products = response.data
		    ));
	    }
	}
</script>
<style scoped>
.product-slider {
  margin: 40px 0;
}
</style>