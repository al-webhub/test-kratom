require('../bootstrap');

window.Vue = require('vue');

import cartMix from '../mixins/cartMix.js'
import search from '../mixins/search.js'

import VueLazyload from 'vue-lazyload'
Vue.use(VueLazyload)

const news = new Vue({
  el: '#app',
  data: {
    articles: articles,
    query: {
      isJson: true,
      category: null,
      page: 1,
    },
	  append: false,
  },
  mixins: [cartMix, search],
  methods: {
    makeRequest: function(category = null){
      let component = this;
      this.query.category = category;

      axios.post('/news', this.query).then(response => (
        component.articles = response.data
      ));
    },
    loadmore: function() {
      this.append = true;
      this.query.page++;
    }
  },
  watch: {
    'query.category': function() {
      this.query.page = 1;
    },
    query: {
      handler: function(value, oldValue) {
            
        let thisUrl = location.protocol + '//' + location.host + location.pathname;
        
        var valueClone = _.cloneDeep(value);

        axios.post(thisUrl, valueClone).then(response => {
          let itterations = 1;
          
          if(this.append){
            let currentData = this.articles.data;
            this.articles = response.data.articles;
            this.articles.from = 1;
                
            currentData.reverse().forEach(item => {
              this.articles.data.unshift(item);
              
              if(itterations == currentData.length)
                this.append = false;
                
              itterations++;
            });
          }else
            this.articles = response.data.articles;
          
        });
      },
      deep: true
    }
  },
  created: function(){
    console.log('news vue created');
  }
});