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

    async getTransactions(query: string, refresh = true) {
      const runtimeConfig = useRuntimeConfig()
      const params = query? '?' + new URLSearchParams(query).toString(): '';
      const url = `${runtimeConfig.public.apiBase}/transactions${params}`

      return await useApiFetch(url).then(({data, error}) => {

        if(data){
          if(refresh)
            this.transactionsState.data = data.data
          else
            this.transactionsState.data = this.transactionsState.data.concat(data.data)

          this.transactionsState.meta = data.meta
        }

        if(error) {
          throw new Error(error.data)
        }
      })
    },
  },
})