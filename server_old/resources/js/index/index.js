require('../bootstrap');

window.Vue = require('vue');

/*
import homeBanners from '../components/homeBanners.vue'
import infinitySlider from '../components/infinitySlider.vue'
*/
import cartMix from '../mixins/cartMix.js'
import search from '../mixins/search.js'
	
import VueLazyload from 'vue-lazyload'
Vue.use(VueLazyload)

const app = new Vue({
  el: "#app",
  data: {
	for_you: [],
	reviews: reviews,
	banners: banners,
    popular_products: popular_products,
    calc: {
	    stimulation: 4,
	    relaxation: 5,
	    euphoria: 3
    }
  },
  mixins: [cartMix, search],
  components: {
	  'productcard': () => import('../components/productCard.vue'),
	  'reviewcard': () => import('../components/reviewCard.vue'),
	  'homeBanners': () => import('../components/homeBanners.vue'),
	  'infinitySlider': () => import('../components/infinitySlider.vue')
  },
  methods: {
	  loadCalcItems: function(){
		  var component = this;
		  component.for_you = [];
		  
		  axios.post('/catalog/calcRequest', this.calc).then(response => {
			  
			  response.data.forEach(function(item){
				  component.for_you.push(item);
			  });
		  });
	  },
  	calcMinus: function(param){
	  	if(this.calc[param] > 0)
	  		this.calc[param] -= 0.5;
  	},
  	calcPlus: function(param){
	  	if(this.calc[param] < 5)
	  		this.calc[param] += 0.5;
  	}
  },
});

