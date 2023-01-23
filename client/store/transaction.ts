type Transaction = {
  id: number,
  value: number,
  balance: number,
  currency: string,
  type: string,
  status: string,
  description: string,
  created_at: string
};

export const useTransactionStore = defineStore('transactionStore', {
  state: () => ({
    transactionsState: {
      data: [] as Transaction[],
      meta: null
    },
  }),
  
  getters: {
    transactions: (state) => state.transactionsState.data,
    meta: (state) => state.transactionsState.meta,
  },

  actions: {

    async getTransactions(query: string) {
      const runtimeConfig = useRuntimeConfig()
      const params = query? '?' + new URLSearchParams(query).toString(): '';

      const { data, pending, error, refresh } = await useFetch(`${runtimeConfig.public.apiBase}/transactions${params}`,{
        onResponse({ request, response, options }) {
          // Process the response data
          return response._data
        },
      });

      this.transactionsState.data = this.transactionsState.data.concat(data?.value?.data)
      this.transactionsState.meta = data?.value?.meta
    },
  },
})