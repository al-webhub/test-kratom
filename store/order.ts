type Order = {
  id: number,
  email: string,
  fullname: string,
  photo: string
};

export const useOrderStore = defineStore('orderStore', {
  state: () => ({
    ordersState: {
      data: [] as Order[],
      meta: null
    },
  }),
  
  getters: {
    orders: (state) => state.ordersState.data,
    ordersMeta: (state) => state.ordersState.meta,
  },

  actions: {
    unshiftOrder(order: Order) {
      this.ordersState.data.unshift(order)
    },

    async getOrders(data = null, refresh = true) {
      const runtimeConfig = useRuntimeConfig()
      const url = `${runtimeConfig.public.apiBase}/orders/get`

      return await useApiFetch(url, data, 'POST')
        .then(({data, error}) => {
          if(data) {
            if(refresh)
              this.ordersState.data = data.data
            else
              this.ordersState.data = this.ordersState.data.concat(data.data)
          
            this.ordersState.meta = data.meta
          }

          if(error)
            throw error
        })
    },

  },
})