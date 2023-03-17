require('../bootstrap');

window.Vue = require('vue');

import cartMix from '../mixins/cartMix.js'
import search from '../mixins/search.js'

import VueLazyload from 'vue-lazyload'
Vue.use(VueLazyload)

const app = new Vue({
  el: "#app",
  mixins: [cartMix, search],
  data: {
	  paymentMethod: ['Bank card', 'Paypal', 'Western Union'],
	  selectedPayment: '',
	  requisite: {
		  cardnumber: {
			  first: '',
			  second: '',
			  third: '',
			  fourth: '',
		  },
		  paypal: {
			  email: '',
		  },
		  western: {
			  name: '',
			  country: '',
			  city: '',
			  phone: '',
		  }
	  },
    transactions: transactions,
    referrals: referrals,
    balance: balance,
    query: {
      isJson: true,
      page: 1,
      per_page: 10,
      sort: 'created_at_desc',
    },
    append: false,
    currentTab: 'referrals',
    currentReferral: 0,
    withdrawAmount: 0,
  },
  methods: {
    loadmore: function() {
      this.append = true;
      this.query.page++;
    },
    totalRefsLvl2: function(referral) {
      return referral.referrals.length;
    },
    totalRefsLvl3: function(referral) {
      let total = 0;

      referral.referrals.forEach(function(item) {
        total += item.referrals.length;
      });

      return total;
    },
  },
  computed: {
	requisites: function(){
		if(this.selectedPayment == 'Bank card')
			var string = this.requisite.cardnumber.first + ' ' + this.requisite.cardnumber.second + ' ' + this.requisite.cardnumber.third + ' ' + this.requisite.cardnumber.fourth;
		else if(this.selectedPayment == 'Paypal')
			var string = this.requisite.paypal.email;
		else if(this.selectedPayment == 'Western Union')
			var string = this.requisite.western.name + ' ' + this.requisite.western.phone + ' ' + this.requisite.western.country + ' ' + this.requisite.western.city;
		else
			var string = '';
		
		console.log(string);	
		return string;	
	}  
  },
  watch: {
    currentTab: function() {
      this.query = {
        isJson: true,
        page: 1,
        per_page: 10,
        sort: 'created_at_desc',
      };
    },
    query: {
      handler: function(value) {
        let thisUrl = location.protocol + '//' + location.host + '/account/transactions';
          
        var valueClone = _.cloneDeep(value);

        axios.post(thisUrl, valueClone).then(response => {
          let itterations = 1;
          
          if(this.append){
            let currentData = this.transactions.data;
            this.transactions = response.data.transactions;
            this.transactions.from = 1;
                
            currentData.reverse().forEach(item => {
              this.transactions.data.unshift(item);
              
              if(itterations == currentData.length)
                this.append = false;
                
              itterations++;
            });

            currentData = this.referrals.data;
            this.referrals = response.data.referrals;
            this.referrals.from = 1;
                
            currentData.reverse().forEach(item => {
              this.referrals.data.unshift(item);
              
              if(itterations == currentData.length)
                this.append = false;
                
              itterations++;
            });
          }else {
            this.transactions = response.data.transactions;
            this.referrals = response.data.referrals;
          }
        });
      },
      deep: true
    }
  },
  created: function() {
    console.log('transactions vue created');
  }
});