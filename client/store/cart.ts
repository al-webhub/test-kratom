export const useCartStore = defineStore('cartStore', {
  persist: true,

  state: () => ({ 
    is_show: false,
    orderState: {
      delivery: null,
      payment: null,
      user: {
        id: 1,
        name: 'Vasia',
        email: null,
        firstname: null,
        lastname: null,
        communication: null,
        communication_number: null
      },
      address: {
        country: null,
        city: null,
        state: null,
        street: null,
        apartment: null,
        zip: null
      }
    },
    data: [] 
  }),

  getters: {
    show: (state) => state.is_show,
    cart: (state) => state.data,
    order: (state) => state.orderState
  },

  actions: {
    open() {
      this.is_show = true
    },
    
    close() {
      this.is_show = false
    },
    
    toggle() {
      this.is_show = !this.is_show
    },
    
    add(data: Object) {
      this.data.push(data)
    },
    
    remove(id: number) {
      const index = this.data.findIndex(item => (item.id === id))
      this.data.splice(index, 1)
    },

    createOrder() {
      const runtimeConfig = useRuntimeConfig()

      const data = {
        ...this.orderState,
        products: this.data
      }

      console.log('createOrder', data)

      $fetch(`${runtimeConfig.public.apiBase}/orders`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
        })
          .then((resp) => {
            console.log(resp)
          })
          .catch((error) => console.log(error));
    }
  },
})