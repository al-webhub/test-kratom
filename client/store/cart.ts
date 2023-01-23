export const useCartStore = defineStore('cartStore', {
  persist: true,

  state: () => ({ 
    is_show: false,
    buy_1_is_show: false,
    errors: {},
    orderState: {
      bonusesUsed: 0,
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
    buy1IsShow: (state) => state.buy_1_is_show,
    show: (state) => state.is_show,
    cart: (state) => state.data,
    order: (state) => state.orderState
  },

  actions: {

    toggleBuy1() {
      this.buy_1_is_show = !this.buy_1_is_show
    },

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
      return Promise.resolve(true)
    },
    
    remove(id: number) {
      const index = this.data.findIndex(item => (item.id === id))
      this.data.splice(index, 1)
      return Promise.resolve(true)
    },

    clearCart() {
      this.data = []
    },

    serializeCart() {
      let serialized = {}

      for(const index in this.data){
        const item = this.data[index]
        serialized[item.id] = item.amount
      }

      return serialized
    },

    async createOrder(provider: String = 'auth') {
      const runtimeConfig = useRuntimeConfig()
      const context = this

      const dataPost = {
        ...this.orderState,
        products: this.serializeCart(),
        provider: provider
      }
      
      return await useFetch(`${runtimeConfig.public.apiBase}/orders`,{
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'X-XSRF-TOKEN': useCookie('XSRF-TOKEN').value,
          'X-Requested-With': 'XMLHttpRequest'
        },
        credentials: 'include',
        body: dataPost,
        onResponse({ request, response, options }) {
          console.info('order', response._data)
        },
        onResponseError({ request, response, options }) {
          context.errors = response._data
        }
      })
    }
  },
})