require('../bootstrap');

window.Vue = require('vue');

import productcard from '../components/productCard.vue'
import reviews from '../components/productReviews.vue'
import cartMix from '../mixins/cartMix.js'
import search from '../mixins/search.js'

import VueLazyload from 'vue-lazyload'
Vue.use(VueLazyload)

const product = new Vue({
  el: "#app",
  data: {
	  user: user_data,
	reviews: reviews_data,
    product: product_data,
    popular_products: related_data,
    recently_viewed: recently_data,
    selectedModification: {},
    currentTab: 'description',
    storage: JSON.parse(localStorage.getItem('kratom')),
  },
  mixins: [cartMix, search],
  components: {
	  'productcard': productcard,
	  'reviews': reviews
  },
  methods: {
    changeAttr: function(attrName, value) {
      let attr = this.product[attrName];
      let component = this;

      if(!this.storage)
        this.storage = {};

      if(!this.storage[this.product.id])
        this.storage[this.product.id] = {};

      this.storage[this.product.id][attrName] = this.storage[this.product.id][attrName]? this.storage[this.product.id][attrName] + value : value;
      attr = parseInt(attr) + value;

      axios.post('/attribute/update', {id: component.product.id, attr: attrName, value: attr}).then(function(response) {
        attr = attr + '%';
        component.product[attrName] = attr;
        noty('success', 'Thank you, your vote has been counted!');
        localStorage.kratom = JSON.stringify(component.storage);
      });
    },
    changeModification: function(modification) {
      let amount = this.selectedModification.amount;
      this.selectedModification = Object.assign({}, modification);
      this.selectedModification.amount = amount;
    }
  },
  watch: {
/*
	  selectedModification: {
		 handler: function(value) {
		 	console.log(value, this.product);
		},
		deep: true
	  },
*/
    'selectedModification.amount': {
      handler: function(value) {
        this.selectedModification.amount = parseInt(value);
      },
      deep: true
    },
  },
  computed: {
	saleWeights: function(){
		let saleModifications = this.product.modifications.slice(1, this.product.modifications.length + 1);
		
		return saleModifications.reduce(function(previous, current){
			return (previous !== null? previous + '/': '') + current.weight;
		}, null) + 'g';
	},
	currentDiscount: function(){
		let baseModification = this.product.modifications[0];
		
		let basePrice = baseModification.price * this.selectedModification.weight / baseModification.weight;
 		return Math.round(100 - this.selectedModification.price * 100 / basePrice);
	},
	discounts: function(){
		let saleModifications = this.product.modifications.slice(1, this.product.modifications.length + 1);
		
		//console.log(modifications, this.product.modifications);
		
		let baseModification = this.product.modifications[0];
		let values = [];
		
		saleModifications.forEach(function(item){
			let basePrice = baseModification.price * item.weight / baseModification.weight;
 			values.push(Math.round(100 - item.price * 100 / basePrice));
		});
		
		return values;
	},
	discountsString: function(){
		return this.discounts.reduce(function(previous, current){
			return (previous !== null? previous + '/': '') + current;
		}, null) + '%';
	}
  },
  created: function() {
    console.log('Product vue created', this.product);
    this.selectedModification = Object.assign({}, this.product.modifications[0]);
    // localStorage.removeItem('kratom')
  }
});