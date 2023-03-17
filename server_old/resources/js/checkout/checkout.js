require('../bootstrap');

window.Vue = require('vue');

import cartMix from '../mixins/cartMix.js'
import search from '../mixins/search.js'

import VueLazyload from 'vue-lazyload'
Vue.use(VueLazyload)

const checkout = new Vue({
  el: "#app",
  data: {
	user: data_user,
    deliveries: deliveries,
    payments: payments,
    
    selectedDelivery: null,
    selectedPayment: null,
    privatePolicy: null,
    
    telValue: null,
    emailValue: null,
    telError: false,
    emailError: false,
    totalWeight: null,
    currentTab: 'guest',
    bonusBalance: bonusBalance,
    bonusesUsed: 0,
    login: '',
    password: '',
    innerWidth: false,
    hideCartHeader: false,
    
    new_user: {
	    firstname: '',
	    lastname: '',
	    communication_number: ''
    },
    
    address: {
	  street: '',
	  apartment: '',
	  city: '',
	  zip: '',
	  state: '',
	  country: '',  
    },
    countries: data_countries,
	communications: [
		'Viber', 'WhatsApp', 'Skype', 'Telegram', 'Facebook', 'Instagram'
	],
	selectedCommunication: ''
    
/*
    deliveryMethods: [
	    {
		    duration: '2 - 4 days',
		    price: '(from $ 5)'
	    },{
		    duration: '5 - 9 days',
		    price: '(from $ 3)'
	    },{
		    duration: '9 - 17 days',
		    price: '(from $ 2)'
	    }
    ],
    paymentMethods: [
	    {
		    title: 'visa/mastercard',
		    img: '/img/visa-img.png'
	    },{
		    title: 'paypal',
		    img: '/img/paypal-img.png'
	    },{
		    title: 'western union',
		    img: '/img/wu-img.png'
	    },{
		    title: 'swift',
		    img: '/img/swift-img.png'
	    },{
		    title: 'money gram',
		    img: '/img/money-gram-img.png'
	    },{
		    title: 'bitcoin',
		    img: '/img/bitcoin-img.png'
	    }
    ]
*/
  },
  mixins: [cartMix, search],
  methods: {
	  checkForm: function(e){
		  if (this.isShippingTabActive && this.isPaymentTabActive) {
	        return true;
	      }
      
		  e.preventDefault();
	  },
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
    validate: function() {
      if(this.selectedDelivery == this.deliveries[1].name && !this.emailValue) {
        this.emailError = true;
        window.location.hash = 'delivery';
        window.location.hash = 'error';
      }
      else if(this.selectedDelivery != this.deliveries[1].name && !this.telValue) {
        this.telError = true;
        window.location.hash = 'delivery';
        window.location.hash = 'error';
      }
      else
        document.querySelector('.checkout-form').submit();
    },
    bonusesUsedChange: function(amount) {
      // bonusesUsed + 1 > bonusBalance? bonusesUsed = bonusBalance : bonusesUsed++
      let value;
      
      if(this.bonusesUsed + amount < 0)
        value = 0;
      else if(this.bonusesUsed + amount > this.bonusBalance)
        value = this.bonusBalance;
      else if(this.bonusesUsed + amount > this.total)
        value = this.total;
      else
        value = this.bonusesUsed + amount;
      
      this.bonusesUsed = value;
    },
    maxBonusesUsed: function() {
      return this.bonusBalance > this.total ? this.total : this.bonusBalance;
    },
    handleResize() {
        if(window.innerWidth < 768) {
            this.innerWidth = true;
        }else {
            this.innerWidth = false;
        }
    },
    destroyedResize() {
        window.removeEventListener('resize', this.handleResize);
    }
  },
  watch: {
    cart: {
      handler: function(value) {
        this.calcTotal();
        this.calcTotalWeight();
        console.log('this', this.cart);
      },
      deep: true
    },
    new_user:  {
      handler: function(value) {
        console.log(value);
      },
      deep: true
    },
  },
  computed: {
	  isUserCountry: function(){
		  return this.user && this.user.usermeta && this.user.usermeta.addressDetails && this.user.usermeta.addressDetails.country == country;
	  },
    bonusesLeft: function() {
      return (this.bonusBalance - this.bonusesUsed).toFixed(2);
    },
    canConfirm: function() {
	    return this.selectedPayment && this.selectedDelivery && this.privatePolicy;
    },
	  isShippingTabActive: function(){
		  if(this.user)
		  	return true;
		  else if(!this.user && this.new_user.firstname.length > 2 && this.new_user.communication_number.length > 2) 
		  	return true;
		  else
		  	return false;
	  },
	  isPaymentTabActive: function(){
		  if(this.selectedDelivery != null && this.address.street.length > 2 && this.address.city.length > 2 && this.address.state.length > 2 && this.address.country.length > 2)
		  	return true;
		  else
		  	return false;
	  },
  },
  created: function() {
	  
	 if(this.user){
		this.address.street = this.user.usermeta.address_details.street;
		this.address.apartment = this.user.usermeta.address_details.apartment;
		this.address.city = this.user.usermeta.address_details.city;
		this.address.zip = this.user.usermeta.address_details.zip;
		this.address.state = this.user.usermeta.address_details.state;
		this.address.country = this.user.usermeta.address_details.country; 
	 } 
	//console.log(this.deliveries, this.payments);
    console.log('Checkout vue created', this.user);
    //this.selectedDelivery = this.deliveries[0].name;
    //this.selectedPayment = this.payments[0].name;
    this.calcTotal();
    this.calcTotalWeight();
		
	
    if(window.location.hash == '#register')
      this.currentTab = 'register';
    else if(window.location.hash == '#login' || this.user)
      this.currentTab = 'login';
      
    window.addEventListener('resize', this.handleResize);
    this.handleResize();
  },
});