require('./bootstrap');

window.Vue = require('vue');

import cartMix from './mixins/cartMix.js'
import search from './mixins/search.js'

import VueLazyload from 'vue-lazyload'
Vue.use(VueLazyload)

const app = new Vue({
  el: "#app",
  mixins: [cartMix, search],
});