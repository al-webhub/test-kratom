require('../bootstrap');

window.Vue = require('vue');

import cartMix from '../mixins/cartMix.js'
import search from '../mixins/search.js'

import VueLazyload from 'vue-lazyload'
Vue.use(VueLazyload)

const cartVue = new Vue({
  el: "#app",
  data: {
    totalWeight: null
  },
  mixins: [cartMix, search],
  methods: {
    calcTotalWeight: function() {
      let component = this;
      let totalWeight = 0;
      Object.keys(component.cart).map(function(objectKey, index) {
        Object.keys(component.cart[objectKey]).map(function(modKey, key) {
          totalWeight += (component.cart[objectKey][modKey].weight * component.cart[objectKey][modKey].amount);
        });
      });
      this.totalWeight = totalWeight;
    },
  },
  watch: {
    cart: {
      handler: function(value) {
        this.calcTotalWeight();
        console.log('this', this.cart);
      },
      deep: true
    }
  },
  created: function() {
    console.log('Cart vue created');
    this.calcTotalWeight();
  }
});