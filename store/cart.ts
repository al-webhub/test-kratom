
type Product = {
  id: number,
  name: string,
  slug: string,
  price: number,
  amount: number,
  image: string,
  short_name: string
};

export const useCartStore = defineStore('cartStore', {
  persist: true,

  state: () => ({
    orderState: {
      bonusesUsed: 0,
      delivery: null,
      payment: null,
      user: {
        id: null,
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
    
    data: [] as Product[]
  }),

  getters: {
    cart: (state) => state.data,
    order: (state) => state.orderState
  },

  actions: {
    
    add(data: Product) {
      const product: Product = this.toProductType(data)
      const issetProduct = this.data.find((item) => item.id === product.id)

      if(!issetProduct)
        this.data.push(product)
      else
        issetProduct.amount += product.amount
        
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

    toProductType(data: Product) {
      const {id, name, slug, price, amount, image, short_name} = data
      return {id, name, slug, price, amount, image, short_name} as Product
    },

    serializeCart() {
      let serialized = {}

      for(const index in this.data){
        const item = this.data[index]
        serialized[item.id] = item.amount
      }

      return serialized
    },

    useBonuses(value: number) {
      this.orderState.bonusesUsed = value
    },

    setUser(user) {
      const {id, firstname, lastname, communication, communication_number, email} = user
      this.orderState.user = {id, firstname, lastname, communication, communication_number, email}
    },

    async copyOrder(id: number) {
      const runtimeConfig = useRuntimeConfig()
      const url = `${runtimeConfig.public.apiBase}/orders/copy`

      return await useApiFetch(url, {id: id}, 'POST')
        .then(({data, error}) => {
          if(data) {
            return data
          }

          if(error) {
            throw error
          }
        })
    },

    async createOrder(provider: String = 'auth') {
      const runtimeConfig = useRuntimeConfig()
      const url = `${runtimeConfig.public.apiBase}/orders`

      const dataPost = {
        ...this.orderState,
        products: this.serializeCart(),
        provider: provider
      }
      
      return await useApiFetch(url, dataPost, 'POST')
        .then(({data, error}) => {
          
          if(data) {
            this.$reset()
            return data
          }

          if(error) {
            throw error
          }

        })
    }
  },
})