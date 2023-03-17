var cartMix = {
  data: function () {
    return {
      cart: cart,
      cartLength: null,
      total: null,
    }
  },
  methods: {
    addToCart: function(product_id, modification){
      if(this.cart[product_id] && this.cart[product_id][modification.id])
        this.cart[product_id][modification.id].amount = parseInt(this.cart[product_id][modification.id].amount) + modification.amount;
      else if(this.cart[product_id])
        Vue.set(this.cart[product_id], modification.id, Object.assign({}, modification));
      else {
        Vue.set(this.cart, product_id, {});
        Vue.set(this.cart[product_id], modification.id, Object.assign({}, modification));
      }

      noty('success', modification.product_name + ' ' + modification.name + ' added to cart.');
    },
    deleteFromCart: function(product_id, modification_id) {
      Vue.delete(this.cart[product_id], modification_id);

      if(!Object.keys(this.cart[product_id]).length)
        Vue.delete(this.cart, product_id);
      
      noty('success', 'Item removed from cart.');
    },
    updateCart: function() {
      //console.log(this.cart);
      axios.post('/cart/update', {data : Object.assign({}, this.cart)}).then(function(response) {
        //console.log(response);
      });
    },
    countCartLength: function() {
      let component = this;
      this.cartLength = 0;
      Object.keys(component.cart).forEach(function(id) {
        Object.keys(component.cart[id]).forEach(function(mod_id) {
          component.cartLength += component.cart[id][mod_id].amount;
        })
      })
    },
    checkIfCartEmpty: function(event) {
      if(!this.cartLength) {
        noty('error', cartErrorMessage);
        return event.preventDefault();
      }
    },
    calcModificationTotal: function(product_id, id) {
      return (this.cart[product_id][id].price * this.cart[product_id][id].amount);
    },
    calcProductTotal: function(id) {
      let productTotal = 0;
      let component = this;
      Object.keys(this.cart[id]).map(function(objectKey, index) {
        productTotal += component.calcModificationTotal(id, objectKey);
      });
      return productTotal;
    },
    calcTotal: function() {
      let total = 0;
      let component = this;
      Object.keys(this.cart).map(function(objectKey, index) {
          total += component.calcProductTotal(objectKey);
      });
      this.total = total;
    },
    emptyCart: function() {
      this.cart = [];
      noty('success', 'Cart is empty.');
    },
  },
  watch: {
    cart: {
      handler: function(value) {
        this.countCartLength();
        this.updateCart();
        this.calcTotal();
      },
      deep: true
    }
  },
  created: function() {
    this.countCartLength();
    this.calcTotal();
    //console.log('cart', this.cart);
  }
}

export default cartMix;