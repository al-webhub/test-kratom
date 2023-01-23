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

    async getOrders(params = null) {
      const runtimeConfig = useRuntimeConfig()
      const context = this
      const query = params? '?' + new URLSearchParams(params).toString(): '';

      return await useFetch(`${runtimeConfig.public.apiBase}/orders/get`,{
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'X-XSRF-TOKEN': useCookie('XSRF-TOKEN').value,
          'X-Requested-With': 'XMLHttpRequest'
        },
        credentials: 'include',
        onResponse({ request, response, options }) {
          context.ordersState.data = context.ordersState.data.concat(response._data.data)
          context.ordersState.meta = response._data.meta
        },
      });

    },

  },
})