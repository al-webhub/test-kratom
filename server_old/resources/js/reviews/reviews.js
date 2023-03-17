require('../bootstrap');

window.Vue = require('vue');

import reviews from '../components/pageReviews.vue'
import cartMix from '../mixins/cartMix.js'
import search from '../mixins/search.js'

import VueLazyload from 'vue-lazyload'
Vue.use(VueLazyload)

const app = new Vue({
  el: "#app",
  data: {
	user: user_data,
	reviews: reviews_data
  },
  methods: {
/*
    loadmore: function() {
      this.append = true;
      this.query.page++;
    },
*/
  },
  components: {
	  'reviews': reviews
  },
/*
  watch: {
    query: {
      handler: function(value) {
        let thisUrl = location.protocol + '//' + location.host + '/reviews';
          
        var valueClone = _.cloneDeep(value);

        axios.post(thisUrl, valueClone).then(response => {
          let itterations = 1;
          
          if(this.append){
            let currentData = this.reviews.data;
            this.reviews = response.data.reviews;
            this.reviews.from = 1;
                
            currentData.reverse().forEach(item => {
              this.reviews.data.unshift(item);
              
              if(itterations == currentData.length)
                this.append = false;
                
              itterations++;
            });
          }else
            this.reviews = response.data.reviews;
        });
        
        window.scrollTo(0,0);
      },
      deep: true
    }
  },
*/
  mixins: [cartMix, search],
  created: function(){
	  //console.log(this.user);
  }
});