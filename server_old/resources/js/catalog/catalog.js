require('../bootstrap');

window.Vue = require('vue');

import productcard from '../components/productCard.vue'
import cartMix from '../mixins/cartMix.js'
import search from '../mixins/search.js'

import VueLazyload from 'vue-lazyload'
Vue.use(VueLazyload)

const catalog = new Vue({
  el: "#app",
  data: {
    products: products,
    categories: categories,
    cart: cart,
    // per_page: [
    //   20, 50, 100
    // ],
    // sorts: {
    //   created_at_desc: '<p>По умолчанию</p>',
    //   rating_desc: '<p>По популярности</p><span class="icon-sort-bottom"></span>',
	  //   name_desc: '<p>По названию (А - Я)</p><span class="icon-sort-top"></span>',
	  //   name_asc: '<p>По названию (Я -А)</p><span class="icon-sort-bottom"></span>',
	  //   price_desc: '<p>Цена (по убыванию)</p><span class="icon-sort-bottom"></span>',
	  //   price_asc: '<p>Цена (по возрастанию)</p><span class="icon-sort-top"></span>',
    // },
    query: {
      isJson: true,
      page: 1,
      per_page: 2,
      sort: 'created_at_asc',
      category: currentCategoryId,
    },
    append: false,
    // categoryChange: false,
    // currentCategoryName: currentCategoryName,
    // currentSortName: currentSortName,
  },
  mixins: [search, cartMix],
  methods: {
    loadmore: function() {
      this.append = true;
      this.query.page++;
    }
  },
  components: {
	  'productcard': productcard,
	  },
	computed: {
	    categoryProducts: function(){
		    let component = this;
		    let products = this.products.data.filter(function(item){
			    return item.category_id == component.query.category;
		    })
		    return products;
	    },
	    pageH1: function(){
        //console.log(this.categories[this.currentCategoryIndex]);
        console.log(this.categories[this.query.category]);
		    return this.categories[this.query.category].h1;
	    }
	},
  created: function() {
    
  }
});